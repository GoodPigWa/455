<?php if (!defined('THINK_PATH')) exit();?> <div class="mc"> 
     <ul>					    
     	<div class="mt">            
            <h2>看了又看</h2>        
        </div>
     	<?php if(is_array($products)): $i = 0; $__LIST__ = $products;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li class="first">
		      	<div class="p-img">                    
		      		<a  href="<?php echo U('product/detail',array('product_id'=>$product['product_id']));?>"> <img class="" src="/thinkphp/Public/Home/<?php echo ($vo["image"]); ?>"> </a> 
		      		            
		      	</div>
		      	<div class="p-name"><a href="#">
		      		<?php echo ($vo["product_name"]); ?>
		      	</a>
		      	</div>
		      	<div class="p-price"><strong>￥<?php echo ($vo["price"]); ?></strong></div>
		      </li><?php endforeach; endif; else: echo "" ;endif; ?>
     </ul>					
</div>