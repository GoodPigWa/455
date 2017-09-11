<?php
namespace Home\Controller;
use Think\Controller;
header("Content-type:text/html;charset=utf-8");
class ProductController extends Controller {
    public function index(){
    	// 获得get传参
    	$data['sort'] = I('get.sort','');
        $data['category_id'] = I('get.category_id',0,'int');
        $data['brand_id'] = I('get.brand_id',0,'int');
        $data['price'] = I('get.price',-1,'int');
        $data['keywords'] = I('get.keywords','');


        // 1.从品牌表中查询是否关键词是符合品牌的，如果有，把品牌的ID返回出来，传递到model
        // 2.从商品分类里面检索关键词是否有符合要求的，返回符合要求的ID
        // 3.根据空格进行分割成数组，数组中的每个次进行检索


        // 所有GET的参数传递到模板
        $this->assign('param',$data);

        // 实例化分类模型
        $categoryModel = D('Category');
        // 获得顶级分类（一级分类）
        $topCategory = $categoryModel->getCategory(0);
        $this->assign('topCategory',$topCategory);

        // 根据当前分类获得分类的名称及分类的level
       $categoryInfo =  $categoryModel->where('category_id='.$data['category_id'])->find();

       $this->assign('categoryInfo',$categoryInfo);

       // 查询二级分类
       if($categoryInfo['level'] == 1){
            $secondCategory = $categoryModel->getCategory($data['category_id']);
       }
       else if($categoryInfo['level'] == 2){
           $secondCategory = $categoryModel->getCategory($categoryInfo['parent_id']);
          // dump($secondCategory);
       }
       $this->assign('secondCategory',$secondCategory);


       // 获得所有品牌信息
       $brandModel = M('Brand');
       $brands = $brandModel->where("concat(',',category_id,',') like '%,".$data['category_id'].",%'")->select();
       $this->assign('brands',$brands);



       // 价格区间
       $priceArr = array(
          array('title'=>'0-10','min'=>0,'max'=>10),
          array('title'=>'10-50','min'=>10,'max'=>50),
          array('title'=>'50-100','min'=>50,'max'=>100),
          array('title'=>'100以上','min'=>100,'max'=>300),
        );
        $this->assign('priceArr',$priceArr);
        $data['priceBetween'] = $priceArr[$data['price']];

      
       
    	// 实例化自定义模型
    	$productModel = D('Product');

        // 根据条件计算总条数
       $total =  $productModel->getProductCount($data);


       // 实例化page对象
       $Page = new \Think\Page($total,C('pagesize'));

       // $Page->setConfig('header','共%TOTAL_ROW%条商品');

       $Page->setConfig('prev','上一页');
       $Page->setConfig('next','下一页');
       $Page->setConfig('first','第一页');
       $Page->setConfig('last','最后一页');

      $Page->setConfig('theme','%HEADER% %FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%');
      $show = $Page->show();
     $show = html_page($show);

      // 分页show返回的字符串传递到模版视图中
      $this->assign("page",$show);

      $data['limit'] = $Page->firstRow . "," . $Page->listRows;


    	// 调用获取所有产品的方法，把结果赋值给变量
    	$products = $productModel->getProduct($data);

      $keywords = explode(' ',$data['keywords']);
      foreach ($keywords as $k => $v){
        $replaceKey[] = '<span style="color:red">'.$v.'</span>';
      }
      foreach ($products as $key => $value) {
        $products[$key]['product_name'] = str_replace($keywords,$replaceKey,$value['product_name']);
      }


    	// $this->assign模版赋值，将变量传递给视图
    	$this->assign("products",$products);
        $this->display();
    }

    public function detail(){
        $product_id = I('get.product_id',1,'int');

        if(empty($product_id)){
          $this->error('请选择产品',U('Product/index'));
          exit();
        } 
          $brandCrumb = [
          ['title' => '首页','url'=>U('Index/index')],
          ['title' => '分类','url'=>U('Product/index')],
          ['title' => '产品','url'=>__ACTION__.'/product_id/'.$product_id]
        ];
        $this->assign('brandCrumb',$brandCrumb);
        
        // 实例化产品模型对象
        $product = D('Product');
        $product = $product->getProductDetail($product_id);

        $this->assign('product',$product);

        // $this->relationProduct($product_id);
        $this->display();
    }

   
   
// 根据产品ID获得相关信息的产品
   public function relationProduct($product_id){
      $productModel = M('product');
      $map['product_id'] = $product_id;


      // $productModel->where($map)->field(product_id)->find();
      $category_id = $productModel->getFieldByProductId($product_id,'category_id');


     $where['category_id'] = $category_id;
     $where['product_id']  =array('neq',$product_id);
     $products = $productModel->where($where)->limit(5)->select();

     $this->assign('products',$products);
     $this->display('relation');
   }

// 商品评价
   public function comment($product_id){
 $where['product_id'] = $product_id;
      $commentModel = D('product');
      $commentCount = $commentModel->getCommentCount($product_id);
      $commentModel = M('ProductComment');
      $statis = $commentModel->group('degree')->where($where)->field('degree,count(*) as sum')->select();
      

     $data['haoping']   = check($statis,1);
     $data['zhongping'] = check($statis,2);
     $data['chaping']   = check($statis,3);
     // if(empty($data[''])){
     //  $data[''] = 0;
     // }

     $data['total'] = $data['haoping']+ $data['zhongping'] + $data['chaping'];
     $this->assign('data',$data);

      
  
      $map = $commentModel->alias('pc')
                          ->join('left join cc_user u on pc.user_id = u.user_id')
                          ->where($where)
                          ->field('pc.*,u.avator,u.user')
                          ->select();
       $this->assign('map',$map);
      if(IS_POST){
          $commentModel = M('ProductComment');
          $comment = I('post.comment');
          $degree = I('post.degree');
          $tags = I('post.tags');
          $product_id = I('post.product_id');
        
       
          $commentModel->add(
              array(
                  'comment' => $comment,
                  'degree'  => $degree,
                  'user_id' => session('user')['user_id'],
                  'product_id' => $product_id,
                  'add_time'  => time()
                )
            );
      }
      $tags = getProductTags();
      $this->assign('tags',$tags);
      $this->display('comment');
   }

   public function ajaxComment()
   {
      $i = I('get.pingjia',0,'int');

      $commentModel = M('ProductComment');
      if($i ==0){
         $comment = $commentModel->alias('pc')
                                  ->join('left join cc_user u on pc.user_id = u.user_id')
                                  ->field('u.user,u.avator,pc.*')
                                  ->select();
      }
      else{
         $comment = $commentModel->alias('pc')
                                  ->join('left join cc_user u on pc.user_id = u.user_id')
                                  ->where('pc.degree='.$i)
                                  ->field('u.user,u.avator,pc.*')
                                  ->select();
      }
     
      $coms['code'] = 200;
      $coms['result'] = $comment;

      $this->ajaxReturn($coms);
   }


}

