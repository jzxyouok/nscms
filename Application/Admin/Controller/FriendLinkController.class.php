<?php
namespace Admin\Controller;
use Think\Controller;
class FriendLinkController extends CommonController {

    public function listFriendLink(){
        $this->dataList = M('friend_link')->order('sort desc,id')->select();
        $this->display(MODULE_NAME.'/listFriendLink');
    }

    public function addFriendLink(){
        $this->display(MODULE_NAME.'/addFriendLink');
    }

    public function friendLinkAdd(){
        if(IS_POST){
            $model = M('friend_link');
            if(true == $model->create()){
                $insertId = $model->add();
                if(true == $insertId){
                    $this->success(L('_OPERATION_SUCCESS_'));
                }
            }
        }
    }

    public function editFriendLink(){
        $id = I('get.id');
        $this->item = M('friend_link')->find($id);
        $this->display(MODULE_NAME.'/editFriendLink');
    }

    public function friendLinkEdit(){
        if(IS_POST){
            $model = M('friend_link');
            if(true == $model->create()){
                $affectRows = $model->save();
                if(true == $affectRows){
                    $this->success(L('_OPERATION_SUCCESS_'));
                }else{
                    $this->error(L('NOTHING_CHANGED'));
                }
            }
        }
    }
}