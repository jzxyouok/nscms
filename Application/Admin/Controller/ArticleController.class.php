<?php
namespace Admin\Controller;
use Think\Controller;
class ArticleController extends CommonController {

	public function listArticle(){
		$articleModel = M('article');

		$p = empty(I('get.p')) ? 1 : I('get.p');

		$this->articleList = $articleModel->where(array('pid' => I('get.catid')))->order('istop desc,sort desc')->page($p, C('PAGE_ROWS'))->select();
		
		$count = $articleModel->where(array('pid' => I('get.catid')))->count();
		$pageInstance = new \Think\Page($count, C('PAGE_ROWS'));
		foreach (C('PAGE_CONFIG') as $key => $value) {
			$pageInstance->setConfig($key,$value);
		}
		$this->show = $pageInstance->show();

		$this->display(MODULE_NAME.'/listArticle');
	}

	public function addArticle(){
		$this->display(MODULE_NAME.'/addArticle');
	}

	public function articleAdd(){
		if(IS_POST){
			$articleModel = M('article');
			$articleModel->create();
			$articleModel->updatetime = time();
			$insertId = $articleModel->add();
			if($insertId)
				$this->success(L('_OPERATION_SUCCESS_'));
			else
				$this->error(L('_OPERATION_FAIL_'));
		}
	}

	public function editArticle(){
		$this->articleItem = M('article')->find(I('get.id'));
		$this->display(MODULE_NAME.'/editArticle');
	}

	public function articleEdit(){
		if(IS_POST){
			$articleModel = M('article');
			$articleModel->create();
			$articleModel->updatetime = time();
			$affectedRows = $articleModel->save();
			if($affectedRows)
				$this->success(L('_OPERATION_SUCCESS_'));
			else
				$this->error(L('_OPERATION_FAIL_'));
		}
	}
}