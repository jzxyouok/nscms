<?php
namespace Admin\Controller;
use Think\Controller;
class PublicController extends Controller {

	public function _initialize(){
        // 验证安装
        if(true != get_config('installed')){
            $this->redirect('Install/Install/index');
        }
	}

	public function login(){
		if(true == session('?uid')){
			$this->redirect('Common/index');
		}
		$this->display(MODULE_NAME.'/login');
	}

	public function signIn(){
		if(IS_POST){
			$post = I('post.');
			if(true == check_verify($post['verify'])){
				$accountItem = M('admin')->where(array('account'=>$post['account']))->find();
				if(true == $accountItem){
					if($accountItem['password'] == md5($post['password'])){
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