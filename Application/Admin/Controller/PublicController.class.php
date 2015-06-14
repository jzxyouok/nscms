<?php
namespace Admin\Controller;
use Think\Controller;
class PublicController extends Controller {

	public function login(){
		$this->display(MODULE_NAME.'/login');
	}

	public function signIn(){
		if(IS_POST){
			if(check_verify(I('verify'))){
				$accountItem = M('admin')->where(array('account'=>I('post.account')))->find();
				if($accountItem){
					if($accountItem['password'] == md5(I('post.password'))){
						session('uid', $accountItem['uid']);
						$this->success(L('LOGIN_SUCCESS'), U('Common/index'));
					}else{
						$this->error(L('ACCOUNT_ERROR'), U('login'));
					}
				}else{
					$this->error(L('ACCOUNT_ERROR'), U('login'));
				}
			}else{
				$this->error(L('VERIFY_ERROR'), U('login'));
			}
		}
	}

	public function verifyImage(){
		$verifyInstance = new \Think\Verify();
		$verifyInstance->length = 4;
		$verifyInstance->entry();
	}
}