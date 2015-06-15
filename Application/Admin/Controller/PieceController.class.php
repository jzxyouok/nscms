<?php
namespace Admin\Controller;
use Think\Controller;
class PieceController extends CommonController {
	// 
	public function listPiece(){
		$this->pieceList = M('piece')->order('sort desc,id')->select();
		$this->display(MODULE_NAME.'/listPiece');
	}

	public function addPiece(){
		$this->display(MODULE_NAME.'/addPiece');
	}

	public function pieceAdd(){
		if(IS_POST){
			$pieceModel = M('piece');
			if(true == $pieceModel->create()){
				$insertId = $pieceModel->add();
				if(true == $insertId){
					$this->success(L('_OPERATION_SUCCESS_'));
				}
			}
		}
	}

	public function editPiece(){
		$id = I('get.id');
        $this->pieceItem = M('piece')->find($id);
        $this->display(MODULE_NAME.'/editPiece');
	}

	public function pieceEdit(){
		if(IS_POST){
			$pieceModel = M('piece');
			if(true == $pieceModel->create()){
				$affectRows = $pieceModel->save();
				if(true == $affectRows){
					$this->success(L('_OPERATION_SUCCESS_'));
				}else{
					$this->error(L('NOTHING_CHANGED'));
				}
			}
		}
	}
}