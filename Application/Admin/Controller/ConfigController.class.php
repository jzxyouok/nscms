<?php
namespace Admin\Controller;
use Think\Controller;
class ConfigController extends CommonController {

	public function seoSet(){
		$this->display(MODULE_NAME.'/'.ACTION_NAME);
	}

	public function setSEO(){
		if(IS_POST){
			$seoConfigData = I('post.');
			foreach ($seoConfigData as $name => $value) {
				$affectRows = set_config($name, $value);
			}
			$this->success(L('_OPERATION_SUCCESS_'));
		}
	}
}