<?php
namespace Home\Model;
use Think\Model\RelationModel;
class UserModel extends RelationModel {



	// protected $_link = array(
	// 	'Card' =>array(
	// 		'mapping_type'      => self::HAS_ONE,      
	//         'class_name'        => 'UserCart',
	//         'mapping_name'      => 'carddsds',
	//         'foreign_key'       =>'user_id',
	//         'mapping_fields'    =>'cart_no,cart_id',
	//         'as_fields'          => 'cart_no,cart_id'
	// 		)
	// 	);



	// protected $_link = array(
	// 	'message' =>array(
	// 		'mapping_type'      => self::HAS_MANY,      
	//         'class_name'        => 'UserMessage',
	//         'mapping_name'      => 'messgename',
	//         'foreign_key'       =>'user_id',
	//         'mapping_fields'    =>'message_name,user_id'
	        
	// 		)
	// 	);


		protected $_link = array(
		'UserRole' =>array(
			'mapping_type'      => self::MANY_TO_MANY,      
	        'foreign_key'       =>'user_id',
	        'relation_foreign_key' =>'role_id',
	        'mapping_name'      =>  'groups',
	        'relation_table'    =>'cc_user_rela',
	        'mapping_fields'    =>'role,user_id'
	        
			)
		);



	// 不包含表前缀的真实表
	// protected $tableName = 'user';
	// protected $tablePrefix = 'coff_';
	// protected $trueTableName = 'coff_table';

	// protected $fields = array('id','user','password','pk'=>'id'
	// 	,'type'=>array('id'=>'int','user'=>'varchar')); 

    // protected $_validate = array(
			// array('user','require','用户名必须填写'),
			// array('password','require','用户名必须填写'),
			// array('user','/^\w+$/','用户名必须是数字字母下划线',1,'regex'),
			// array('user','checkGender','用户名必须是数字字母下划线',0,'function')

			// );
	// protected $_scope = array(
	// 	'default' => array(
	// 		'order' =>'id desc',
	// 		'feild' => 'id,user,password',
	// 		'where' => array("id>1 or user = '123434'")
	// 		),
	// 	'sql1' => array(
	// 		'order' =>'id desc',
	// 		'limit' => 2
	// 		),
	// 	);
	// public function getUser(){
	// 	// 第一种：// return $this->scope('default')->select();
	// 	// 第二种// return $this->sql1()->select();
	// 	// var_dump($this->getDbFields);
	// 	// return $this->select();
	// }

	// protected $_validate = array(
 // 		array('email','email','邮箱格式不正确',1),
 // 		array('email','','邮箱已经存在',1,'unique'),
 // 		array('password','6,32','密码长度在6到32位之间',1,'length'),
 // 		array('passwordRepeat','password','两次密码输入不一致',1,'confirm')
	// );
	// protected $_auto = array(
	//  	array('add_time','time',1),
	//  	array('updata_time','time',3),
	//  	array('password','md5',3,'function'),

	// );
	// public function checkUser($data)
	// {


	// 	$da['user']=$data['username'];
	// 	$da['password']=$data['password'];
	// 	$result = $this->where($da)->field('id')->find();
	// 	return $result;
	// }
}
