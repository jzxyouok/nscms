<?php
namespace Admin\Controller;
use Think\Controller;
class CustomLinkController extends CommonController {

	public function customLinkAdd($linkId){
		return M('custom_link')->data(array('linkid'=>$linkId))->add();
	}

	public function customLinkDelete($linkId){
		return M('custom_link')->delete($linkId);
	}

	// 编辑自定义链接
    public function editCustomLink(){
        $linkId = I('get.linkid');
        $this->customLinkItem = M('custom_link')->find($linkId);
        $this->display(MODULE_NAME.'/editCustomLink');
    }

    // 编辑自定义链接（post提交处理）
    public function customLinkEdit(){
        // $customLinkItem['linkid'] = I('post.linkid');
        // $customLinkItem['href'] = I('post.href');
        $affectedRows = M('custom_link')->save(I('post.'));
        if($affectedRows)
            $this->success(L('_OPERATION_SUCCESS_'));
    }
}