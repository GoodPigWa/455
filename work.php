<?php
header("Content-type:text/html;charset=utf-8");
//1.写函数，创建长度为10的数组，数组的元素为递增的奇数，首项是1
function arr1($num,$size){
	$arr1=array();
	for($i=$num;$i<$size;$i++){
		$arr1[]=$i*2-1;
	}
	return $arr1;
}
 var_dump(arr1(1,10));
 echo "<br/>";
// 返回数组，内容为1,3,5,7,8

//2.写一个函数，求最大数的下标
// function maxkey($arr){
	
// 	$max=max($arr);
// 	foreach($arr as $key => $value){
// 		if($max==$value){
// 			$maxkey=$key;
// 		}
// 	}
// 	return $maxkey;
// 	$arr=array(1,3,5,25,68,45,54,67);
// }
	
// 	each maxkey($arr);
//3.创建长度为10的数组，数字中的元素符合斐波拉切数列规律
function arrFib($len){
	$arr=array(1,1);
	for($i=2;$i<10;$i++){
		$arr[]=$arr[$i-1]+$arr[$i-2];
	}
	return $arr;
}
var_dump(arrFib(10));
//返回数组[1,1,2,3,5,8,13...]
//4.计算数组中的最大数和最小数的差
$arr=array(1,3,5,25,68,45,54,67);
$max = $arr[0];
$min = $arr[0];
foreach ($arr as $key=>$val) {
    if ($max < $val) {
        $max = $val;
    } 
    elseif ($min > $val) {
        $min = $val;
    }
}
echo '最大数是：' . $max .',最小数是：'.$min.',差是：'.($max-$min);
echo '<br/>';
//5.将二维数组转换成树级目录
$category = array(
	array('id'=>1,'category_name'=>'手机','pid'=>0),
	array('id'=>2,'category_name'=>'数码','pid'=>0),
	array('id'=>3,'category_name'=>'服装','pid'=>0),
	array('id'=>4,'category_name'=>'小米','pid'=>1),
	array('id'=>5,'category_name'=>'华为','pid'=>1),
	array('id'=>6,'category_name'=>'小米4','pid'=>4),
	array('id'=>7,'category_name'=>'小米5','pid'=>4),
	array('id'=>8,'category_name'=>'小米4S','pid'=>6),
	array('id'=>9,'category_name'=>'小米4C','pid'=>6),
);

//第一种方式
//递归方式
function list_to_tree($arr,$pk='id',$pid='pid',$parent_id_value=0,$children='children'){
	//第一步，先把顶级数据放入一维数组中
	//第二部，把id的值传进来作为父id放入数组中
	foreach ($arr as $k => $v){
		if($v[$pid]==$parent_id_value){
			$tree[]=$v;
		}
	}
	//如果传入的id作为父id，不存在这样的数组
	if(empty($tree)){
		return null;
	}
	//决定什么时候用递归
	foreach ($tree as $k => $v) {
		$category=list_to_tree($arr,$pk,$pid,$v[$pk],$children);
		if($category!=null){
				$tree[$k]['$children']=$category;
			}
	}
	return $tree;
}
echo "<pre>";
print_r(list_to_tree($category,'id','pid',0,'children'));
echo "</pre>";


//第二种方式
//引用传值方式
$category = array(
	array('id'=>1,'category_name'=>'手机','pid'=>0),
	array('id'=>2,'category_name'=>'数码','pid'=>0),
	array('id'=>3,'category_name'=>'服装','pid'=>0),
	array('id'=>4,'category_name'=>'小米','pid'=>1),
	array('id'=>5,'category_name'=>'华为','pid'=>1),
	array('id'=>6,'category_name'=>'小米4','pid'=>4),
	array('id'=>7,'category_name'=>'小米5','pid'=>4),
	array('id'=>8,'category_name'=>'小米4S','pid'=>6),
	array('id'=>9,'category_name'=>'小米4C','pid'=>6),
);
//1.把索引数组转换成关联数组
$tree=[];
foreach($category as $k=>$v){
	$tree[$v['id']]=$v;
}
//2.引用的方式把id中的children对应到$pid是id值得数组
foreach ($tree as $k => $v) {
	if($v['pid']>0){
		$tree[$v['pid']]['children'][]=&$tree[$k];
	}
	
}
foreach ($tree as $k => $v) {
	if($v['pid']>0){
		unset($tree[$k]);
	}
}
echo "<pre>";
print_r($tree);
echo "</pre>";
die();
?>