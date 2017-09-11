<?php
namespace Home\Controller;
use Think\Controller;


class CommonController extends Controller{

	protected $user_id;

	public function _initialize(){
		if(session('?user')){
			$this->user_id = session('user')['user_id'];
		}
		else{
			$this->error('请先登录',U('User/login'));
			exit();
		}
	}
}