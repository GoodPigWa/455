<?php
namespace Home\Model;
use Think\Model;
class CategoryModel extends Model {

	// 获得几级分类
	public function getCategory($pid){
		// 需要显示的产品分类
		$map['is_show'] = 1;
		// 需要获得传入产品分类ID的子分类
		$map['parent_id'] = $pid;

		return $this->where($map)
		            ->order('sort desc,category_id asc')
		            ->select();
	}
}