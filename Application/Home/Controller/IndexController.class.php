<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
	
    public function index(){
        $this->display(MODULE_NAME.'/index');
    }

    public function showPage(){
    	$pageId = I('get.id');
    	$this->pageItem = M('page')->find($pageId);
    	$this->display(MODULE_NAME.'/page');
    }

    public function listArticle(){
    	$tpl = M('category')->where(array('id'=>I('get.catid')))->getField('tpl');
    	if($tpl)
    		$this->display(MODULE_NAME.'/list_'.$tpl);
    	else
    		$this->display(MODULE_NAME.'/list');
    }

    public function showArticle(){
    	$this->articleItem = M('article')->find(I('get.id'));
    	$this->articleDataItem = M('article_data')->find(I('get.id'));
    	$this->display(MODULE_NAME.'/show');
    }

    public function sendMessage(){
    	$this->display(MODULE_NAME.'/message');
    }

    public function messageSend(){
    	if(IS_POST){
    		$messageModel = M('message');
	    	$messageModel->create();
	    	$messageModel->createtime = time();
	    	$insertId = $messageModel->add();
	    	if($insertId)
	    		$this->success(L('_OPERATION_SUCCESS_'));
	    	else
	    		$this->error(L('_OPERATION_FAIL_'));
    	}
    }

    public function test(){
    	$a = 2 || false;
    	echo $a;
    }
}