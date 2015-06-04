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
    		$this->error('栏目最多只能到三层');
    	}
        //插入数据库
		$categoryModel = M('category');
		if($categoryModel->create()){
		    $result = $categoryModel->add(); // 写入数据到数据库 
		    if($result){
		    	$this->success('操作成功');
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
                $this->error('有子栏目的先删子栏目，重选吧少年！');
        }
        //循环删除
        $categoryModel = M('category');
        $success = 0;
        foreach ($ids as $id) {
            if($categoryModel->delete($id))
                $success++;
        }
        //判断成功数目
        if($success == count($ids))
            $this->success('操作成功',U('Index/listCategory'));
        else
            $this->error('操作失败',U('Index/listCategory'));
    }

    //编辑栏目
    public function editCategory(){
        $id = I('get.id');
        $this->categoryItem = M('category')->where('id='.$id)->find();
        $this->display('Admin/editCategory');
    }

    //编辑栏目提交处理（更新数据库）
    public function categoryEdit(){
        //判断父级栏目所属层级，栏目最多三层
        if(get_category_level(I('post.pid'))>2){
            $this->error('栏目最多只能到三层');
        }
        //判断父级栏目是不是自己本身
        if(I('post.pid') == I('post.id')){
            $this->error('父级栏目不能是自己哦！');
        }
        //插入数据库
        $categoryModel = M('category');
        if($categoryModel->create()){
            $result = $categoryModel->save(); // 写入数据到数据库 
            if($result){
                $this->success('操作成功');
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
        $this->success('操作成功', U('Index/listCategory'));

    }

    public function test(){
    	//echo has_sub_category(6);
        $str = "01";
        echo intval($str);
    }
}