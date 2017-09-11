<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>

	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=1.0, user-scalable=0">

		<title>地址管理</title>

		<link href="/thinkphp/Public/AmazeUI-2.4.2/assets/css/admin.css" rel="stylesheet" type="text/css">
		<link href="/thinkphp/Public/AmazeUI-2.4.2/assets/css/amazeui.css" rel="stylesheet" type="text/css">

		<link href="/thinkphp/Public/Home/css/personal.css" rel="stylesheet" type="text/css">
		<link href="/thinkphp/Public/Home/css/addstyle.css" rel="stylesheet" type="text/css">
		<script src="/thinkphp/Public/AmazeUI-2.4.2/assets/js/jquery.min.js" type="text/javascript"></script>
		<script src="/thinkphp/Public/AmazeUI-2.4.2/assets/js/amazeui.js"></script>

	</head>

	<body>
		<!--头 -->
		<header>
			<article>
				<div class="mt-logo">
					<!--顶部导航条 -->
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
				</div>
			</article>
		</header>

		<div class="nav-table">
			 


	   <div class="long-title"><span class="all-goods">全部分类</span></div>
	   <div class="nav-cont">
			<ul>
				<li class="index"><a href="#">首页</a></li>
                <li class="qc"><a href="#">闪购</a></li>
                <li class="qc"><a href="#">限时抢</a></li>
                <li class="qc"><a href="#">团购</a></li>
                <li class="qc last"><a href="#">大包装</a></li>
			</ul>
		    <div class="nav-extra">
		    	<i class="am-icon-user-secret am-icon-md nav-user"></i><b></b>我的福利
		    	<i class="am-icon-angle-right" style="padding-left: 10px;"></i>
		    </div>
		</div>
				

		</div>
		<b class="line"></b>

		<div class="center">
			<div class="col-main">
				<div class="main-wrap">

					<div class="user-address">
						<!--标题 -->
						<div class="am-cf am-padding">
							<div class="am-fl am-cf"><strong class="am-text-danger am-text-lg">地址管理</strong> / <small>Address&nbsp;list</small></div>
						</div>
						<hr/>
						<ul class="am-avg-sm-1 am-avg-md-3 am-thumbnails">
							<?php if(is_array($address)): $i = 0; $__LIST__ = $address;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i; if($vo["default"] == '1'): ?><li class="user-addresslist defaultAddr">
									<input type="hidden" class="id" value="<?php echo ($vo["default"]); ?>">
									<input type="hidden" class="add_id" value="<?php echo ($vo["add_id"]); ?>">
									<span class="new-option-r"><i class="am-icon-check-circle"></i>默认地址</span>
									<p class="new-tit new-p-re">
										<span class="new-txt"><?php echo ($vo["name"]); ?></span>
										<span class="new-txt-rd2"><?php echo ($vo["tele"]); ?></span>
									</p>
									<div class="new-mu_l2a new-p-re">
										<p class="new-mu_l2cw">
											<span class="title">地址：</span>
											<span class="province"><?php echo ($vo["province"]); ?></span>省
											<span class="city"><?php echo ($vo["city"]); ?></span>市
											<span class="dist"><?php echo ($vo["dist"]); ?></span>区
											<span class="street"><?php echo ($vo["street"]); ?></span></p>
									</div>
									<div class="new-addr-btn">
										<a href="#"><i class="am-icon-edit"></i>编辑</a>
										<span class="new-addr-bar">|</span>
										<a href="javascript:void(0);" onclick="delClick(this);"><i class="am-icon-trash"></i>删除</a>
									</div>
								</li>
							<?php else: ?>
								<li class="user-addresslist">
									<input type="hidden" class="id" value="<?php echo ($vo["default"]); ?>">
									<input type="hidden" class="add_id" value="<?php echo ($vo["add_id"]); ?>">
									<span class="new-option-r"><i class="am-icon-check-circle"></i>默认地址</span>
									<p class="new-tit new-p-re">
										<span class="new-txt"><?php echo ($vo["name"]); ?></span>
										<span class="new-txt-rd2"><?php echo ($vo["tele"]); ?></span>
									</p>
									<div class="new-mu_l2a new-p-re">
										<p class="new-mu_l2cw">
											<span class="title">地址：</span>
											<span class="province"><?php echo ($vo["province"]); ?></span>省
											<span class="city"><?php echo ($vo["city"]); ?></span>市
											<span class="dist"><?php echo ($vo["dist"]); ?></span>区
											<span class="street"><?php echo ($vo["street"]); ?></span></p>
									</div>
									<div class="new-addr-btn">
										<a href="#"><i class="am-icon-edit"></i>编辑</a>
										<span class="new-addr-bar">|</span>
										<a href="javascript:void(0);" onclick="delClick(this);"><i class="am-icon-trash"></i>删除</a>
									</div>
								</li><?php endif; endforeach; endif; else: echo "" ;endif; ?>
						</ul>
						<div class="clear"></div>
						<a class="new-abtn-type" data-am-modal="{target: '#doc-modal-1', closeViaDimmer: 0}">添加新地址</a>
						<div class="am-modal am-modal-no-btn" id="doc-modal-1">
							<div class="add-dress">
								<!--标题 -->
								<div class="am-cf am-padding">
									<div class="am-fl am-cf"><strong class="am-text-danger am-text-lg">新增地址</strong> / <small>Add&nbsp;address</small></div>
								</div>
								<hr/>
								<div class="am-u-md-12 am-u-lg-8" style="margin-top: 20px;">
									<form class="am-form am-form-horizontal" method="post" action="<?php echo U('person/address');?>">

										<div class="am-form-group">
											<label for="user-name" class="am-form-label">收货人</label>
											<div class="am-form-content">
												<input type="text" id="user-name" name="name" placeholder="收货人">
											</div>
										</div>

										<div class="am-form-group">
											<label for="user-phone" class="am-form-label">手机号码</label>
											<div class="am-form-content">
												<input id="user-phone" name="tele" placeholder="手机号必填" type="phone">
											</div>
										</div>
										<div class="am-form-group">
											<label for="user-address" class="am-form-label">所在地</label>
											<div class="am-form-content address">
												<select data-am-selected name="province">
													<option value="浙江省">浙江省</option>
													<option value="湖北省" selected>湖北省</option>
												</select>
												<select data-am-selected name="city">
													<option value="温州市">温州市</option>
													<option value="武汉市" selected>武汉市</option>
												</select>
												<select data-am-selected name="dist">
													<option value="瑞安区">瑞安区</option>
													<option value="洪山区" selected>洪山区</option>
												</select>
											</div>
										</div>

										<div class="am-form-group">
											<label for="user-intro" class="am-form-label">详细地址</label>
											<div class="am-form-content">
												<textarea class="" rows="3" name="street" id="user-intro" placeholder="输入详细地址"></textarea>
												<small>100字以内写出你的详细地址...</small>
											</div>
										</div>

										<div class="am-form-group">
											<div class="am-u-sm-9 am-u-sm-push-3">
												<button><a class="am-btn am-btn-danger">保存</a></button>
												<a href="javascript: void(0)" class="am-close am-btn am-btn-danger" data-am-modal-close>取消</a>
											</div>
										</div>
									</form>
								</div>

							</div>

						</div>

					</div>

					<script type="text/javascript">

						$(document).ready(function() {							
							$(".new-option-r").click(function() {
								$(this).parent('.user-addresslist').addClass("defaultAddr").siblings().removeClass("defaultAddr");
                    			var add_id = $(this).parent('.user-addresslist').find('.add_id').val();
                    			console.log('/thinkphp/Home/Person/addressajax/add_id/'+add_id);
	                    		$.ajax({
									url:'/thinkphp/Home/Person/addressajax/add_id/'+add_id,
										type:'get',
										dataType:'json',
										success:function(result){
											if(result.code == 200){
												alert(result);
											}
										}
								});
							});
							
							var $ww = $(window).width();
							if($ww>640) {
								$("#doc-modal-1").removeClass("am-modal am-modal-no-btn")
							}
							
						})
					</script>

					<div class="clear"></div>

				</div>
				<!--底部-->
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
			</div>
			<aside class="menu">
				<ul>
					<li class="person">
						<a href="<?php echo U('person/index');?>">个人中心</a>
					</li>
					<li class="person">
						<a href="#">个人资料</a>
						<ul>
							<li> <a href="information.html">个人信息</a></li>
							<li> <a href="safety.html">安全设置</a></li>
							<li class="active"> <a href="<?php echo U('person/address');?>">收货地址</a></li>
						</ul>
					</li>
					<li class="person">
						<a href="#">我的交易</a>
						<ul>
							<li><a href="<?php echo U('person/order');?>">订单管理</a></li>
							<li> <a href="change.html">退款售后</a></li>
						</ul>
					</li>
					<li class="person">
						<a href="#">我的资产</a>
						<ul>
							<li> <a href="coupon.html">优惠券 </a></li>
							<li> <a href="bonus.html">红包</a></li>
							<li> <a href="bill.html">账单明细</a></li>
						</ul>
					</li>

					<li class="person">
						<a href="#">我的小窝</a>
						<ul>
							<li> <a href="<?php echo U('person/collection');?>">收藏</a></li>
							<li> <a href="foot.html">足迹</a></li>
							<li> <a href="comment.html">评价</a></li>
							<li> <a href="news.html">消息</a></li>
						</ul>
					</li>

				</ul>

			</aside>
			
		</div>

	</body>

</html>
<script>
	$(function(){
		$('.delete').on('click',function(){
			$(this).parents('ul').remove();
			cart_id = $(this).parents('ul').attr('data');
			console.log('/thinkphp/Home/Person/ajaxDel/cart_id/'+cart_id);
			$.ajax({
				url:'/thinkphp/Home/Person/ajaxDel/cart_id/'+cart_id,
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
</script>