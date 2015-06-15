<?php
namespace Admin\Controller;
use Think\Controller;
class BannerController extends CommonController {

	// banner列表
    public function listBanner(){
        $this->bannerList = M('banner')->order('sort desc,id')->select();
        $this->display(MODULE_NAME.'/listBanner');
    }

    // 添加banner
    public function addBanner(){
        $this->display(MODULE_NAME.'/addBanner');
    }

    public function bannerAdd(){
        $uploadfileid = I('post.uploadfileid');
        if(false == $uploadfileid){
            $this->error(L('NO_UPLOAD_FILE'));
        }
        $bannerModel = M('banner');
        if($bannerModel->create()){
            $insertId = $bannerModel->add();
            if($insertId){
                $this->success(L('_OPERATION_SUCCESS_'));
            }else{
                $this->error(L('_OPERATION_FAIL_'));
            }
        }
    }

    //编辑banner
    public function editBanner(){
        $id = I('get.id');
        $this->bannerItem = M('banner')->find($id);
        $this->display(MODULE_NAME.'/editBanner');
    }

    // 编辑banner(post提交处理)
    public function bannerEdit(){
        if(IS_POST){
            $bannerModel = M('banner');
            if($bannerModel->create()){
                $affectedRows = $bannerModel->save();
                if($affectedRows){
                    $this->success(L('_OPERATION_SUCCESS_'));
                }else{
                    $this->error(L('_OPERATION_FAIL_'));
                }
            }
        }
    }
}