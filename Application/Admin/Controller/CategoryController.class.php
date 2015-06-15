<?php
namespace Admin\Controller;
use Think\Controller;
class CategoryController extends CommonController {

    //栏目列表
    public function listCategory(){
    	$this->display(MODULE_NAME.'/listCategory');
    }

    //添加栏目（表单）
    public function addCategory(){
    	$this->display(MODULE_NAME.'/addCategory');
    }

    //添加栏目（post处理，插入数据库）
    public function categoryAdd(){
        //插入数据库
		$categoryModel = M('category');
		if($categoryModel->create()){
		    $insertId = $categoryModel->add(); // 写入数据到数据库
            if($insertId){
                // 判断栏目类型，自定义链接和单页需在各自的内容表里插入相同ID的记录
                $type = I('post.type');
                switch ($type) {
                    case 0: // 自定义链接 custom_link
                        $result = A('CustomLink')->customLinkAdd($insertId);
                        // $result = M('custom_link')->data(array('linkid'=>$insertId))->add();
                        break;

                    case 1: // 单页 page
                        $result = A('Page')->pageAdd($insertId);
                        // $result = M('page')->data(array('pageid'=>$insertId))->add();
                        break;
                    
                    case 2: // 文章 article type = 2
                        $result = true;
                        break;
                }
                if($result){
                    $this->success(L('_OPERATION_SUCCESS_'));
                }
            }
		}
    }

    //删除栏目
    public function deleteCategory(){
        //获取ajax提交的ID数组
        $ids = I('post.ids');
        //判断有没有子栏目
        foreach ($ids as $id) {
            if(has_sub_category($id))
                $this->error(L('HAS_SUB_CATEGORY_ERROR'));
        }
        //循环删除
        $categoryModel = M('category');
        $success = 0;
        foreach ($ids as $id) {
            $categoryType = get_category_type_no($id); // 获取栏目类型
            $affectedRows = $categoryModel->delete($id); // 从数据库删除栏目

            if($affectedRows){
                //判断栏目类型，自定义链接和单页需在各自的内容表里删除相同ID的记录
                switch ($categoryType) {
                    case 0: // 自定义链接 custom_link
                        $result = A('CustomLink')->customLinkDelete($id);
                        // $result = M('custom_link')->delete($id);
                        break;

                    case 1: // 单页 page
                        $result = A('Page')->pageDelete($id);
                        // $result = M('page')->delete($id);
                        break;
                    
                    case 2: // 文章 article type = 2
                        $result = true;
                        break;
                }
                if($result)
                    $success++;
            }
        }
        //判断成功数目
        if($success == count($ids))
            $this->success(L('_OPERATION_SUCCESS_'),U('listCategory'));
        else
            $this->error(L('_OPERATION_FAIL_'),U('listCategory'));
    }

    //编辑栏目
    public function editCategory(){
        $id = I('get.id');
        $this->categoryItem = M('category')->find($id);
        $this->display(MODULE_NAME.'/editCategory');
    }

    //编辑栏目提交处理（更新数据库）
    public function categoryEdit(){
        // 判断父级栏目是不是自己本身
        $post = I('post.');
        if($post['pid'] == $post['id']){
            $this->error(L('PARENT_CATEGORY_IS_SELF_ERROR'));
        }
        //插入数据库
        $categoryModel = M('category');
        if($categoryModel->create()){
            $result = $categoryModel->save(); // 写入数据到数据库 
            if($result){
                $this->success(L('_OPERATION_SUCCESS_'), U('listCategory'));
            }
        }
    }
}