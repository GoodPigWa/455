<?php
namespace Admin\Controller;
use Think\Controller;
class RoleController extends Controller {
	function index(){

		$AuthGroupModel = D('AuthGroup');
		$result = $AuthGroupModel->getGroup();
		$this->assign('result',$result);
		$this->display();
	}
	function add(){
		$this->display();
	}
}