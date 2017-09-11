<?php if (!defined('THINK_PATH')) exit();?>  <div class="actor-new">
    	<div class="rate">                
    		<strong>100<span>%</span></strong><br> <span>好评度</span>            
    	</div>
        <dl>                    
            <dt>买家印象</dt>                    
            <dd class="p-bfc">
            			<q class="comm-tags"><span>味道不错</span><em>(2177)</em></q>
            			<q class="comm-tags"><span>颗粒饱满</span><em>(1860)</em></q>
            			<q class="comm-tags"><span>口感好</span><em>(1823)</em></q>
            			<q class="comm-tags"><span>商品不错</span><em>(1689)</em></q>
            			<q class="comm-tags"><span>香脆可口</span><em>(1488)</em></q>
            			<q class="comm-tags"><span>个个开口</span><em>(1392)</em></q>
            			<q class="comm-tags"><span>价格便宜</span><em>(1119)</em></q>
            			<q class="comm-tags"><span>特价买的</span><em>(865)</em></q>
            			<q class="comm-tags"><span>皮很薄</span><em>(831)</em></q> 
            </dd>                                           
         </dl> 
    </div>	
    <div class="clear"></div>
	<div class="tb-r-filter-bar">
		<ul class=" tb-taglist am-avg-sm-4">
			<li class="tb-taglist-li tb-taglist-li-current" data="0">
				<div class="comment-info">
					<span>全部评价</span>
					<span class="tb-tbcr-num">(<?php echo ($data["total"]); ?>)</span>
				</div>
			</li>

			<li class="tb-taglist-li tb-taglist-li-1" data="1">
				<div class="comment-info">
					<span>好评</span>
					<span class="tb-tbcr-num">(<?php echo ($data["haoping"]); ?>)</span>
				</div>
			</li>

			<li class="tb-taglist-li tb-taglist-li-0" data="2">
				<div class="comment-info">
					<span>中评</span>
					<span class="tb-tbcr-num">(<?php echo ($data["zhongping"]); ?>)</span>
				</div>
			</li>

			<li class="tb-taglist-li tb-taglist-li--1" data="3">
				<div class="comment-info">
					<span>差评</span>
					<span class="tb-tbcr-num">(<?php echo ($data["chaping"]); ?>)</span>
				</div>
			</li>
		</ul>
	</div>
	<div class="clear"></div>

	<ul class="am-comments-list am-comments-list-flip">
		<?php if(is_array($map)): $i = 0; $__LIST__ = $map;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li class="am-comment">
			<?php if(!empty($avator)): ?><img class="am-comment-avatar" src="/thinkphp/Public/Home/<?php echo ($vo["avator"]); ?>" />
				<?php else: ?>
			<a href="">
				<img class="am-comment-avatar" src="/thinkphp/Public/Home/images/hwbn40x40.jpg" />
			</a><?php endif; ?>
			<div class="am-comment-main">
					<header class="am-comment-hd">
							<div class="am-comment-meta">
								<a href="#link-to-user" class="am-comment-author"><?php echo hiddenUserName($vo['user']);?> (匿名)</a>
								评论于
								<time datetime=""><?php echo (date("Y年m月d日 H:i:s",$vo["add_time"])); ?></time>
							</div>
						
					</header>

					<div class="am-comment-bd">
						<div class="tb-rev-item " data-id="255776406962">
							<div class="J_TbcRate_ReviewContent tb-tbcr-content ">
								<?php echo ($vo["comment"]); ?>
							</div>
							<div class="tb-r-act-bar">
								颜色分类：柠檬黄&nbsp;&nbsp;尺码：S
							</div>
						</div>

					</div>
			
			</div>
		</li><?php endforeach; endif; else: echo "" ;endif; ?>

	</ul>

	<div class="clear"></div>

	<!--分页 -->
	<ul class="am-pagination am-pagination-right">
		<li class="am-disabled"><a href="#">&laquo;</a></li>
		<li class="am-active"><a href="#">1</a></li>
		<li><a href="#">2</a></li>
		<li><a href="#">3</a></li>
		<li><a href="#">4</a></li>
		<li><a href="#">5</a></li>
		<li><a href="#">&raquo;</a></li>
	</ul>
	<div class="clear"></div>

	<div class="tb-reviewsft">
		<div class="tb-rate-alert type-attention">购买前请查看该商品的 <a href="#" target="_blank">购物保障</a>，明确您的售后保障权益。</div>
		
		<?php if(!empty($_SESSION['user'])): ?><div>
				
				<form action="<?php echo U('Product/comment');?>" method="post">
					<input type="hidden" name="product_id" value="<?php echo ($product["product_id"]); ?>">
					<textarea name="comment" id="" cols="30" rows="10"></textarea>
					<br/>
					评价：<input type="radio" name="degree">好评
					<input type="radio" name="degree">中评
					<input type="radio" name="degree">差评
					<br/>
					印象：<?php if(is_array($tags)): $i = 0; $__LIST__ = $tags;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><label>
								<input type="checkbox" name="tags[]" value="<?php echo ($vo["product_tag_id"]); ?>"><?php echo ($vo["tag_name"]); ?>
							</label><?php endforeach; endif; else: echo "" ;endif; ?>
					
						<button>发表评论</button>
					
				</form>
			</div>
			<?php else: ?>
				<a href="<?php echo U('user/login');?>">登录</a>后评论<?php endif; ?>
	</div>
	<input type="hidden" id="url" name="url" value="/thinkphp/Home/Product">
	<style>
		.comment-info{
			cursor: pointer;
		}
	</style>

	<script type="text/javascript" src="/thinkphp/Public/Home/js/comment.js"></script>