<?php
namespace Home\Controller;
use Think\Controller;
class CartController extends commonController {


    public function index(){

    	$cartModel = M('Cart');
    	$where['user_id'] = $this->user_id; 
    	// $cartModel->where($where)->select();

    	$carts = $cartModel->alias('c')
    			  ->join('left join cc_product p on c.product_id = p.product_id')
    			  ->join('left join cc_special ps on p.product_id = ps.product_id')
    			  ->where($where)
    			  ->field('p.product_name,p.price,p.product_id,p.image,ps.special_price,c.quantity,c.cart_id')
    			  ->order('cart_id desc')
    			  // ->limit($limit)
    			  ->select();

		  foreach ($carts as $key => $value) {
		  	if($value['special_price']){
		  		$carts[$key]['sales_price'] = $value['special_price'];
		  	}
		  	else{
		  		$carts[$key]['sales_price'] = $value['price'];
		  	}
		  }	
    	$this->assign('carts',$carts);
    	// dump($carts);

        $this->display();
    }
    public function add(){
         
         $product_id = I('get.product_id',0,'int');
         $price = I('get.price',0,'int');
         $quantity = I('get.quantity',1,'int');
         $cartModel = M('cart');
         $cart      = $cartModel->where('product_id='.$product_id.'  and user_id ='.$this->user_id)->find();
     
         if($cart){
         	$cart_id = $cart['cart_id'];
         	$cartModel->where('cart_id='.$cart_id)->setInc('quantity',1);
         	$this->success('添加成功',U('cart/index'));
         }
         else{
         	$data = array(
         		'product_id' => $product_id,
         		'quantity'   => $quantity,
                'price'      => $price,
         		'user_id'    => $this->user_id,
                'add_time'   => date('y-m-d h:i:s',time())
         		);
         	if($cartModel->add($data)){
         		$this->success('成功',U('cart/index'));
         	}
         }
    }

    public function ajaxCart($cart_id,$quantity){
        $cartModel = M('cart');
        $data['quantity'] =$quantity;
       // $data =  $cartModel->where('cart_id='.$cart_id)->setInc('quantity',$quantity);
       $data =  $cartModel->where('product_id='.$cart_id)->save($data);
       $this->ajaxReturn($data);
    }
    public function ajaxDel($cart_id){
        $cartModel = M('cart');
       $data =  $cartModel->where('product_id='.$cart_id)->delete();
       $this->ajaxReturn($data);
    }

    public function pay(){
        $product_id = I('product_id','');

        
        $product_id = explode(',',$product_id);
        $results = [];
        foreach ($product_id as $key => $value) {
            $cartModel = M('cart');
            $where['c.product_id'] = $value;
            $where['user_id'] = session('user')["user_id"];
            $result = $cartModel ->alias('c')
                       ->join('left join cc_product p on p.product_id = c.product_id')
                       ->where($where)
                       ->field('c.*,p.product_name,p.image')
                       ->find();
            $results[]=$result;
        }
        

        $this->assign('result',$results);
        
        $addressModel = M('address');
        $address = $addressModel->alias('c')->where('user_id='.session('user')["user_id"])->select();
        $this->assign('address',$address);
        $this->display();
    }

    public function success(){
        $this->display();
    }
    public function addressajax($add_id){
        $addressModel = M('address');
        $data['default'] = 1;
        $da['default'] = 0;
        $addressModel->where('add_id='.$add_id)->save($data);
        $addressModel->where('add_id!='.$add_id)->save($da);
        $result = $addressModel->where($data)->select();
        dump($result);
        $this->ajaxReturn($result);
    }
}