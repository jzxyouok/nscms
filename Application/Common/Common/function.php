<?php
// Common公共函数

/**
 * 返回模板路径（用来加载静态文件）
 * @return string 模板路径
 */
function get_tpl_path(){
	return __ROOT__ . '/' . C('VIEW_PATH') . C('DEFAULT_THEME') . '/' . MODULE_NAME;
}

/**
 * 获取子栏目
 * @param int $pid 父级栏目ID
 * @return array 子栏目数组
 */
function get_sub_category($pid = 0){
	return M('category')->where('pid='.$pid)->order('sort desc')->select();
}

/**
 * 判断是否有子栏目
 * @param  int  $catid 栏目ID
 * @return boolean     true有，false否
 */
function has_sub_category($catid){
	$pids = M('category')->group('pid')->field('pid')->select();
	foreach ($pids as $value) {
		if($value['pid'] == $catid)
			return true;
	}
	return false;
}

/**
 * 获取栏目类型编号
 * @param  int $catid 栏目ID
 * @return int        类型编号
 */
function get_category_type_no($catid){
	return M('category')->where('id='.$catid)->getField('type');
}

/**
 * 获取附件路径
 * @param  int $id 附件ID
 * @return string  附件路径
 */
function get_uploadfile_path($id){
	$item = M('uploads')->find($id);
	if($item)
		return __ROOT__ . '/Uploads/' . $item['savepath'] . $item['savename'];
	else
		return __ROOT__ . '/Public/images/nasen_logo.jpg';
}


/**
 * 获取banner列表
 * @return array banner二维数组
 */
function get_banner_list(){
	return M('banner')->select();
}

function get_article_list($catid, $p = 1, $pageRows = 0){
	$articleModel = M('article');
	if($pageRows == 0)
		$pageRows = $articleModel->where(array('pid'=>$catid))->count();
	return M('article')->where(array('pid'=>$catid))->order('istop desc,sort desc')->page($p, $pageRows)->select();
}