<?php
//Admin模块函数库

/**
 * 获取栏目所属层级
 * @param  int $catid 栏目ID
 * @return int 栏目所属层级
 */
function get_category_level($catid){
	$level = 1;
	$pid = $catid;
	do {
		$pid = M('category')->where('id='.$pid)->getField('pid');
		if($pid!=0){
			$level++;
		}
	} while ($pid!=0);
	return $level;
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
 * 获取栏目类型名称
 * @param int $type 类型编号
 * @return string 栏目类型
 */
function get_category_type_name($type = 0){
	switch ($type) {
		case 1:
			return L('ARTICLE_TYPE');
			break;
		
		case 2:
			return L('IMAGE_TYPE');
			break;
		
		case 3:
			return L('PAGE_TYPE');
			break;
		
		default:
			return L('CUSTOM_TYPE');
			break;
	}
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
 * 根据1和0返回是否
 * @param int $binary 1或0
 * @return string 是或否
 */
function get_yes_no($binary){
	if($binary == 1)
		return L('YES');
	else
		return L('NO');
}

/**
 * 获取(父)栏目名称
 * @param int $catid (父)栏目ID
 * @return string (父)栏目名称
 */
function get_catname($pid = 0){
	if($pid == 0)
		return '';
	else
		return M('category')->where('id='.$pid)->getField('catname');
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
 * 获取附件路径
 * @param  int $id 附件ID
 * @return string  附件路径
 */
function get_uploadfile_path($id){
	$item = M('uploads')->find($id);
	return __ROOT__.'/Uploads/'.$item['savepath'].$item['savename'];
}