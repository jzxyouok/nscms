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
			$success = 0;
			foreach ($seoConfigData as $name => $value) {
				$affectRows = set_config($name, $value);
				$success += $affectRows ? 1 : 0;
			}
			if($success == count($seoConfigData)){
				$this->success(L('_OPERATION_SUCCESS_'));
			}else{
				$this->error(L('_OPERATION_FAIL_'));
			}
		}
	}
}