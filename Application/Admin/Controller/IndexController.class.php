<?php
namespace Admin\Controller;
use Think\Controller;
class IndexController extends Controller {

	public function _initialize(){
		define('TPL_PATH',__ROOT__.'/'.MODULE_PATH.'View/'.MODULE_NAME);
	}

    public function index(){
        //$this->show('hw','utf-8');
        $this->display('Admin/index');
    }

    public function listCategory(){
    	$listCategory = M('category')->select();
    	// $listCat = [];
    	// foreach ($listCategory as $value) {
    	// 	$level = get_category_level($value['id']);
    	// 	$listCat[$level][] = $value;
    	// }
    	// $this->listCat = $listCat;
    	$this->listCat = $listCategory;
    	$this->display('Admin/listCategory');
    }

    public function addCategory(){
    	$this->listCategory = M('category')->select();
    	$this->display('Admin/addCategory');
    }

    public function categoryAdd(){
    	if(I('post.pid')>2){
    		$this->error('不能再添加子栏目了');
    	}
		$categoryModel = M('category');
		if($categoryModel->create()){
		    $result = $categoryModel->add(); // 写入数据到数据库 
		    if($result){
		    	$this->success('新增成功');
	    	}
		}
    }

    public function test(){
    	echo get_category_level(2);
    }
}