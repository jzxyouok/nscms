<?php
//Admin模块公共函数库

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
 * 获取栏目类型名称
 * @param int $type 类型编号
 * @return string 栏目类型
 */
function get_category_type_name($type = 0){
	switch ($type) {

		case 0:
			return L('CUSTOM_TYPE');
			break;

		case 1:
			return L('PAGE_TYPE');
			break;
		
		case 2:
			return L('ARTICLE_TYPE');
			break;
		
	}
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