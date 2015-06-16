<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {

    public function _initialize(){
        // 验证安装
        if(true != get_config('installed')){
            $this->redirect('Install/Install/index');
        }
    }
	
    public function index(){
        $this->display(MODULE_NAME.'/index');
    }

    public function showPage(){
    	$pageId = I('get.id');
    	$this->pageItem = M('page')->find($pageId);
    	$this->display(MODULE_NAME.'/page');
    }

    public function listArticle(){
        $catid = I('get.catid');
    	$tpl = M('category')->where(array('id'=>$catid))->getField('tpl');
    	if($tpl){
    		$this->display(MODULE_NAME.'/list_'.$tpl);
        }else{
    		$this->display(MODULE_NAME.'/list');
        }
    }

    public function showArticle(){
        $id = I('get.id');
    	$this->articleItem = M('article')->find($id);
    	$this->articleDataItem = M('article_data')->find($id);
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
	    	if($insertId){
	    		$this->success(L('_OPERATION_SUCCESS_'));
            }else{
	    		$this->error(L('_OPERATION_FAIL_'));
            }
    	}
    }

    public function test(){
        $a = 3;
    	$get = $a['p'];
        echo set_config('seo_title','aa');
    }
}