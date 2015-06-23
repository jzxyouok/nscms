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

function get_uniqid($uid){
	return M('admin')->where(array('uid'=>$uid))->getField('uniqid');
}

/*删除指定目录下的文件(递归删除)，保留文件夹*/
function emptyDir($dir) {
  $dh=opendir($dir);
  while ($file=readdir($dh)) {
    if($file!="." && $file!="..") {
      $fullpath=$dir."/".$file;
      if(!is_dir($fullpath)) {
          $status = unlink($fullpath);
          if(false == $status){
              return false;
          }
      } else {
          emptyDir($fullpath);
      }
    }
  }
  closedir($dh);
  return true;
}
