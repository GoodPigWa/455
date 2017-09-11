<?php
namespace Admin\Model;
use Think\Model;

class AuthGroupModel extends Model{
	public function getGroup(){
		$AuthGroupModel = M('AuthGroup');
		$data = $AuthGroupModel->select();
		return $data;
	}
}