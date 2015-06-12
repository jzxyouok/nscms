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
        $upload = new \Think\Upload(C('UPLOAD_CONFIG.editor'));// 实例化上传类
        $info = $upload->upload();
        if(!$info) {// 上传错误提示错误信息
            echo json_encode(array('error' => 1, 'message' => $upload->getError()));
        }else{// 上传成功
            $insertUploadId = M('uploads')->add($info['imgFile']);// 将上传成功的文件信息写入uploads表
            echo json_encode(array('error' => 0, 'url' => get_uploadfile_path($insertUploadId)));
        }
    }

    // jquery.fileupload上传处理
    public function jqueryFileUpload(){
        $upload = new \Think\Upload(C('UPLOAD_CONFIG.'.I('post.inputName')));// 实例化上传类
        $info = $upload->upload();
        if(!$info) {// 上传错误提示错误信息
            $this->error($upload->getError());
        }else{// 上传成功
            $insertUploadId = M('uploads')->add($info[I('post.inputName')]);// 将上传成功的文件信息写入uploads表
            if($insertUploadId){
                $ajaxReturn['status'] = 1;
                $ajaxReturn['info'] = L('_OPERATION_SUCCESS_');
                $ajaxReturn['uploadfileid'] = $insertUploadId;
                $this->ajaxReturn($ajaxReturn);
            }
        }
    }


    public function test(){
        echo get_uploadfile_path(37);
        //$this->display('Admin/test');
        //echo array_multiToSingle(array('aa' => array('bb' => 'cc')));
    }
}