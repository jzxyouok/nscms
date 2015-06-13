<?php
namespace Admin\Controller;
use Think\Controller;
class PublicController extends Controller {

	public function index(){
		$this->display(MODULE_NAME.'/index');
	}

	public function login(){
		$this->display(MODULE_NAME.'/login.html');
	}
}