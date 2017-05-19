<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
	<title>购物车页面</title>
	<link rel="stylesheet" href="/shop/Public/css/base.css" type="text/css" />
	<link rel="stylesheet" href="/shop/Public/css/shop_common.css" type="text/css" />
	<link rel="stylesheet" href="/shop/Public/css/shop_header.css" type="text/css" />
	<link rel="stylesheet" href="/shop/Public/css/shop_gouwuche.css" type="text/css" />
    <script type="text/javascript" src="/shop/Public/js/jquery.js" ></script>
    <script type="text/javascript" src="/shop/Public/js/topNav.js" ></script>
    <script type="text/javascript" src="/shop/Public/js/jquery.goodnums.js" ></script>
    <script type="text/javascript" src="/shop/Public/js/shop_gouwuche.js" ></script>
	<script type="text/javascript" src="/shop/Public/js/vue.min.js" ></script>

    <style type="text/css">
    .shop_bd_shdz_title{width:1000px; margin-top: 10px; height:50px; line-height: 50px; overflow: hidden; background-color:#F8F8F8;}
    .shop_bd_shdz_title h3{width:120px; text-align: center; height:40px; line-height: 40px; font-size: 14px; font-weight: bold;  background:#FFF; border:1px solid #E8E8E8; border-radius:4px 4px 0 0; float: left;  position: relative; top:10px; left:10px; border-bottom: none;}
    .shop_bd_shdz_title p{float: right;}
    .shop_bd_shdz_title p a{margin:0 8px; color:#555555;}

	.shop_bd_shdz_lists{width:1000px;}
	.shop_bd_shdz_lists ul{width:1000px;}
	.shop_bd_shdz_lists ul li{width:980px; border-radius: 3px; margin:5px 0; padding-left:18px; line-height: 40px; height:40px; border:1px solid #FFE580; background-color:#FFF5CC;}
	.shop_bd_shdz_lists ul li label{color:#626A73; font-weight: bold;}
	.shop_bd_shdz_lists ul li label span{padding:10px;}
	.shop_bd_shdz_lists ul li em{margin:0 4px; color:#626A73;}

	.shop_bd_shdz{width:1000px; margin:10px auto 0;}
	.shop_bd_shdz_new{border:1px solid #ccc; width:998px;}
	.shop_bd_shdz_new div.title{width:990px; padding-left:8px; line-height:35px; height:35px; border-bottom:1px solid #ccc; background-color:#F2F2F2; font-color:#656565; font-weight: bold; font-size:14px;}
	.shdz_new_form{width:980px; padding:9px;}
	.shdz_new_form ul{width:100%;}
	.shdz_new_form ul li{clear:both; width:100%; padding:5px 0; height:25px; line-height: 25px;}
	.shdz_new_form ul li label{float:left;width:100px; text-align: right; padding-right: 10px;}
	.shdz_new_form ul li label span{color:#f00; font-weight: bold; font-size:14px; position: relative; left:-3px; top:2px;}
    </style>

	<script type="text/javascript">
	function minus(id,num,price)
		{
       $('#xiaoji_'+id).text((num-1)*price);
			$.ajax({
				type:"POST",
				url:"/shop/index.php/Home/Shop/minus",
				data:{
					goods_id:id,
				},
				success:function(msg){

				}
			});


		}
		function add(id,num,price)
		{
            $('#xiaoji_'+id).text((num+1)*price);
			$.ajax({
				type:"POST",
				url:"/shop/index.php/Home/Shop/add",
				data:{
					goods_id:id,
				},
				success:function(msg){
				
				}
			});


		}
	jQuery(function(){
		jQuery("#new_add_shdz_btn").toggle(function(){
			jQuery("#new_add_shdz_contents").show(500);
		},function(){
			jQuery("#new_add_shdz_contents").hide(500);
		});
	});
	$(document).ready(function() {
        $('#fukuang').click(function () {
            var text = $('#good_zongjia').text();
            if (confirm('你将要支付' + text + "元人民币，即将跳转支付界面！")){
            $('#form_order').submit();
        }
        })
    })

	</script>

</head>
<body>
		<!-- Header  -wll-2013/03/24 -->
	<div class="shop_hd">
		<!-- Header TopNav -->
		<div class="shop_hd_topNav">
			<div class="shop_hd_topNav_all">
				<!-- Header TopNav Left -->
				<div class="shop_hd_topNav_all_left">
					<p>您好&nbsp;<?php echo ($user['user_name']); ?>，欢迎来到<b><a href="/shop/index.php">泰达小店</a>
					<?php if(session('User') == ''): ?></b>[<a href="/shop/index.php/Home/login/index">登录</a>][<a href="/shop/index.php/Home/Login/register">注册</a>]<?php else: echo ($user['user_name']); ?>你已经成功登陆<?php endif; ?></p>
				</div>
				<!-- Header TopNav Left End -->

				<!-- Header TopNav Right -->
				<div class="shop_hd_topNav_all_right">
					<ul class="topNav_quick_menu">

						<li>
							<div class="topNav_menu">
								<a href="/shop/index.php/Home/Shop/index" class="topNavHover">我的商城<i></i></a>
								<div class="topNav_menu_bd" style="display:none;" >
						            <ul>
						              <li><a title="已买到的商品" target="_top" href="#">已买到的商品</a></li>
						              <li><a title="个人主页" target="_top" href="#">个人主页</a></li>
						              <li><a title="我的好友" target="_top" href="#">我的好友</a></li>
						            </ul>
						        </div>
							</div>
						</li>
               

						<li>
							<div class="topNav_menu">
								<a href="/shop/index.php/Home/Shop/shopCar" class="topNavHover">购物车<b><?php echo ($num); ?></b>种商品<i></i></a>
								<div class="topNav_menu_bd" style="display:none;">
									<!--
						            <ul>
						              <li><a title="已售出的商品" target="_top" href="#">已售出的商品</a></li>
						              <li><a title="销售中的商品" target="_top" href="#">销售中的商品</a></li>
						            </ul>
						        	-->
						            <p>还没有商品，赶快去挑选！</p>
						        </div>
							</div>
						</li>

						<li>
							<div class="topNav_menu">
								<a href="#" class="topNavHover">我的收藏<i></i></a>
								<div class="topNav_menu_bd" style="display:none;">
						            <ul>
						              <li><a title="收藏的商品" target="_top" href="#">收藏的商品</a></li>
						              <li><a title="收藏的店铺" target="_top" href="#">收藏的店铺</a></li>
						            </ul>
						        </div>
							</div>
						</li>

						<li>
							<div class="topNav_menu">
								<a href="#">站内消息</a>
							</div>
						</li>
						<li>
							<div class="topNav_menu">
								<a href="/shop/index.php/Home/Login/logout">退出</a>
							</div>
						</li>

					</ul>
				</div>
				<!-- Header TopNav Right End -->
			</div>
			<div class="clear"></div>
		</div>
		<div class="clear"></div>
		<!-- Header TopNav End -->

		<!-- TopHeader Center -->
		<div class="shop_hd_header">
			<div class="shop_hd_header_logo"><h1 class="logo"><a href="/shop"><img src="/shop/Public/images/logo.png" alt="ShopCZ" /></a><span>ShopCZ</span></h1></div>
			<div class="shop_hd_header_search">
                            <ul class="shop_hd_header_search_tab">
			        <li id="search" class="current">商品</li>
			    </ul>
                            <div class="clear"></div>
			    <div class="search_form">
			    	<form method="post" action="index.php">
			    		<div class="search_formstyle">
			    			<input type="text" class="search_form_text" name="search_content" value="搜索其实很简单！" />
			    			<input type="submit" class="search_form_sub" name="secrch_submit" value="" title="搜索" />
			    		</div>
			    	</form>
			    </div>
                            <div class="clear"></div>
			    <div class="search_tag">
			    	<a href="">小米</a>
			    	<a href="">苹果6S</a>
			    	<a href="">华为note</a>
			    	<a href="">双肩包</a>
			    	<a href="">手提包</a>
			    </div>

			</div>
		</div>
		<div class="clear"></div>
		<!-- TopHeader Center End -->

		<!-- Header Menu -->
		<div class="shop_hd_menu">
			<!-- 所有商品菜单 -->
                        
			<div class="shop_hd_menu_all_category <?php if(($index) == "true"): ?>shop_hd_menu_hover<?php endif; ?>" <?php if(($index) != "true"): ?>id="shop_hd_menu_all_category"<?php endif; ?> ><!-- 首页去掉 id="shop_hd_menu_all_category" 加上clsss shop_hd_menu_hover -->
				<div class="shop_hd_menu_all_category_title"><h2 title="所有商品分类"><a href="javascript:void(0);">所有商品分类</a></h2><i></i></div>
				<div id="shop_hd_menu_all_category_hd" class="shop_hd_menu_all_category_hd">
					<ul class="shop_hd_menu_all_category_hd_menu clearfix">
						<!-- 单个菜单项 -->
						<?php if(is_array($cats)): $k = 0; $__LIST__ = $cats;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($k % 2 );++$k; if($k < 9): ?><li id="cat_1" class="">
							<h3><a href="/shop/index.php/Home/Category/index/id/<?php echo ($vo["cat_id"]); ?>" title="？？"><?php echo ($vo["cat_name"]); ?></a></h3>
							<div id="cat_1_menu" class="cat_menu clearfix" style="">
								<?php if(is_array($vo["child"])): $i = 0; $__LIST__ = $vo["child"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo1): $mod = ($i % 2 );++$i;?><dl class="clearfix">
									<dt><a href="/shop/index.php/Home/Category/index/id/<?php echo ($vo1["cat_id"]); ?>"><?php echo ($vo1["cat_name"]); ?></a></dt>
									<dd>
										<?php if(is_array($vo1["child"])): $i = 0; $__LIST__ = $vo1["child"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo2): $mod = ($i % 2 );++$i;?><a href="/shop/index.php/Home/Category/index/id/<?php echo ($vo2["cat_id"]); ?>"><?php echo ($vo2["cat_name"]); ?></a><?php endforeach; endif; else: echo "" ;endif; ?>
									</dd>
								</dl><?php endforeach; endif; else: echo "" ;endif; ?>                                                     
							</div>
						</li><?php endif; ?>
						<!-- 单个菜单项 End --><?php endforeach; endif; else: echo "" ;endif; ?>
					</ul>
				</div>
			</div>
			<!-- 所有商品菜单 END -->

			<!-- 普通导航菜单 -->
			<ul class="shop_hd_menu_nav">
				<li class="current_link"><a href=""><span>首页</span></a></li>
				<li class="link"><a href=""><span>泰达服装城</span></a></li>
				<li class="link"><a href=""><span>泰达美妆馆</span></a></li>
				<li class="link"><a href=""><span>泰达超市</span></a></li>
				<li class="link"><a href=""><span>泰达小购</span></a></li>
				<li class="link"><a href=""><span>泰达吃喝玩</span></a></li>
				<li class="link"><a href=""><span>泰达团购</span></a></li>
			</ul>
			<!-- 普通导航菜单 End -->
		</div>
		<!-- Header Menu End -->



	

	<!-- Header End -->
	
	<!-- 购物车 Body -->

	<div class="shop_gwc_bd clearfix">
		<div class="shop_gwc_bd_contents clearfix">

			<!-- 购物流程导航 -->
			<div class="shop_gwc_bd_contents_lc clearfix">
				<ul>
					<li class="step_a">确认购物清单</li>
					<li class="step_b hover_b">确认收货人资料及送货方式</li>
					<li class="step_c">购买完成</li>
				</ul>
			</div>
			<!-- 购物流程导航 End -->
			<div class="clear"></div>
			<!-- 收货地址 title -->
			<div class="shop_bd_shdz_title">
				<h3>收货人地址</h3>
				<p><a href="javasrcipt:void(0);" id="new_add_shdz_btn">新增收货地址</a><a href="/shop/index.php/Home/Shop/address">管理收货地址</a></p>
			</div>
			<div class="clear"></div>
			<!-- 收货人地址 Title End -->
			<form  method="post" action="/shop/index.php/Home/Shop/order" id="form_order">
			<div class="shop_bd_shdz clearfix">
				<div class="shop_bd_shdz_lists clearfix">

					<ul>
					<?php if(is_array($res)): foreach($res as $key=>$vo): ?><li><label>寄送至：<span>
							<input type="radio" name="address" id="address" value="<?php echo ($vo["address_id"]); ?>"/></span></label><em>北京</em><em>北京市</em><em>昌平区</em><em><?php echo ($vo["street"]); ?></em><em><?php echo ($vo["consignee"]); ?>(收)</em><em><?php echo ($vo["mobile"]); ?></em></li><?php endforeach; endif; ?>
						</br>
					</br>
                     
						请选择送货方式:&nbsp;&nbsp;<select name="shipping" id="shipping">
							<?php if(is_array($shipping)): foreach($shipping as $key=>$vo): ?><option value="<?php echo ($vo["shipping_id"]); ?>"><?php echo ($vo["shipping_name"]); ?></option><?php endforeach; endif; ?>

						</select>
						&nbsp;&nbsp;
						请选择支付方式：&nbsp;&nbsp;<select name="payment" id="payment">
							<?php if(is_array($payment)): foreach($payment as $key=>$vo): ?><option value="<?php echo ($vo["pay_id"]); ?>"><?php echo ($vo["pay_name"]); ?></option><?php endforeach; endif; ?>
						</select>
						</br></br></br>
						订单可以附加留言：<input type="textarea" style="WIDTH:200px; HEIGHT:35px" name="liuyan" id="liuyan" rows=7 cols=57  value="" placeholder="单击请输入留言"/>
						 
								
					</ul>
				</div>
			</form>
				<!-- 新增收货地址 -->
				<div id="new_add_shdz_contents" style="display:none;" class="shop_bd_shdz_new clearfix">
					<div class="title">新增收货地址</div>
					<div class="shdz_new_form">
						<form action="/shop/index.php/Home/Shop/shopcar2" method="post">
							<ul>
								<li><label for=""><span>*</span>收货人姓名：</label><input type="text" class="name" name=""consignee/></li>
								<li><label for=""><span>*</span>所在地址：</label>
									<select name="province">
										<option value="">北京</option>
									</select>
									<select name="city">
										<option value="">北京</option>
									</select>
									<select name="district">
										<option value="">昌平</option>
									</select>
								</li>
								<li><label for=""><span>*</span>详细地址：</label><input type="text" class="xiangxi" name="street"/></li>
								<li><label for=""><span></span>邮政编码：</label><input type="text" class="youbian" name="zipcode"/></li>
								<li><label for=""><span></span>电话：</label><input type="text" class="dianhua" name="telephone" /></li>
								<li><label for=""><span></span>手机号：</label><input type="text" class="shouji" name="mobile" /></li>
								<li><label for="">&nbsp;</label><input type="submit" value="增加收货地址" /></li>
							</ul>
						</from>
					</div>
				</div>
				<!-- 新增收货地址 End -->
			</div>
			<div class="clear"></div>
			<!-- 购物车列表 -->
			<div class="shop_bd_shdz_title">
				<h3>确认购物清单</h3>
			</div>
			<div class="clear"></div>
			<table>
				<thead>
					<tr>
						<th colspan="2"><span>商品</span></th>
						<th><span>单价(元)</span></th>
						<th><span>数量</span></th>
						<th><span>小计</span></th>
						<th><span>操作</span></th>
					</tr>
				</thead>
				<tbody>


                   <?php if(is_array($goodsRes)): foreach($goodsRes as $key=>$vo): ?><tr id="goods_list">
						<td class="gwc_list_pic"><a href=""><img style="height:50px; width:50px;"src="/shop<?php echo ($vo["goods_img"]); ?>" /></a></td>
						<input type="hidden" name="goods_id" class="goods_id" value="<?php echo ($vo["goods_id"]); ?>">
						<td class="gwc_list_title"><a href=""><?php echo ($vo["goods_name"]); ?></a></td>
						<td class="gwc_list_danjia"><span>￥<strong ><?php echo ($vo["shop_price"]); ?></strong></span></td>
						<td class="gwc_list_shuliang"><span><a class="good_num_jian this_good_nums" did="danjia_001" xid="xiaoji_001" ty="-" valId="goods_001" onClick="minus(<?php echo ($vo["goods_id"]); ?>,<?php echo ($vo["goods_num"]); ?>,<?php echo ($vo["shop_price"]); ?>);">-</a><input type="text" value="<?php echo ($vo["goods_num"]); ?>" name="goods_001" id="goods_001" class="good_nums" /><a onClick="add(<?php echo ($vo["goods_id"]); ?>,<?php echo ($vo["goods_num"]); ?>,<?php echo ($vo["shop_price"]); ?>);" did="danjia_001" xid="xiaoji_001" ty="+" class="good_num_jia this_good_nums" valId="goods_001">+</a></span></td>
						<td class="gwc_list_xiaoji"><span>￥<strong  class="good_xiaojis" id="xiaoji_<?php echo ($vo["goods_id"]); ?>"><?php echo ($vo["subtotal"]); ?></strong></span></td>
						<td class="gwc_list_caozuo"><a href="/shop/index.php/Home/Shop/collect/goods_id/<?php echo ($vo["goods_id"]); ?>">收藏</a><a href="/shop/index.php/Home/Shop/delete/goods_id/<?php echo ($vo["goods_id"]); ?>" class="shop_good_delete">删除</a></td>
					</tr><?php endforeach; endif; ?>
					
				</tbody>
				<tfoot>
					<tr>
						<td colspan="6">
							<div class="gwc_foot_zongjia">商品总价(不含运费)<span>￥<strong id="good_zongjia"><?php echo ($total); ?></strong></span></div>
							</foreach>
					</volist>
							<div class="clear"></div>
							<div class="gwc_foot_links">
								<a href="/shop/index.php/Home/shop/shopCar" class="go">返回上一步</a>
								<a href="javascript:void(0)" class="op" id="fukuang">确认并付款</a>
							</div>
						</td>
					</tr>
				</tfoot>
			</table>
			<!-- 购物车列表 End -->

		</div>
	</div>
	<!-- 购物车 Body End -->

	<!-- Footer - wll - 2013/3/24 -->
	<div class="clear"></div>
	<div class="shop_footer">
            <div class="shop_footer_link">
                <p>
                    <a href="">首页</a>|
                    <a href="">招聘英才</a>|
                    <a href="">广告合作</a>|
                    <a href="">关于ShopCZ</a>|
                    <a href="">关于我们</a>
                </p>
            </div>
            <div class="shop_footer_copy">
                <p>Copyright 天津科技大学-毕业设计.<br />d by ShopCZ 2.4 </p>
            </div>
        </div>
	<!-- Footer End -->

</body>
</html>