<?php
namespace Admin\Controller;
use Think\Controller;
class BannerController extends CommonController {

	// banner列表
    public function listBanner(){
        $this->bannerList = M('banner')->order('sort desc')->select();
        $this->display('Admin/listBanner');
    }

    // 添加banner
    public function addBanner(){
        $this->display('Admin/addBanner');
    }

    public function bannerAdd(){
        // if($_FILES['bannerImg']['error'] != 0){// 判断有没有上传图片
        //     $this->error(L('NO_UPLOAD_FILE'));
        // }else{
        //     $bannerUpload = new \Think\Upload(C('bannerUpload'));// 实例化上传类
        //     $bannerInfo = $bannerUpload->upload();
        //     if(!$bannerInfo) {// 上传错误提示错误信息
        //         $this->error($bannerUpload->getError());
        //     }else{// 上传成功
        //         $insertUploadId = M('uploads')->add($bannerInfo['bannerImg']);// 将上传成功的文件信息写入uploads表
        //         if($insertUploadId){// banner表添加记录
        //             $bannerData['imgpath'] = $bannerInfo['bannerImg']['savepath'].$bannerInfo['bannerImg']['savename'];
        //             $bannerData['href'] = I('post.href') ? I('post.href') : '';
        //             $insertBannerId = M('banner')->add($bannerData);
        //             if($insertBannerId)
        //                 $this->success(L('_OPERATION_SUCCESS_'));
        //             else
        //                 $this->error(L('_OPERATION_FAIL_'));
        //         }else{
        //             $this->error(L('_OPERATION_FAIL_'));
        //         }
        //     }
        // }
        if(empty(I('post.uploadfileid')))
            $this->error(L('NO_UPLOAD_FILE'));
        $bannerModel = M('banner');
        if($bannerModel->create()){
            $insertId = $bannerModel->add();
            if($insertId)
                $this->success(L('_OPERATION_SUCCESS_'));
            else
                $this->error(L('_OPERATION_FAIL_'));
        }
    }

    //编辑banner
    public function editBanner(){
        $id = I('get.id');
        $this->bannerItem = M('banner')->find($id);
        $this->display('Admin/editBanner');
    }

    // 编辑banner(post提交处理)
    public function bannerEdit(){
        // if($_FILES['bannerImg']['error'] != 0){// 判断有没有上传图片
        //     $affectedRows = M('banner')->save(I('post.'));
        //     if($affectedRows)
        //         $this->success(L('_OPERATION_SUCCESS_'));
        //     else
        //         $this->error(L('_OPERATION_FAIL_'));
        // }else{
        //     $bannerUpload = new \Think\Upload(C('bannerUpload'));// 实例化上传类
        //     $bannerInfo = $bannerUpload->upload();
        //     if(!$bannerInfo) {// 上传错误提示错误信息
        //         $this->error($bannerUpload->getError());
        //     }else{// 上传成功
        //         $insertUploadId = M('uploads')->add($bannerInfo['bannerImg']);// 将上传成功的文件信息写入uploads表
        //         if($insertUploadId){// banner表修改记录
        //             $bannerData['imgpath'] = $bannerInfo['bannerImg']['savepath'].$bannerInfo['bannerImg']['savename'];
        //             $bannerData['href'] = I('post.href') ? I('post.href') : '';
        //             $bannerData['id'] = I('post.id');
        //             $affectedRows = M('banner')->save($bannerData);
        //             if($affectedRows)
        //                 $this->success(L('_OPERATION_SUCCESS_'));
        //             else
        //                 $this->error(L('_OPERATION_FAIL_'));
        //         }else{
        //             $this->error(L('_OPERATION_FAIL_'));
        //         }
        //     }
        // }
        if(IS_POST){
            $bannerModel = M('banner');
            if($bannerModel->create()){
                $insertId = $bannerModel->save();
                if($insertId)
                    $this->success(L('_OPERATION_SUCCESS_'));
                else
                    $this->error(L('_OPERATION_FAIL_'));
            }
        }
    }

    //删除banner
    public function deleteBanner(){
        //获取ajax提交的ID数组
        $ids = I('post.ids');
        //循环删除
        $bannerModel = M('banner');
        $success = 0;
        foreach ($ids as $id) {
            $affectedRows = $bannerModel->delete($id); // 从数据库删除记录

            if($affectedRows)
                $success++;
        }        
        //判断成功数目
        if($success == count($ids))
            $this->success(L('_OPERATION_SUCCESS_'),U('listBanner'));
        else
            $this->error(L('_OPERATION_FAIL_'),U('listBanner'));
    }

    //排序banner ajax提交处理
    public function sortBanner(){
        //获取排序数组，ID数组
        $sorts = I('post.sorts');
        $ids = I('post.ids');
        //更新排序字段
        $bannerModel = M('banner');
        for ($i=0, $success = 0; $i < count($sorts); $i++) {
            $result = $bannerModel->where('id='.$ids[$i])->setField('sort', intval($sorts[$i]));
            if($result)
                $success++;
        }
        $this->success(L('_OPERATION_SUCCESS_'), U('listBanner'));
    }
}