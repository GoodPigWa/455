<?php 
function checkGender($str){
	if($str == '男' || $str == '女'){
		return true;
	}
	else{
		return false;
	}
}

function html_page($str){
	$str = str_replace("<div>", '<ul class="am-pagination am-pagination-left">',$str);
	$str = str_replace("</div>", '</ul>',$str);
	$str = str_replace('<a class="num"', '<li><a',$str);
	$str = str_replace("</a>", '</a></li>',$str);
	$str = str_replace('<span class="current">', '<li class="am-active"><a href="#">',$str);
	$str = str_replace("</span>", '</a></li>',$str);
	$str = str_replace('<span class="rows">', '<li><a href="#">',$str);
	$str = str_replace("</span>", '</a></li>',$str);
	$str = str_replace('<a class="next">', '<li><a',$str);
	$str = str_replace('<a class="prev">', '<li><a',$str);

	return $str;
}

function getProductTags(){
	 // 产品印象模型
    $tagModel = M('productTag');
    $tags = $tagModel->select();
    return $tags;
}

function check($data,$a){
	
	foreach($data as $key=>$value){
		if($value['degree'] == $a){
				return $value['sum'];
		}
		else{
			// return 0;
		}

	}	
}


function hiddenUserName($username){
	$first = substr($username,0,1);

	$last = substr($username,-1,1);
	return $first . '***' .$last;
	// echo(1); 
}