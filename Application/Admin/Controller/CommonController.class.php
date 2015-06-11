<?php
namespace Admin\Controller;
use Think\Controller;
class CommonController extends Controller {

	public function _initialize(){
        //定义后台模板目录
		define('TPL_PATH',__ROOT__.'/'.MODULE_PATH.'View/'.MODULE_NAME);
	}

	//ajax执行后的信息提示
    public function showMsg(){
        $ajaxReturn = I('post.');
        if($ajaxReturn['status'] == 1)
            $this->success($ajaxReturn['info'], $ajaxReturn['url']);
        else
            $this->error($ajaxReturn['info'], $ajaxReturn['url']);
    }
    
    // kindeditor上传图片处理
    public function kindeditorImageUpload(){
    $upload = new \Think\Upload(C('kindeditorImageUpload'));// 实例化上传类
        $info = $upload->upload();
        if(!$info) {// 上传错误提示错误信息
            echo json_encode(array('error' => 1, 'message' => $upload->getError()));
        }else{// 上传成功
            $insertUploadId = M('uploads')->add($info['imgFile']);// 将上传成功的文件信息写入uploads表
            echo json_encode(array('error' => 0, 'url' => __ROOT__.'/'.C('kindeditorImageUpload.rootPath').$info['imgFile']['savepath'].$info['imgFile']['savename']));
        }
    }
}