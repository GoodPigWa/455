<?php
function list_to_tree2($categorys,$id='category_id',$pid="parent_id",$parent_value=0,$children='children'){
	$tree=[];
	
	foreach($categorys as $k=>$v){
		$tree[$v[$id]]=$v;
	}
	
	//2.引用的方式把id中的children对应到$pid是id值得数组
	foreach ($tree as $k => $v) {
		if($v[$pid]>0){
			$tree[$v[$pid]][$children][]=& $tree[$k];
		}
		
	}

	foreach ($tree as $k => $v) {
		if($v[$pid]>0){
			unset($tree[$k]);
		}
	}
	return $tree;
}


function getCategoryTree($tree){
	// dump($tree);
	// die();
	$str = '';
	foreach ($tree as $k => $v) {
		$level = str_repeat('--', $v['level']-1);

		$str .= '<option>';

		$str .= $level.$v['category_name'];

		$str .= '</option>';

		if($v['children']){
			$str .= getCategoryTree($v['children']);
		}
	}
	return $str;
}
