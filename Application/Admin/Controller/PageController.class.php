<?php
namespace Admin\Controller;
use Think\Controller;
class PageController extends CommonController {

	public function pageAdd($pageId){
		return M('page')->data(array('pageid'=>$pageId))->add();
	}

	public function pageDelete($pageId){
		return M('page')->delete($pageId);
	}

	// 编辑单页内容
    public function editPage(){
        $pageId = I('get.pageid');
        $this->pageItem = M('page')->find($pageId);
        $this->display(MODULE_NAME.'/editPage');
    }

    // 编辑单页内容（post提交处理）
    public function pageEdit(){
        $pageModel = M('page');
        $pageModel->create();
        $affectedRows = $pageModel->save();
        if(true == $affectedRows){
            $this->success(L('_OPERATION_SUCCESS_'));
        }
    }
}