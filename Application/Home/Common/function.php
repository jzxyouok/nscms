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
function get_article_list($catid, $p = 1, $pageRows = 0){
	$articleModel = M('article');
	if($pageRows == 0)
		$pageRows = $articleModel->where(array('pid'=>$catid))->count();
	return M('article')->where(array('pid'=>$catid))->order('istop desc,sort desc')->page($p, $pageRows)->select();
}

/**
 * 获取碎片内容
 * @param  int $id 碎片ID
 * @return array   碎片数组
 */
function get_piece($id){
	return M('piece')->find($id);
}