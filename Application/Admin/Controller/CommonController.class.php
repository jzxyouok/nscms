<?php
namespace Admin\Controller;
use Think\Controller;
class CommonController extends Controller {

	public function _initialize(){
        // 验证安装
        if(true != get_config('installed')){
            $this->redirect('Install/Install/index');
        }
        // 验证登陆
        if(!session('?uid'))
            $this->error(L('PLEASE_LOGIN'), U('Public/login'));
	}

    public function index(){
        $this->display(MODULE_NAME.'/index');
    }

    public function signOut(){
        session('uid', null);
        $this->success(L('_OPERATION_SUCCESS_'), U('Public/login'));
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
        $upload = new \Think\Upload(C('IMG_UPLOAD'));// 实例化上传类
        $upload->savePath = 'editor/';
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
        $upload = new \Think\Upload(C('IMG_UPLOAD'));// 实例化上传类
        $upload->savePath = I('post.inputName') . '/';
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

    //排序 ajax提交处理
    public function sort(){
        //获取排序数组，ID数组
        $sorts = I('post.sorts');
        $ids = I('post.ids');
        //更新排序字段
        $model = M(I('get.table'));
        for ($i=0, $success = 0; $i < count($sorts); $i++) {
            $result = $model->where('id='.$ids[$i])->setField('sort', intval($sorts[$i]));
            if($result)
                $success++;
        }
        $this->success(L('_OPERATION_SUCCESS_'));
    }

    //删除
    public function delete(){
        //获取ajax提交的ID数组
        $ids = I('post.ids');
        //循环删除
        $model = M(I('get.table'));
        $success = 0;
        foreach ($ids as $id) {
            $affectedRows = $model->delete($id); // 从数据库删除记录

            if($affectedRows)
                $success++;
        }        
        //判断成功数目
        if($success == count($ids))
            $this->success(L('_OPERATION_SUCCESS_'));
        else
            $this->error($model->getError());
    }

    public function test(){
        // echo get_account(5);
    }
}