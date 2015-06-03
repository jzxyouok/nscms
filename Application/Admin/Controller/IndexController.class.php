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
		    	$this->success('新增成功');
	    	}
		}
    }

    public function test(){
    	dump(get_sub_category(0));
    }
}