<?php
namespace Install\Controller;
use Think\Controller;
class InstallController extends Controller {

	public function install(){

		// 检测是否已经安装
		if(true == get_config('installed')){
			$this->error(L('_ERROR_ACTION_').',程序已经安装,请不要重复执行',  U('Home/Index/index'));
		}
        // 添加演示账号
        $accountData = array(
            'account' => 'demo',
            'gid' => 2,
            'password' => md5('demo'),
			'uniqid' => uniqid(),
        );
		$insertId = M('admin')->add($accountData);
		// 添加超级管理员
		$accountData = array(
			'account' => 'admin',
			'gid' => 0,
			'password' => md5('admin'),
			'uniqid' => uniqid(),
		);
		$insertId = M('admin')->add($accountData);
		// 添加SEO配置
		$configData[] = array(
			'name' => 'seo_title',
			'value' => 'SEO标题',
		);
		$configData[] = array(
			'name' => 'seo_keywords',
			'value' => 'SEO关键词',
		);
		$configData[] = array(
			'name' => 'seo_description',
			'value' => 'SEO描述',
		);
		$configData[] = array(
			'name' => 'installed',
			'value' => 1,
		);
		$affectRows = M('config')->addAll($configData);

		if(true == $insertId && true == $affectRows){
			$this->success(L('_OPERATION_SUCCESS_'), U('Admin/Public/login'));
		}else{
			$this->error(L('_OPERATION_FAIL_'));
		}
	}
}
