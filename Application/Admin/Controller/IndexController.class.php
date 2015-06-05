<?php
namespace Admin\Controller;
use Think\Controller;
class IndexController extends Controller {

	public function _initialize(){
        //定义后台模板目录
		define('TPL_PATH',__ROOT__.'/'.MODULE_PATH.'View/'.MODULE_NAME);
	}

    public function index(){
        $this->display('Admin/index');
    }

    //栏目列表
    public function listCategory(){
    	$this->display('Admin/listCategory');
    }

    //添加栏目（表单）
    public function addCategory(){
    	$this->display('Admin/addCategory');
    }

    //添加栏目（post处理，插入数据库）
    public function categoryAdd(){
        //判断父级栏目所属层级，栏目最多三层
    	if(get_category_level(I('post.pid'))>2){
    		$this->error(L('CATEGORY_LEVEL_ERROR'));
    	}
        //插入数据库
		$categoryModel = M('category');
		if($categoryModel->create()){
		    $insertId = $categoryModel->add(); // 写入数据到数据库
            if($insertId){
                //判断栏目类型，自定义链接和单页需在各自的内容表里插入相同ID的记录
                switch (I('post.type')) {
                    case 0: // 自定义链接 custom_link
                        $result = M('custom_link')->data(array('linkid'=>$insertId))->add();
                        break;
                    
                    case 3: // 单页 page
                        $result = M('page')->data(array('pageid'=>$insertId))->add();
                        break;
                    
                    default:
                        # code...
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
                        $result = M('custom_link')->delete($id);
                        break;
                    
                    case 3: // 单页 page
                        $result = M('page')->delete($id);
                        break;
                    
                    default:
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
        $this->display('Admin/editCategory');
    }

    //编辑栏目提交处理（更新数据库）
    public function categoryEdit(){
        //判断父级栏目所属层级，栏目最多三层
        if(get_category_level(I('post.pid'))>2){
            $this->error(L('CATEGORY_LEVEL_ERROR'));
        }
        //判断父级栏目是不是自己本身
        if(I('post.pid') == I('post.id')){
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

    //排序栏目ajax提交处理
    public function sortCategory(){
        //获取排序数组，ID数组
        $sorts = I('post.sorts');
        $ids = I('post.ids');
        //更新排序字段
        $categoryModel = M('category');
        for ($i=0, $success = 0; $i < count($sorts); $i++) {
            $result = $categoryModel->where('id='.$ids[$i])->setField('sort', intval($sorts[$i]));
            if($result)
                $success++;
        }
        $this->success(L('_OPERATION_SUCCESS_'), U('listCategory'));

    }

    // 编辑自定义链接
    public function editCustomLink(){
        $linkId = I('get.linkid');
        $this->customLinkItem = M('custom_link')->find($linkId);
        $this->display('Admin/editCustomLink');
    }

    // 编辑自定义链接（post提交处理）
    public function customLinkEdit(){
        // $customLinkItem['linkid'] = I('post.linkid');
        // $customLinkItem['href'] = I('post.href');
        $affectedRows = M('custom_link')->save(I('post.'));
        if($affectedRows)
            $this->success(L('_OPERATION_SUCCESS_'), U('listCategory'));
    }

    // 编辑单页内容
    public function editPage(){
        $pageId = I('get.pageid');
        $this->pageItem = M('page')->find($pageId);
        $this->display('Admin/editPage');
    }

    // 编辑单页内容（post提交处理）
    public function pageEdit(){
        // $pageItem['pageid'] = I('post.pageid');
        // $pageItem['content'] = I('post.content');
        $affectedRows = M('page')->save(I('post.'));
        if($affectedRows)
            $this->success(L('_OPERATION_SUCCESS_'), U('listCategory'));
    }

    public function test(){
    	//echo has_sub_category(6);
        // $str = "01";
        // echo intval($str);
        // echo U('index');
        // echo L('TEST');
        // echo L('_MODULE_');
        echo get_category_type_no(25);
    }

    // public function ajaxGetUrl(){
    //     if(IS_AJAX)
    //         echo U(I('post.action'), '', '');
    // }

    // public function ajaxGetLang(){
    //     if(IS_AJAX)
    //         echo L(I('post.lang'));
    // }
}