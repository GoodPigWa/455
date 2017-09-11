<?php
namespace Admin\Controller;
use Think\Controller;
class CategoryController extends CommonController {
    public function index(){
		$categoryModel = M('Category');
		$categorys = $categoryModel->order('sort desc')->select();
        $tree = list_to_tree2($categorys,'category_id','parent_id');
	
		$this->assign('tree',$tree);
        $this->display();

    }


    public function tree($category){
        $this->assign('category',$category);
        $this->display('tree');
    }
    public function add(){
       $categoryModel = M('Category');
        $categorys = $categoryModel->order('sort desc')->select();
        $tree = list_to_tree2($categorys,'category_id','parent_id');
        $this->assign('option',getCategoryTree($tree)); 
        
        $this->display();
        
    }

     public function del(){
        $productModel = M('product');
        $product_id = I('get.product_id','');

        $productModel->where('product_id = '.$product_id)->delete(); ;
        $this->success('删除成功',U('product/productList'));
      }
}