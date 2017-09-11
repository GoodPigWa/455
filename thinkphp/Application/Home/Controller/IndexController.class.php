<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){
       // D方法支持跨模块调用
 		
 		 // echo T('index');   //输出模板地址
        $this->display('product/index');
        $this->theme('blue')->display();  //主题切换


       // echo  $this->fetch('product/index');   //fetch获取内容，通过echo才能显示出来

    	// $name = "张三";ro

    	// $arr = ['name'=>'tom','email'=>'123@qq.com'];
    	// $obj = new \stdClass;
    	// $obj->name
    	// $this->assign('name',$name);
    	// $this->assign('arr',$arr);
    	// $this->display();
    	// LAYOUT('public/layout');
    	// $sex = 2;
    	$data['sex'] = 2;
    	$this->assign('data',$data);
    	$this->display('test');
    }

    function test(){
        // $image = new \Think\Image();

        // $image->open('./Public/images/1.jpg');

        // $image->crop(200, 200)->save('./Public/1.jpg');

        // $image->thumb(150, 150)->save('./Public/2.jpg');

        // $Verify = new \Think\Verify();
        // $Verify->entry(1);

        // $Verify->entry(2);

        // if(IS_POST){
        //     $upload = new \Think\Upload();
        //     $upload->maxSize   =3145728 ; 
        //     $upload->exts= array('jpg', 'gif', 'png', 'jpeg');
        //     $upload->savePath  = './Public/Uploads/';
        //     $upload->subname = array('data','ymd'); 

        //     $info   =   $upload->upload();    
        //     if(!$info) {       
        //         $this->error($upload->getError());  
        //     }
        //     else{// 上传成功        
        //         $this->success('上传成功！');    
        //     }
        // }
        // $this->display();

        // L('name','zhangsan');
        // echo L('name');
        // echo L('_MODULE_NOT_EXIST_');
        // echo L('form_user');

        $this->display();
       
    }
}