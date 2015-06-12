<?php
namespace Admin\Controller;
use Think\Controller;
class IndexController extends CommonController {	

    public function index(){
        $this->display('Admin/index');
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