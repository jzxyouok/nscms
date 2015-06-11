<?php
namespace Admin\Controller;
use Think\Controller;
class PieceController extends CommonController {
	// 
	public function listPiece(){
		$this->display('Admin/listPiece');
	}

	public function addPiece(){
		$this->display('Admin/addPiece');
	}

	public function pieceAdd(){
		dump(I('post.'));
	}

	public function test(){
		file_put_contents('./test.txt', 'taest');
	}
}