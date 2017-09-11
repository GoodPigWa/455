<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html lang="en">
<head>
	
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">

	<title>搜索页面</title>

	<link href="/thinkphp/Public/AmazeUI-2.4.2/assets/css/amazeui.css" rel="stylesheet" type="text/css" />
	<link href="/thinkphp/Public/AmazeUI-2.4.2/assets/css/admin.css" rel="stylesheet" type="text/css" />

	<link href="/thinkphp/Public/Home/basic/css/demo.css" rel="stylesheet" type="text/css" />

	<link href="/thinkphp/Public/Home/css/seastyle.css" rel="stylesheet" type="text/css" />

	<script type="text/javascript" src="/thinkphp/Public/Home/basic/js/jquery-1.7.min.js"></script>
	<script type="text/javascript" src="/thinkphp/Public/Home/js/script.js"></script>
	<script type="text/javascript" src="/thinkphp/Public/Home/basic/js/quick_links.js"></script>
	<link href="/thinkphp/Public/Home/css/cartstyle.css" rel="stylesheet" type="text/css" />
	<link href="/thinkphp/Public/Home/css/optstyle.css" rel="stylesheet" type="text/css" />

	
</head>
<body>
	<div class="am-container header">
			<ul class="message-l">
				<div class="topMessage">
					<div class="menu-hd">
						<a href="#" target="_top" class="h">亲，请登录</a>
						<a href="#" target="_top">免费注册</a>
					</div>
				</div>
			</ul>
			<ul class="message-r">
				<div class="topMessage home">
					<div class="menu-hd"><a href="<?php echo U('product/index');?>" target="_top" class="h">商城首页</a></div>
				</div>
				<div class="topMessage my-shangcheng">
					<div class="menu-hd MyShangcheng"><a href="<?php echo U('person/index');?>" target="_top"><i class="am-icon-user am-icon-fw"></i>个人中心</a></div>
				</div>
				<div class="topMessage mini-cart">
					<div class="menu-hd"><a id="mc-menu-hd" href="<?php echo U('cart/index');?>" target="_top"><i class="am-icon-shopping-cart  am-icon-fw"></i><span>购物车</span><strong id="J_MiniCartNum" class="h">0</strong></a></div>
				</div>
				<div class="topMessage favorite">
					<div class="menu-hd"><a href="<?php echo U('Person/collection');?>" target="_top"><i class="am-icon-heart am-icon-fw"></i><span>收藏夹</span></a></div>
			</ul>
			</div>

			<!--悬浮搜索框-->

			<div class="nav white">
				<!-- <div class="logo"><img src="/thinkphp/Public/Home/images/logo.png" /></div> -->
				<div class="logoBig">
					<li><img src="/thinkphp/Public/Home/images/logobig.png" /></li>
				</div>

				<div class="search-bar pr">
					<a name="index_none_header_sysc" href="#"></a>
					<form method="get" action="<?php echo U('Product/index');?>">
						<input id="searchInput" name="keywords" type="text" placeholder="搜索" autocomplete="off">
						<input id="ai-topsearch" class="submit am-btn"  value="搜索" index="1" type="submit">
					</form>
				</div>
			</div>



			<!--购物车 -->
			<div class="concent">
				<div id="cartTable">
					<div class="cart-table-th">
						<div class="wp">
							<div class="th th-chk">
								<div id="J_SelectAll1" class="select-all J_SelectAll">

								</div>
							</div>
							<div class="th th-item">
								<div class="td-inner">商品信息</div>
							</div>
							<div class="th th-price">
								<div class="td-inner">单价</div>
							</div>
							<div class="th th-amount">
								<div class="td-inner">数量</div>
							</div>
							<div class="th th-sum">
								<div class="td-inner">金额</div>
							</div>
							<div class="th th-op">
								<div class="td-inner">操作</div>
							</div>
						</div>
					</div>
					<div class="clear"></div>

					<tr class="item-list">
						<div class="bundle  bundle-last ">
							<div class="bundle-hd">
								<div class="bd-promos">
									<div class="bd-has-promo">已享优惠:<span class="bd-has-promo-content">省￥19.50</span>&nbsp;&nbsp;</div>
									<div class="act-promo">
										<a href="#" target="_blank">第二支半价，第三支免费<span class="gt">&gt;&gt;</span></a>
									</div>
									<span class="list-change theme-login">编辑</span>
								</div>
							</div>
							<div class="clear"></div>
							<div class="bundle-main">
								<?php if(is_array($carts)): $i = 0; $__LIST__ = $carts;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><ul class="item-content clearfix" data="<?php echo ($vo["product_id"]); ?>">
									
									<li class="td td-chk">
										<div class="cart-checkbox ">
											<input class="check" id="J_CheckBox_170037950254" name="items[]" value="<?php echo ($vo["product_id"]); ?>" type="checkbox">
											<label for="J_CheckBox_170037950254"></label>
										</div>
									</li>
								
									<li class="td td-item">
										<div class="item-pic">
											<a href="#" target="_blank" data-title="美康粉黛醉美东方唇膏口红正品 持久保湿滋润防水不掉色护唇彩妆" class="J_MakePoint" data-point="tbcart.8.12">
												<img src="/thinkphp/Public/Home/<?php echo ($vo["image"]); ?>" height="80px" width="80px"></a>

										</div>
										<div class="item-info">
											<div class="item-basic-info">
												<a href="#" target="_blank" title="美康粉黛醉美唇膏 持久保湿滋润防水不掉色" class="item-title J_MakePoint" data-point="tbcart.8.11"><?php echo ($vo["product_name"]); ?></a>
											</div>
										</div>
									</li>

									<li class="td td-info">
										<div class="item-props item-props-can">
											<span class="sku-line">颜色：12#川南玛瑙</span>
											<span class="sku-line">包装：裸装</span>
											<span tabindex="0" class="btn-edit-sku theme-login">修改</span>
											<i class="theme-login am-icon-sort-desc"></i>
										</div>
									</li>
									<li class="td td-price">
										<div class="item-price price-promo-promo">
											<div class="price-content">
												<div class="price-line">
													<em class="price-original">78.00</em>
												</div>
												<div class="price-line">
													<em class="J_Price price-now" tabindex="0"><?php echo ($vo["sales_price"]); ?></em>
												</div>
											</div>
										</div>
									</li>
									<li class="td td-amount">
										<div class="amount-wrapper ">
											<div class="item-amount ">
												<div class="sl">
													<input class="min am-btn" name="" type="button" value="-" />
													<input class="text_box" name="" type="text" value="<?php echo ($vo["quantity"]); ?>" style="width:30px;" />
													<input class="add am-btn" name="" type="button" value="+" />
												</div>
											</div>
										</div>
									</li>
									<li class="td td-sum">
										<div class="td-inner">
											<em tabindex="0" class="J_ItemSum number"><?php echo ($vo['sales_price']*$vo['quantity']); ?></em>
										</div>
									</li>
									<li class="td td-op">
										<div class="td-inner">
											<a title="移入收藏夹" class="btn-fav" href="<?php echo U('Person/collection',array('product_id'=>$vo['product_id']));?>">
                  移入收藏夹</a>
											<a href="javascript:;" data-point-url="#" class="delete">
                  删除</a>
										</div>
									</li>
								
								</ul><?php endforeach; endif; else: echo "" ;endif; ?>				
							</div>
						</div>
					</tr>
				
				</div>
				<div class="clear"></div>

				<div class="float-bar-wrapper">
					<div id="J_SelectAll2" class="select-all J_SelectAll">
						<div class="cart-checkbox">
							<input class="check-all check" id="J_SelectAllCbx2" name="select-all" value="true" type="checkbox">
							<label for="J_SelectAllCbx2"></label>
						</div>
						<span>全选</span>
					</div>
					<div class="operations">
						<a href="#" hidefocus="true" class="deleteAll">删除</a>
						<a href="" hidefocus="true" class="J_BatchFav">移入收藏夹</a>
					</div>
					<div class="float-bar-right">
						<div class="amount-sum">
							<span class="txt">已选商品</span>
							<em id="J_SelectedItemsCount">0</em><span class="txt">件</span>
							<div class="arrow-box">
								<span class="selected-items-arrow"></span>
								<span class="arrow"></span>
							</div>
						</div>
						<div class="price-sum">
							<span class="txt">合计:</span>
							<strong class="price">¥<em id="J_Total" name="totalprice">0.00</em></strong>
						</div>
						<div class="btn-area">
							<a href="" id="J_Go" class="submit-btn submit-btn-disabled" aria-label="请注意如果没有选择宝贝，将无法结算">
								<span>结&nbsp;算</span></a>
						</div>
					</div>

				</div>


			</div>

			<!--操作页面-->

			<div class="theme-popover-mask"></div>

		<!--引导 -->
		<div class="navCir">
			<li><a href="home.html"><i class="am-icon-home "></i>首页</a></li>
			<li><a href="sort.html"><i class="am-icon-list"></i>分类</a></li>
			<li class="active"><a href="shopcart.html"><i class="am-icon-shopping-basket"></i>购物车</a></li>	
			<li><a href="../person/index.html"><i class="am-icon-user"></i>我的</a></li>					
		</div>
	</body>

</html>
<script>
	$(function(){
	$('.am-btn').on('click',function(){
		var inputQuantity = $(this).parent().find('.text_box');
		var quantity = parseInt(inputQuantity.val());

		var nowQuantity = 1;

		if($(this).val() == '-'){
			if(quantity > 1){
				inputQuantity.val(quantity-1);
				nowQuantity = quantity-1;
			}
		}
		else{
			inputQuantity.val(quantity+1);
			nowQuantity = quantity+1;
		}

		var number = $(this).parents('ul').find('.number');
		var price = $(this).parents('ul').find('.price-now').text();

		number.text(price * nowQuantity);

		cart_id = $(this).parents('ul').attr('data');
		
		$.ajax({
			url:'/thinkphp/Home/Cart/ajaxCart/cart_id/'+cart_id+'/quantity/'+nowQuantity,
			type:'get',
			dataType:'json',
			success:function(result){
				if(result.code == 200){
					alert(result.msg);
				}
			}
		});
	});
});

	$(function(){
		$('.delete').on('click',function(){
			$(this).parents('ul').remove();
			cart_id = $(this).parents('ul').attr('data');
			console.log('/thinkphp/Home/Cart/ajaxDel/cart_id/'+cart_id);
			$.ajax({
				url:'/thinkphp/Home/Cart/ajaxDel/cart_id/'+cart_id,
				type:'get',
				dataType:'json',
				success:function(result){
					if(result.code == 200){
						alert(result.msg);
					}
				}
			});
		});
	});
	var tolprice = 0;
	var str = "";
	$(".check").on('click',function(){
		if($(this).is(':checked')){
			var name = $(this).val();  // 每一个被选中项的值
			var number = $(this).parents('ul').find('.number');
			var pri = $(this).parents('ul').find('.price-now');
			var pri = parseInt(pri.text());
			var number = parseInt(number.text());
	
			
			if (str.length == "") {
				str += name;
			}else{
				str += ","+name;
			};
			console.log(str);
			tolprice +=number;
			var tol = $(this).parents('.concent').find('#J_Total');
			tol.text(tolprice);
			$(this).parents('ul').find('.am-btn').on('click',function(){
				if($(this).val() == '-'){
					tolprice -=pri;
					tol.text(tolprice);
				}
				if($(this).val() == '+'){
					tolprice +=pri;
					tol.text(tolprice);
				}
			})
			$(".deleteAll").on('click',function(){
				if($(this).parents('.concent').find('.check').val()==name){
					$(this).parents('.concent').find('.check').parents('ul').remove();
				}			
				$.ajax({
					url:'/thinkphp/Home/Cart/ajaxDel/cart_id/'+name,
					type:'get',
					dataType:'json',
					success:function(result){
						if(result.code == 200){
							alert(result.msg);
						}
					}
				});
			})	
			$("#J_Go").on('click',function(){
		
				var cur2 = "<?php echo U('cart/pay?product_id=str');?>";
				var curl = cur2.replace('str',str);
				$('#J_Go').attr('href',curl);	
			
		
			})	
		}
		else{
			var name = $(this).val();  // 每一个被选中项的值
			var number = $(this).parents('ul').find('.number');
			var number = parseInt(number.text());
			// console.log(name);
			tolprice -=number;
			var tol = $(this).parents('.concent').find('#J_Total');
			tol.text(tolprice);
		}
		
	});

</script>

	<div class="footer">
	<div class="footer-hd">
		<p>
			<a href="#">恒望科技</a>
			<b>|</b>
			<a href="#">商城首页</a>
			<b>|</b>
			<a href="#">支付宝</a>
			<b>|</b>
			<a href="#">物流</a>
		</p>
	</div>
	<div class="footer-bd">
		<p>
			<a href="#">关于恒望</a>
			<a href="#">合作伙伴</a>
			<a href="#">联系我们</a>
			<a href="#">网站地图</a>
			<em>© 2015-2025 Hengwang.com 版权所有. 更多模板 <a href="http://www.cssmoban.com/" target="_blank" title="模板之家">模板之家</a> - Collect from <a href="http://www.cssmoban.com/" title="网页模板" target="_blank">网页模板</a></em>
		</p>
	</div>
</div>
</body>
</html>