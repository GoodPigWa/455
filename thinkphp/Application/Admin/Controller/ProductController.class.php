<?php
namespace Admin\Controller;
use Think\Controller;
class ProductController extends CommonController {
    public function index(){

    	$categoryModel = M('Category');
    	$categorys = $categoryModel->select();

    	$tree = [];

    	foreach ($categorys as $k => $v) {
    		$data['id'] = $v['category_id'];
    		$data['name'] = $v['category_name'];
    		$data['pId'] = $v['parent_id'];
    		$tree[] = $data;
    	}
    	$treeJson = json_encode($tree);
    	$this->assign('tree',$treeJson);
    	$this->display();
    }

    public function image(){

        if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
            exit; // finish preflight CORS requests here
        }


        if ( !empty($_REQUEST[ 'debug' ]) ) {
            $random = rand(0, intval($_REQUEST[ 'debug' ]) );
            if ( $random === 0 ) {
                header("HTTP/1.0 500 Internal Server Error");
                exit;
            }
        }


        @set_time_limit(5 * 60);

        $targetDir = 'upload_tmp';
        $uploadDir = 'public/images';


        $cleanupTargetDir = true; // Remove old files
        $maxFileAge = 5 * 3600; // Temp file age in seconds


        // Create target dir
        if (!file_exists($targetDir)) {
            @mkdir($targetDir);
        }

        // Create target dir
        if (!file_exists($uploadDir)) {
            @mkdir($uploadDir);
        }

        // Get a file name
        if (isset($_REQUEST["name"])) {
            $fileName = $_REQUEST["name"];
        } elseif (!empty($_FILES)) {
            $fileName = $_FILES["file"]["name"];
        } else {
            $fileName = uniqid("file_");
        }

        $filePath = $targetDir . DIRECTORY_SEPARATOR . $fileName;
        $uploadPath = $uploadDir . "/" . $fileName;

        // Chunking might be enabled
        $chunk = isset($_REQUEST["chunk"]) ? intval($_REQUEST["chunk"]) : 0;
        $chunks = isset($_REQUEST["chunks"]) ? intval($_REQUEST["chunks"]) : 1;


        // Remove old temp files
        if ($cleanupTargetDir) {
            if (!is_dir($targetDir) || !$dir = opendir($targetDir)) {
                die('{"jsonrpc" : "2.0", "error" : {"code": 100, "message": "Failed to open temp directory."}, "id" : "id"}');
            }

            while (($file = readdir($dir)) !== false) {
                $tmpfilePath = $targetDir . DIRECTORY_SEPARATOR . $file;

                // If temp file is current file proceed to the next
                if ($tmpfilePath == "{$filePath}_{$chunk}.part" || $tmpfilePath == "{$filePath}_{$chunk}.parttmp") {
                    continue;
                }

                // Remove temp file if it is older than the max age and is not the current file
                if (preg_match('/\.(part|parttmp)$/', $file) && (@filemtime($tmpfilePath) < time() - $maxFileAge)) {
                    @unlink($tmpfilePath);
                }
            }
            closedir($dir);
        }


        // Open temp file
        if (!$out = @fopen("{$filePath}_{$chunk}.parttmp", "wb")) {
            die('{"jsonrpc" : "2.0", "error" : {"code": 102, "message": "Failed to open output stream."}, "id" : "id"}');
        }

        if (!empty($_FILES)) {
            if ($_FILES["file"]["error"] || !is_uploaded_file($_FILES["file"]["tmp_name"])) {
                die('{"jsonrpc" : "2.0", "error" : {"code": 103, "message": "Failed to move uploaded file."}, "id" : "id"}');
            }

            // Read binary input stream and append it to temp file
            if (!$in = @fopen($_FILES["file"]["tmp_name"], "rb")) {
                die('{"jsonrpc" : "2.0", "error" : {"code": 101, "message": "Failed to open input stream."}, "id" : "id"}');
            }
        } else {
            if (!$in = @fopen("php://input", "rb")) {
                die('{"jsonrpc" : "2.0", "error" : {"code": 101, "message": "Failed to open input stream."}, "id" : "id"}');
            }
        }

        while ($buff = fread($in, 4096)) {
            fwrite($out, $buff);
        }

        @fclose($out);
        @fclose($in);

        rename("{$filePath}_{$chunk}.parttmp", "{$filePath}_{$chunk}.part");

        $index = 0;
        $done = true;
        for( $index = 0; $index < $chunks; $index++ ) {
            if ( !file_exists("{$filePath}_{$index}.part") ) {
                $done = false;
                break;
            }
        }
        if ( $done ) {
            if (!$out = @fopen($uploadPath, "wb")) {
                die('{"jsonrpc" : "2.0", "error" : {"code": 102, "message": "Failed to open output stream."}, "id" : "id"}');
            }

            if ( flock($out, LOCK_EX) ) {
                for( $index = 0; $index < $chunks; $index++ ) {
                    if (!$in = @fopen("{$filePath}_{$index}.part", "rb")) {
                        break;
                    }

                    while ($buff = fread($in, 4096)) {
                        fwrite($out, $buff);
                    }

                    @fclose($in);
                    @unlink("{$filePath}_{$index}.part");
                }

                flock($out, LOCK_UN);
            }
            @fclose($out);
        }

        // Return Success JSON-RPC response
     die($uploadPath);


    }


    public function edit(){
        $product_id = I('get.product_id','');
        if($product_id){
            $productModel = D('product');
            $data = $productModel->alias('p')
                                 ->join('left join cc_category  c on c.category_id=p.category_id')
                                 ->join('left join cc_brand  b on b.brand_id=p.brand_id')
                                 ->where('product_id = '.$product_id)
                                 ->field('c.category_name,p.product_id,p.product_name,p.price,p.image,b.brand_name')
                                 ->select();
                            
            $this->assign('data',$data);
        }
        else{
        
        } 

         $categoryModel = M('Category');
         $categorys = $categoryModel->where('parent_id !=  0')->select();
        $this->assign('categorys',$categorys);

        if(IS_POST){
            $category_id = I('post.category_id','');
            $product_name = I('post.product_name','');
            $brand_name = I('post.brand_name','');
            $price = I('post.price','');


            $where['brand_name'] = $brand_name;
            $productModel = D('product');
            $data =  $productModel->alias('p')
                        ->join('left join cc_brand b on p.brand_id = b.brand_id')
                        ->where($where)
                        ->select();
            $brand_id=$data['0']['brand_id'];
            $dataa['product_id']='';
            $dataa['product_name']=$product_name;
            $dataa['price']=$price;
            $dataa['image']='';
            $dataa['category_id']=$category_id;
            $dataa['brand_id']=$brand_id;

            $productModel->where('product_id = '.$product_id)->save($dataa);  
            $this->success('添加成功',U('product/productList'));
        }
        $this->display();
        
    }

    public function add(){
      
            $categoryModel = M('Category');
            $categorys = $categoryModel->where('parent_id !=  0')->select();
            $this->assign('categorys',$categorys);
    
        

        if(IS_POST){
            $category_id = I('post.category_id','');
            $product_name = I('post.product_name','');
            $brand_name = I('post.brand_name','');
            $price = I('post.price','');
            $image = I('post.image','');
            // dump($image);
            // die();


            $where['brand_name'] = $brand_name;
            $productModel = D('product');
            $data =  $productModel->alias('p')
                        ->join('left join cc_brand b on p.brand_id = b.brand_id')
                        ->where($where)
                        ->select();
            $brand_id=$data['0']['brand_id'];

            $productModel->add(
                array(
                    'product_id'     =>'',
                    'product_name'=>$product_name,
                    'price'       =>$price,
                    'image'       =>$image,
                    'category_id' =>$category_id,
                    'brand_id'    =>$brand_id
                    )
                );  
            $this->success('添加成功',U('product/productList'));
        }
      $this->display();

       
     }
    
    public function productList(){
    	$category_id= I('get.category_id',1,'int');

    	$categoryModel = D('category');
    	$result = $categoryModel->tree($category_id);
        // dump($result);
    	$this->assign('result',$result);
    	

    	$this->display();
    }
}