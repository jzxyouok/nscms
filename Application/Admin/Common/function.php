<?php
//Admin模块公共函数库

function get_gid($uid){
	return M('admin')->where(array('uid'=>$uid))->getField('gid');
}

function get_account($uid){
	return M('admin')->where(array('uid'=>$uid))->getField('account');
}

/**
 * 判断栏目下是否有文章
 * @param  int  $catid 栏目ID
 * @return boolean     true有，false否
 */
function has_article($catid){
	$pids = M('article')->group('pid')->field('pid')->select();
	foreach ($pids as $value) {
		if($value['pid'] == $catid)
			return true;
	}
	return false;
}