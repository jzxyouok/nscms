<?php
namespace Admin\Controller;
use Think\Controller;
class MessageController extends CommonController {

	public function listMessage(){
		$messageModel = M('message');

		$p = empty(I('get.p')) ? 1 : I('get.p');

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
		$this->messageItem = $messageModel->find(I('get.id'));
		if($this->messageItem){
			$affectRows = $messageModel->where(array('id'=>I('get.id')))->setField('isread', 1);
			if($affectRows)
				$this->display(MODULE_NAME.'/showMessage');
		}
	}
}