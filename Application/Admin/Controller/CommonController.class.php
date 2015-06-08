<?php
namespace Admin\Controller;
use Think\Controller;
class CommonController extends Controller {

	public function _initialize(){
        //定义后台模板目录
		define('TPL_PATH',__ROOT__.'/'.MODULE_PATH.'View/'.MODULE_NAME);
	}

	//ajax执行后的信息提示
    public function showMsg(){
        $ajaxReturn = I('post.');
        if($ajaxReturn['status'] == 1)
            $this->success($ajaxReturn['info'], $ajaxReturn['url']);
        else
            $this->error($ajaxReturn['info'], $ajaxReturn['url']);
    }

    
}