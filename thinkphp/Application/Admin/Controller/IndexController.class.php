<?php
namespace Admin\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){
    	$NavModel = D('nav');
    	$data = $NavModel->GetNav(0);
    
    	foreach ($data as $key => $value) {
    		$result = $NavModel->GetNav($value['nav_id']);
    		$data[$key]['children'] = $result;	
   				
    	}
    	
       	$this->assign('data',$data);
        $this->display();
    }

    public function welcome(){

        $this->display();
    }
}