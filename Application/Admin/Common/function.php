<?php
//Admin模块函数库

/**
 * 返回栏目所属层级
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
