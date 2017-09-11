<?php
namespace Admin\Model;
use Think\Model;

class NavModel extends Model{

	function GetNav($pid){
		$where['pid'] = $pid;
		$where['status'] = 1;
		$NavModel = M('nav');
		$data = $NavModel->where($where)
				 		->order('nav_id asc')
				 		->select();
		return $data;
	}
}



