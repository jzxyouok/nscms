<?php
namespace Install\Controller;
use Think\Controller;
class IndexController extends Controller {

	public function install(){

		// 检测表中是否有数据
		$accountModel = M('admin');
		$configModel = M('config');
		if(false == $accountModel->select() || false == $configModel->select()){
			$this->error(L('_ERROR_ACTION_').',程序已经安装,请不要重复执行');
		}
		// 添加超级管理员
		$accountData = array(
			'account' => 'nasen',
			'gid' => 0,
			'password' => md5('123456'),
		);
		$insertId = $accountModel->add($accountData);
		// 添加SEO配置
		$seoConfigData[] = array(
			'name' => 'seo_title',
			'value' => '纳森科技-领先的网站建设公司-响应式网站|企业网站建设|自适应网站制作-专业-高端！',
		);
		$seoConfigData[] = array(
			'name' => 'seo_keywords',
			'value' => '呼和浩特网站建设,呼市网络公司,呼和浩特做网站,呼和浩特响应式网站,呼和浩特自适应网站,内蒙古网络公司,内蒙古网站制作,内蒙古网站建设与开发',
		);
		$seoConfigData[] = array(
			'name' => 'seo_description',
			'value' => '纳森科技-领先的网站建设公司-响应式网站|企业网站建设|自适应网站制作-专业-高端！',
		);
		$affectRows = $configModel->addAll($seoConfigData);

		if(true == $insertId && true == $affectRows){
			rename('./install.php', './install_bak.php');
			$this->success(L('_OPERATION_SUCCESS_'));
		}else{
			$this->error(L('_OPERATION_FAIL_'));
		}
	}
}