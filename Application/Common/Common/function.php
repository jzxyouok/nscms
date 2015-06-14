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
 * 验证验证码
 * @param  string $code 验证码字符串
 * @param  string $id   验证码编号
 * @return boolean      布尔值结果
 */
function check_verify($code, $id = ''){
    $verify = new \Think\Verify();
    return $verify->check($code, $id);
}