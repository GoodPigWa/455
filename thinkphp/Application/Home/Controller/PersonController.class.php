<?php
namespace Home\Controller;
use Think\Controller;
class PersonController extends commonController {
	public function collection(){
		$product_id = I('product_id','');
		$collectModel = M('collect');
		if(!empty($product_id)){
			$data['product_id'] = $product_id;
			$data['user_id'] = session('user')["user_id"];

			$result = $collectModel->where($data)->select();
			// dump($result);
			if(!$result){
				$collectModel->data($data)->add();
			}
			else{
				$this->error('已加入收藏夹',U('cart/index'));
				exit();
			}		
		}
		
		$coll = $collectModel->alias('c')
							 ->join('left join cc_product p on p.product_id = c.product_id')
							 ->join('left join cc_special s on c.product_id = s.product_id')
							 ->where('user_id='.session('user')["user_id"])
							 ->field('p.*,s.special_price')
		 					 ->select();
		foreach ($coll as $key => $value) {
		  	if($value['special_price']){
		  		$coll[$key]['sales_price'] = $value['special_price'];
		  	}
		  	else{
		  		$coll[$key]['sales_price'] = $value['price'];
		  	}
		}	
		
		 $this->assign('coll',$coll);

		$this->display();
	}

	public function index(){
		$this->display();
	}
	public function address(){
		

		if(IS_POST){
			$name= I('post.name','');
			$tele= I('post.tele','');
			$province= I('post.province','');
			$city= I('post.city','');
			$dist= I('post.dist','');
			$street= I('post.street','');	
			$data['user_id']=session('user')["user_id"];
			$data['tele'] = $tele;
			$data['province'] = $province;
			$data['city'] = $city;
			$data['dist'] = $dist;
			$data['street'] = $street;
			$data['name'] = $name;
			$addressModel = M('address');
			$addressModel->data($data)->add();
		}
		$addressModel = M('address');
		$address = $addressModel->alias('c')->where('user_id='.session('user')["user_id"])->select();
		// dump($address);
		$this->assign('address',$address);
		$this->display();
	}
	public function order(){
		$this->display();
	}
	public function addressajax($add_id){
		$addressModel = M('address');
		$data['default'] = 1;
		$da['default'] = 0;
		$addressModel->where('add_id='.$add_id)->save($data);
		$addressModel->where('add_id!='.$add_id)->save($da);
	}
}