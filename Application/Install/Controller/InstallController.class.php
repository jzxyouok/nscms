<?php
namespace Install\Controller;
use Think\Controller;
class InstallController extends Controller {

	public function install(){

		// 检测是否已经安装
		if(true == get_config('installed')){
			$this->error(L('_ERROR_ACTION_').',程序已经安装,请不要重复执行',  U('Home/Index/index'));
		}
		// 添加超级管理员
		$accountData = array(
			'account' => 'nasen',
			'gid' => 0,
			'password' => md5('123456'),
		);
		$insertId = M('admin')->add($accountData);
		// 添加SEO配置
		$configData[] = array(
			'name' => 'seo_title',
			'value' => '纳森科技-领先的网站建设公司-响应式网站|企业网站建设|自适应网站制作-专业-高端！',
		);
		$configData[] = array(
			'name' => 'seo_keywords',
			'value' => '呼和浩特网站建设,呼市网络公司,呼和浩特做网站,呼和浩特响应式网站,呼和浩特自适应网站,内蒙古网络公司,内蒙古网站制作,内蒙古网站建设与开发',
		);
		$configData[] = array(
			'name' => 'seo_description',
			'value' => '纳森科技-领先的网站建设公司-响应式网站|企业网站建设|自适应网站制作-专业-高端！',
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