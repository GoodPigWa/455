<?php
namespace Home\Model;
use Think\Model\RelationModel;


class UserCartModel extends RelationModel{
	protected $_link = array(
		'User' => array(  
		     'mapping_type'  => self::BELONGS_TO,      
		     'foreign_key'   => 'user_id',    
		     'mapping_fields'  => 'user'  // 定义更多的关联属性    ……
		     )
		);
}