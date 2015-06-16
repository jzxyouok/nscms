<?php
// Home模块公共函数

/**
 * 获取banner列表
 * @return array banner二维数组
 */
function get_banner_list(){
	return M('banner')->select();
}

/**
 * 获取文章列表
 * @param  int  $catid   栏目ID
 * @param  integer $p        页码
 * @param  integer $pageRows 每页数量
 * @return array         文章列表二维数组
 */
function get_article_list($catid, $pageRows, $p = 1){
	$articleModel = M('article');

	return M('article')->where(array('pid'=>$catid,'isnav'=>1))->order('istop desc,sort desc')->page($p, $pageRows)->select();
}

function get_list_page_show($catid, $pageRows){
	$articleModel = M('article');
	$count = $articleModel->where(array('pid' => $catid))->count();
	$pageInstance = new \Think\Page($count, $pageRows);
	foreach (C('PAGE_CONFIG') as $key => $value) {
		$pageInstance->setConfig($key,$value);
	}
	return $pageInstance->show();
}

/**
 * 获取碎片内容
 * @param  int $id 碎片ID
 * @return array   碎片数组
 */
function get_piece($id){
	return M('piece')->find($id);
}

function generate_category_url($catid){
	$categoryType = get_category_type_no($catid);
	switch ($categoryType) {
		case 0:
			return get_custom_link_url($catid);
			break;

		case 1:
			return U('Index/showPage', array('id' => $catid));
			break;
		
		case 2:
			return U('Index/listArticle', array('catid' => $catid));
			break;
	}
}

function get_custom_link_url($linkid){
	return M('custom_link')->where(array('linkid'=>$linkid))->getField('href');
}

/**
 * 获取子栏目
 * @param int $pid 父级栏目ID
 * @return array 子栏目数组
 */
function get_sub_nav($pid = 0){
	return M('category')->where(array('pid'=>$pid,'isnav'=>1))->order('sort desc')->select();
}

function get_next_article_id($id){
	$idArray = M('article')->getField('id', true);
	for ($i=0; $i < count($idArray); $i++) { 
		if($idArray[$i] == $id){
			$index = $i - 1;
			if($index < 0){
				return -1;
			}
			return $idArray[$index];
		}
	}
}

function get_prev_article_id($id){
	$idArray = M('article')->getField('id', true);
	for ($i=0; $i < count($idArray); $i++) { 
		if($idArray[$i] == $id){
			$index = $i + 1;
			if($index > count($idArray) - 1){
				return -1;
			}
			return $idArray[$index];
		}
	}
}