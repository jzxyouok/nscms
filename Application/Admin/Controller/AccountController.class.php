<?php
namespace Admin\Controller;
use Think\Controller;
class AccountController extends CommonController {

	public function listAccount(){
		$this->accountList = M('admin')->order('gid desc,uid')->select();
		$this->display(MODULE_NAME.'/listAccount');
	}

	public function addAccount(){
		$this->display(MODULE_NAME.'/addAccount');
	}

	public function accountAdd(){
		if(IS_POST){
			$post = I('post.');
			if($post['password'] != $post['repassword']){
				$this->error(L('DIFFERENT_PASSWORD'));
			}
			$adminModel = M('admin');
			$adminModel->create();
			$adminModel->password = md5($post['password']);
			$adminModel->uniqid = uniqid();
			$insertId = $adminModel->add();
			if(true == $insertId){
				$this->success(L('_OPERATION_SUCCESS_'));
			}else{
				$this->error(L('_OPERATION_FAIL_'));
			}
		}
	}

	public function editAccount(){
		$id = I('get.id');
		$this->accountItem = M('admin')->find($id);
		$this->display(MODULE_NAME.'/editAccount');
	}

	public function accountEdit(){
		if(IS_POST){
			$adminModel = M('admin');
			$adminModel->create();
			$affectRows = $adminModel->save();
			if(true == $affectRows){
				$this->success(L('_OPERATION_SUCCESS_'));
			}else{
				$this->error(L('NOTHING_CHANGED'));
			}
		}
	}

	public function _before_delete(){
		//获取ajax提交的ID数组
        $ids = I('post.ids');
        //判断是否存在当前登陆用户
        foreach ($ids as $id) {
            if($id == session('uid')){
            	$this->error(L('DELETE_SELF_ERROR'));
            }
        }
	}

	public function resetPassword(){
		$uid = I('get.uid');
		$currentUid = session('uid');
		if($uid == $currentUid){
			$this->error(L('CAN_NOT_RESET_SELF'));
		}
		$this->display(MODULE_NAME.'/resetPassword');
	}

	public function passwordReset(){
		if(IS_POST){
			$post = I('post.');
			if($post['password'] != $post['repassword']){
				$this->error(L('DIFFERENT_PASSWORD'));
			}
			$affectRows = M('admin')->where(array('uid'=>$post['uid']))->setField('password', md5($post['password']));
			if(true == $affectRows){
				$this->success(L('_OPERATION_SUCCESS_'));
			}else{
				$this->error(L('_OPERATION_FAIL_'));
			}
		}
	}

	public function changePassword(){
		$this->display(MODULE_NAME.'/changePassword');
	}

	public function passwordChange(){
		if(IS_POST){
			// 判断两次新密码输入
			$post = I('post.');
			if($post['newpassword'] != $post['repassword']){
				$this->error(L('DIFFERENT_PASSWORD'));
			}
			// 判断原密码和新密码是否相同
			if($post['oldpassword'] == $post['newpassword']){
				$this->error(L('PASSWORD_NOT_CHANGE'));
			}
			// 判断是否修改的是当前登陆用户
			if($post['uid'] != session('uid')){
				$this->error(L('DO_NOT_HACK'));
			}

			$accountItem = M('admin');
			$oldPassword = $accountItem->where(array('uid'=>$post['uid']))->getField('password');
			// 判断原密码是否正确
			if($oldPassword != md5($post['oldpassword'])){
				$this->error(L('OLD_PASSWORD_ERROR'));
			}

			// 修改密码
			$affectRows = $accountItem->where(array('uid'=>$post['uid']))->setField('password', md5($post['newpassword']));
			if(true == $affectRows){
				$this->success(L('_OPERATION_SUCCESS_').L('PLEASE_LOGIN_AGAIN'), U('Common/signOut'));
			}else{
				$this->error(L('_OPERATION_FAIL_'));
			}
		}
	}
}
