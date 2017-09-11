<?php
namespace Home\Controller;
use Think\Controller;
// use Think\Model;
// use Home\Model\UserModel;

class UserController extends Controller{

	public function index(){


		// $userModel = D('User');
		// $users = $userModel->relation(true)->select();

		// $userCartModel = D('UserCart');
		// $usercart = $userCartModel->relation(true)->select();

		$userModel = D('User');
		$users = $userModel->relation(true)->select();
		dump($users);
		//1. 实例化基类-Model,导入Think\Model
		// $userModel = new \Think\Model('user');
		// 2.实例化自定义的模型类
		// $userModel = new UserModel;
		// 3.M()方法  实例化基类Think\Model   效率比较高   new \Think\Model()

		// 自动验证-静态验证

		
		// $_POST = array(
		// 		'user' => 'fscsd',
		// 		'password'=>'1cds231',
		// 		'gender'  =>'nan'
  // 			);
		// $userModel = D('user');


		// if($userModel->create()){
		// 	echo "数据格式符合要求";
		// }
		// else{
		// 	echo $userModel->getError();
		// }

		// 删除
		// echo $userModel->delete(6);
		// echo $userModel->where('id>3')->delete();

		// 修改
		 // $data = array(
         // 		'password' => '123'
         // 	);
         // 	$result = $userModel->where('id>4')->save($data);

		// 增加
		// $userModel->user = ':user';
		// $userModel->password = ':password';

		// $bind[':user'] = $_POST['user'];
		// $bind[':password'] = $_POST['password'];

		// $id = $userModel->bind($bind)->add();
  //        echo $id;
		// $users = $userModel->cache(true)->select();
		// $users = $userModel->getUser();


		// 第一种
		// $data = $userModel->create($_POST);
		// if($data){
		// 	$result = $userModel->add();


         // 修改的时候，$_POST应加上主键
         	// $result = $userModel->save();
		// 	dump($result);
		// }
		// else{
		// 	echo "数据不合法";
		// }

		// 第二种// 如果不使用create方法，则$userModel->add($_POST);  
         // 第三种// $userModel->data($_POST)->add();
		// dump($data);

		// dump($userModel->getByid(2));
		// $user = $userModel->getBypassword('1231');
		// dump($user);
		// dump($userModel->getFieldbyuser('gdv'),'id');

         // echo $userModel->count();


       // 查询方式  字符串条件查询
		// $user=$userModel->where('id=1 and user = "fs"')->select();
		// dump($user);

		// 索引数组条件查询
		// $where['id']>1;
		// $where['user']='fs';
		// $where['_logic'] = 'OR';
		// $user=$userModel->where($where)->select();
		// dump($user);


		// 对象条件查询
		// $condition = new \stdClass();
		// $condition -> id=2;
		// $condition ->user ='gdv';
		// $condition ->_logic = 'OR';
		// $user=$userModel->where($condition)->select();
		// dump($user);

		// 表达式查询
		// $map['id'] = array('lt',2);
		// $map['id'] = array('gt',1);
		// $map['id'] = array('between','2,3');
		// $map['id'] = array('NOTbetween','2,3');
		// $map['id'] = array('exp','between "1" and "2"');
		// $map['user'] = array('like','%f%');
		// $map['id'] = array('elt','2');
		// $map['id'] = array('neq','2');
		// $user=$userModel->where($map)->select();
		// dump($user);

		// 快捷查询
		// 不同字段相同查询
		// $map['user|password'] = '1231';
		// $map['user&password'] = '1231';

		// 不同字段不同查询
		// $map['user|password'] = array('fs','1231','_multi'=>true);
		//  $user=$userModel->where($map)->select();
		// dump($user);


		//  $map['user|password'] = array(array('like','%f%'),'1231','_multi'=>true);
		// $user=$userModel->where($map)->select();
		// dump($user);

		// $map['id'] = array(array(gt,1),array(lt,3));
		// $user=$userModel->where($map)->select();
		// dump($user);


		// 4.D()方法   支持跨模块   实例化自定义模型类  自定义不存在Think\Model   new \Think\Model\userModel()
		// $userModel = D('user');

		// dump($userModel->getDbFields());
		// dump($userModel = getUser());

		// dump($userModel->select());
	}

	public function login(){
		if(IS_POST){
			$transUrl = I('post.transUrl','');

			if(empty($transUrl)){
				$transUrl = U('Product/index');
			}
			
			$username = I('post.username','');
			$password = I('post.password','');

			$userModel = M('user');
			$map['user'] = $username;
		    $user = $userModel->where($map)->find();
	
		    if($user){
        
		    	if($user['password'] == $password){
		    		session('user',array(
		    			'user_id' =>$user['user_id'],
		    			'user'=>$username
		    			));

		    		$this->success('成功登陆',$transUrl);
		    	}
		    	
		    	
		    }
		}
		$transUrl = $_SERVER['HTTP_REFERER'];
		$this->assign('transUrl',$transUrl);
		
		$this->display();
	}

	public function register(){
		echo '<meta charset="UTF-8">';

		if(IS_POST){
			// 实例化模型
			$userModel = D('user');
				$validate = array(
			 		array('password','6,32','密码长度在6到32位之间',1,'length'),
			 		array('passwordRepeat','password','两次密码输入不一致',1,'confirm')
				);
				$auto = array(
				 	array('add_time','time',1,'function'),
				 	array('updata_time','time',3,'function'),
				 	array('password','md5',3,'function'),
				);
			// 创建数据，会自动调用静态验证
			if($_POST['action'] == 'email'){
				$validate[] = array('email','email','邮件格式输入不正确',1);
				$validate[] = array('email','','邮件已经存在',1,'unique');


				$auto[] = array('user','email',1,'field');
			
			}else if($_POST['action'] == 'mobile'){
				$validate[] = array('mobile','/^1\d{10}$/','手机号格式不正确',1,'regex');
			 	$validate[] = array('mobile','','手机号已经存在',1,'unique');
				
				$auto[] = array('user','mobile',1,'field');
			}

			$this->assign('action',$_POST['action']);

			$_POST['token'] = mt_rand(1000,9999);

			if($userModel->validate($validate)->create()){

				$userModel->auto($auto)->create();
				
				$userid = $userModel->add();

				$userActive = M('userActive');
				$userActive->add(
					array('user_id'=>$userid,'active_time'=>time(),'end_time'=>time()+2*60)
				);

				$param = "userid=".$userid."&token=".$_POST['token'];
				$param = base64_encode($param);
				$to_email = $_POST['email'];
				$title = '注册邮件激活 -【商城】';
				$msg  = '注册成功请点击<a href="'.C('SERVER_root').':88'.'/'.U('User/activeUser',array("param"=>$param)).'">链接</a>进行激活';
				
				$con = C('SERVER_root');
				$msg  .= '<p>或选择链接"'.C('SERVER_root').':88'.'/'.U('User/activeUser',array("param"=>$param)).'"</p>';
				$userModel->add();
				send_mail($to_email,$title,$msg);
				$this->success('用户注册成功',U('User/login'),3);
				exit();
			}
			else{
				$error = $userModel->getError();
				$this->assign('error',$error);
			}
		}
		$this->display();
	}
	// 退出登录
	public function logout(){
		
		$this->display();
	}
	public function activeUser(){
		$param = I('get.param','');
		$param = base64_decode($param);
		$param = explode("&", $param);
		$userid = explode("=", $param[0])[1];
		$token = explode("=", $param[1])[1];
	$userModel = M('User');

		$data['user_id'] = $userid;
		$data['token']   = $token;

		$userActive = M('userActive');
		$map['user_id'] = $userid;

		$userActiveLog = $userActive->where($map)->find();

		if(time() >= $userActiveLog['active_time'] && time() <= $userActiveLog['end_time']){

			$user = $userModel->where($data)->find();

			if($userModel->where($data)->save(array('status'=>1))){
				session('user',array('user_id'=>$userid,'username'=>$user['username']));

				$this->success('账号激活成功',U('Product/index'));
			}
			else{
				$this->error('账号激活失败',U('Product/index'));
			}
		}
		else{
			$userModel->delete($userid);
			$this->error('激活已经过期');
		}
	}
}

