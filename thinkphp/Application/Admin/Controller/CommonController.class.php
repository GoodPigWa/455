<?php
namespace Admin\Controller;
use Think\Controller;

class CommonController extends Controller{

	protected $uid;
	public function _initialize(){
		if(session('?member')){
			$this->uid = session('member')['uid'];
		}
		else{
			$this->error('请登录',U('public/login'));
			exit();
		}

		$auth = new \Think\Auth();
		// echo('CONTROLLER_NAME ');
		// die();
        $result = $auth->check('CONTROLLER_NAME .'/'. ',$this->uid);
       if(!$result){
       	// echo "无权访问";
       }
	}
}