<?php
namespace Admin\Model;
use Think\Model;
class CategoryModel extends Model {
	public function tree($category_id){
		$categoryModel = M('category');
        $map['p.category_id'] = $category_id;
        $where['category_id'] =$category_id;
        $pin['parent_id'] = $category_id;
        $parent_id =  $categoryModel->where($where)->field('parent_id')->select();

        if($parent_id['0']['parent_id']==0){
            $parent_id =  $categoryModel->where($pin)->field('category_id')->select();
          foreach ($parent_id as $k =>$v) {
            $arr[] = $v['category_id'];
          }         
          $arr1 = implode(',', $arr);
               $productModel = M('product');
               $data = $productModel->alias('p')
               ->join('left join cc_category c on p.category_id=c.category_id')
               ->where('p.category_id in ('.$arr1.')')
               ->field('p.product_id,p.product_name,p.product_name,p.price,p.image,c.category_name')
               ->select();
           
        } 
        else{
            $data =  $categoryModel->alias('c')
                      ->join('left join cc_product p on c.category_id =p.category_id')
                      ->where($map)
                      ->field('c.category_id,c.category_name,p.product_id,p.product_name,p.price,p.category_id,p.image')
                      ->select();
        }
      return $data;
	}

}