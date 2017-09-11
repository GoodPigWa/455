<?php
namespace Home\Model;
use Think\Model;
class ProductModel extends Model {

	// 计算符合搜索条件的商品总记录数
	function getProductCount($data){
			if(!empty($data['category_id'])){
				$categoryModel = D('Category');
				$categorys = $categoryModel->getCategory($data['category_id']);
				$category_ids = [];
				

					foreach ($categorys as $k => $v) {
						$category_ids[] =$v['category_id'];
						}
					$category_ids[] = $data['category_id'];
					
					$map['p.category_id'] = array('in',$category_ids);
			}

			if(!empty($data['brand_id'])){
				$map['p.brand_id'] = $data['brand_id'];
			}

			// if(!empty($data['priceBetween'])){
			// 	$map = 'special_price is null and price BETWEEN';
				
			// }

			if(!empty($data['keywords'])){
				$keywords = explode(' ',$data['keywords']);

				$str = '';
				$str .= " product_name like '%".$data['keywords']."%'";
				$str = rtrim($str,'or');
				$map['_string'] = $str;

			}		
			$count = $this->alias('p')
			->where($map)
			->field('p.product_id,product_name,image,price,special_price,b.brand_name,if(special_price is null ,price,special_price) as salesPrice')
			// ->having($having)
			->count();
			return $count;
	}

	function getProduct($data){

		if(!empty($data['category_id'])){
			
			$categoryModel = D('Category');
			$categorys = $categoryModel->getCategory($data['category_id']);
			$category_ids = [];
			// array_walk($categorys,function($v,$k) use(& $category_ids){
			// 	$category_ids[] = $v['category_id'];
			// });

			foreach ($categorys as $k => $v) {
				$category_ids[] =$v['category_id'];
			}
			$category_ids[] = $data['category_id'];
			
			$map['p.category_id'] = array('in',$category_ids);
		}

		if(!empty($data['brand_id'])){
			$map['p.brand_id'] = $data['brand_id'];
		}

		if(!empty($data['priceBetween'])){
			$having = 'salesPrice between '.$data['priceBetween']['min']." and ".$data['priceBetween']['max'];
			
		}

		if(!empty($data['keywords'])){
			$keywords = explode(' ',$data['keywords']);

			$str = '';
			$str .= " product_name like '%".$data['keywords']."%'";
			$str = rtrim($str,'or');
			$map['_string'] = $str;

		}
		switch($data['sort']){
			// 按照价格进行正序排
			case 'price':
					$sort = "salesPrice asc";
			         break;
		    // 按照销售量进行倒序排
			case 'sales':
					$sort = "sales desc";
			        break;
			// 默认按照产品id进行倒序排
		    default:
		    		$sort = "p.product_id desc";
			         break;
		}

		$results = $this->alias('p')
		->where($map)
		->join('left join cc_special on cc_special.special_id = p.product_id')
		->join('left join cc_brand as b on p.brand_id = b.brand_id')
		->order($sort)
		->field('p.product_id,product_name,image,price,special_price,b.brand_name,if(special_price is null ,price,special_price) as salesPrice')
		// ->limit(3,5)
		->having($having)
		->limit($data['limit'])
		->select();

		foreach ($results as $k => $v) {
			if(!empty($v['special_price'])){
				$results[$k]['price'] = $v['special_price'];
			}
			// $results[$k]['price'] = number_format($v['special_price'],2);
		}
		return $results;
	}

	function getProductDetail($product_id){
		
		$map['p.product_id'] =$product_id;

        $info= $this->alias('p')
				->where($map)
				->join('left join cc_special s on p.product_id = s.product_id')
				->field('p.*,s.special_price')
				->find();
		$images = $this->table('cc_productimage')->where('product_id='.$product_id)->select();

		$productImage = [];

		$i = 0;

		foreach($images as $k=>$v){
			$productImage[$i]['big'] 	= $v['image'];
			
			$path   = pathinfo($v['image']);
			
			$productImage[$i]['small']  = $path['dirname'] . "/" . $path['filename'] . "_small." . $path['extension'];

			$productImage[$i]['mid']    = $path['dirname'] . "/" . $path['filename'] . "_mid." . $path['extension'];

			$i++;
			
			
		}
		$info['productImages'] = $productImage;
	// dump($info);
		return $info;
	}

	function getCommentCount($product_id){
		$commentModel = D('ProductComment');
		$where['product_id'] = $product_id;
   
     
      	$count = $commentModel->where($where)->count();
     	return $count;     	
 		
	}

	
}