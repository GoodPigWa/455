<?php
namespace Admin\Controller;
use Think\Controller;

class MenberController extends Controller{
	public function login(){

		if(IS_POST){
			$username = I('post.username','');
			$password = I('post.password','');
			$code = I('post.verify','');

		  
		     $verify = new \Think\Verify();   
		     $check = $verify->check($code);
			 
			
			$menberModel = M('member');
			$where['username'] = $username;
			$data = $menberModel->where($where)->find();
			if($check){
				if($data){
					if($data['password'] == $password){
						session('member',array(
							'uid' =>$data['id'],
							'username' =>$username
								)
							);
						$this->success('成功',U('index/index'));
						exit();
					}
					else{
						$this->error('密码错误',U('menber/login'));
						exit();
					}
				
				}else{
					$this->error('用户名错误',U('menber/login'));
					exit();
				}
			}
			else{
				$this->error('验证码错误',U('menber/login'));
				exit();
			}
			
		}
		$this->display();
	}

	public function index(){
		$this->display();
	}

	public function test(){
        
        $Verify = new \Think\Verify();
        $Verify->entry();

       
    }
    public function gain()
    {
    	echo U('Menber/test');
    }

}