<?php
namespace Admin\Controller;
use Think\Controller;
class ArticleController extends CommonController {

	public function listArticle(){
		$articleModel = M('article');
		$get = I('get.');
		$p = (false == $get['p']) ? 1 : $get['p'];

		$this->articleList = $articleModel->where(array('pid' => $get['catid']))->order('istop desc,sort desc,updatetime desc')->page($p, C('PAGE_ROWS'))->select();
		
		$count = $articleModel->where(array('pid' => $get['catid']))->count();
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
				$content = I('post.content');
				$articleData = array(
					'articleid' => $insertId,
					'content' => $content,
				);
				$insertDataId = M('article_data')->add($articleData);
				if($insertDataId)
					$this->success(L('_OPERATION_SUCCESS_'));
			else
				$this->error(L('_OPERATION_FAIL_'));
		}
	}

	public function editArticle(){
		$id = I('get.id');
		$this->articleItem = M('article')->find($id);
		$this->articleDataItem = M('article_data')->find($id);
		$this->display(MODULE_NAME.'/editArticle');
	}

	public function articleEdit(){
		if(IS_POST){
			$articleModel = M('article');
			$articleModel->create();
			$articleModel->updatetime = time();
			$affectedRows = $articleModel->save();
			if($affectedRows)
				$post = I('post.');
				$articleData = array(
					'articleid' => $post['id'],
					'content' => $post['content'],
				);
				$affecteDataRows = M('article_data')->save($articleData);
				if($affecteDataRows)
					$this->success(L('_OPERATION_SUCCESS_'));
			else
				$this->error(L('_OPERATION_FAIL_'));
		}
	}
}