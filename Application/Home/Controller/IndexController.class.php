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
}