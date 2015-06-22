<?php
namespace Admin\Controller;
use Think\Controller;
class ConfigController extends CommonController {

	public function seoSet(){
		$this->display(MODULE_NAME.'/seoSet');
	}

	public function setSEO(){
		if(IS_POST){
			$seoConfigData = I('post.');
			$count = 0;
			$success = 0;
			foreach ($seoConfigData as $name => $value) {
				if($value != get_config($name)){
					$count++;
					$affectRows = set_config($name, $value);
					if($affectRows){
						$success++;
					}
				}
			}
			if($success == $count){
				if($count == 0){
					$this->error(L('NOTHING_CHANGED'));
				}else{
					$this->success(L('_OPERATION_SUCCESS_'));
				}
			}else{
				$this->error(L('_OPERATION_FAIL_'));
			}
		}
	}
}
