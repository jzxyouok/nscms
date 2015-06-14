<?php
namespace Admin\Controller;
use Think\Controller;
class AccountController extends CommonController {

	public function listAccount(){
		$this->accountList = M('admin')->order('gid desc,uid')->select();
		$this->display(MODULE_NAME.'/listAccount');
	}

	public function addAccount(){
		$this->display(MODULE_NAME.'/'.ACTION_NAME);
	}

	public function accountAdd(){
		if(IS_POST){
			if(I('post.password') != I('post.repassword'))
				$this->error(L('DIFFERENT_PASSWORD'));
			$adminModel = M('admin');
			$adminModel->create();
			$adminModel->password = md5(I('post.password'));
			$insertId = $adminModel->add();
			if($insertId)
				$this->success(L('_OPERATION_SUCCESS_'));
			else
				$this->error(L('_OPERATION_FAIL_'));
		}
	}

	public function editAccount(){
		$this->accountItem = M('admin')->find(I('get.id'));
		$this->display(MODULE_NAME.'/'.ACTION_NAME);
	}

	public function accountEdit(){
		if(IS_POST){
			$adminModel = M('admin');
			$adminModel->create();
			$affectRows = $adminModel->save();
			if($affectRows)
				$this->success(L('_OPERATION_SUCCESS_'));
			else
				$this->error(L('_OPERATION_FAIL_'));
		}
	}

	public function _before_delete(){
		//获取ajax提交的ID数组
        $ids = I('post.ids');
        //判断是否存在当前登陆用户
        foreach ($ids as $id) {
            if($id == session('uid'))
            	$this->error(L('DELETE_SELF_ERROR'));
        }
	}

	public function resetPassword(){
		$this->display(MODULE_NAME.'/'.ACTION_NAME);
	}

	public function passwordReset(){
		if(IS_POST){
			if(I('post.password') != I('post.repassword'))
				$this->error(L('DIFFERENT_PASSWORD'));
			$affectRows = M('admin')->where(array('uid'=>I('uid')))->setField('password', md5(I('post.password')));
			if($affectRows)
				$this->success(L('_OPERATION_SUCCESS_'));
			else
				$this->error(L('_OPERATION_FAIL_'));
		}
	}

	public function changePassword(){
		$this->display(MODULE_NAME.'/'.ACTION_NAME);
	}

	public function passwordChange(){
		if(IS_POST){
			// 判断两次新密码输入
			if(I('post.newpassword') != I('post.repassword'))
				$this->error(L('DIFFERENT_PASSWORD'));
			// 判断是否修改的是当前登陆用户
			if(I('uid') != session('uid'))
				$this->error(L('DO_NOT_HACK'));

			$accountItem = M('admin');
			$oldPassword = $accountItem->where(array('uid'=>I('uid')))->getField('password');
			// 判断原密码是否正确
			if($oldPassword != md5(I('password')))
				$this->error(L('OLD_PASSWORD_ERROR'));

			// 修改密码
			$affectRows = $accountItem->where(array('uid'=>I('uid')))->setField('password', md5(I('newpassword')));
			if($affectRows)
				$this->success(L('_OPERATION_SUCCESS_'));
			else
				$this->error(L('_OPERATION_FAIL_'));
		}
	}
}