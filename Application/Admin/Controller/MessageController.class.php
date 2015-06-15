<?php
namespace Admin\Controller;
use Think\Controller;
class MessageController extends CommonController {

	public function listMessage(){
		$messageModel = M('message');

		$p = I('get.p');
		$p = (false == $p) ? 1 : $p;

		$this->messageList = $messageModel->order('createtime desc')->page($p, C('PAGE_ROWS'))->select();
		
		$count = $messageModel->count();
		$pageInstance = new \Think\Page($count, C('PAGE_ROWS'));
		foreach (C('PAGE_CONFIG') as $key => $value) {
			$pageInstance->setConfig($key,$value);
		}
		$this->show = $pageInstance->show();

		$this->display(MODULE_NAME.'/listMessage');
	}

	public function showMessage(){
		$messageModel = M('message');
		$id = I('get.id');
		$this->messageItem = $messageModel->find($id);
		if(true == $this->messageItem){
			$affectRows = $messageModel->where(array('id'=>$id))->setField('isread', 1);
			if(true == $affectRows){
				$this->display(MODULE_NAME.'/showMessage');
			}
		}
	}
}