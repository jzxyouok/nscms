<?php
namespace Admin\Controller;
use Think\Controller;
class PieceController extends CommonController {
	// 
	public function listPiece(){
		$this->pieceList = M('piece')->order('sort desc')->select();
		$this->display('Admin/listPiece');
	}

	public function addPiece(){
		$this->display('Admin/addPiece');
	}

	public function pieceAdd(){
		if(IS_POST){
			$pieceModel = M('piece');
			if($pieceModel->create()){
				$insertId = $pieceModel->add();
				if($insertId)
					$this->success(L('_OPERATION_SUCCESS_'));
			}
		}
	}

	public function editPiece(){
		$id = I('get.id');
        $this->pieceItem = M('piece')->find($id);
        $this->display('Admin/editPiece');
	}

	public function pieceEdit(){
		if(IS_POST){
			$pieceModel = M('piece');
			if($pieceModel->create()){
				$insertId = $pieceModel->save();
				if($insertId)
					$this->success(L('_OPERATION_SUCCESS_'));
			}
		}
	}

	public function deletePiece(){
        //获取ajax提交的ID数组
        $ids = I('post.ids');
        //循环删除
        $pieceModel = M('piece');
        $success = 0;
        foreach ($ids as $id) {
            $affectedRows = $pieceModel->delete($id); // 从数据库删除记录

            if($affectedRows)
                $success++;
        }        
        //判断成功数目
        if($success == count($ids))
            $this->success(L('_OPERATION_SUCCESS_'),U('listPiece'));
        else
            $this->error(L('_OPERATION_FAIL_'),U('listPiece'));
    }
}