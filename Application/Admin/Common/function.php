<?php
//Admin模块公共函数库

function get_gid($uid){
	return M('admin')->where(array('uid'=>$uid))->getField('gid');
}

function get_account($uid){
	return M('admin')->where(array('uid'=>$uid))->getField('account');
}