<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
	<title></title>
	<link href="<?php echo (ADMIN_PUBLIC); ?>/tyles/general.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo (ADMIN_PUBLIC); ?>/styles/main.css" rel="stylesheet" type="text/css" />
</head>
<body>
<h1>
	<span class="action-span"><a href="/shop/index.php/Admin/Goods/add">添加新商品</a></span>
	<span class="action-span1"><a href="index.php?act=main">SHOP 管理中心</a> </span><span id="search_id" class="action-span1"> - 商品列表 </span>
	<div style="clear:both"></div>
</h1>

<div class="form-div">
  <form action="" name="searchForm">
    <img src="<?php echo (ADMIN_PUBLIC); ?>/images/icon_search.gif" width="26" height="22" border="0" alt="SEARCH">
        <!-- 分类 -->
    <select name="cat_id">
		<option value="0">所有分类</option>
		<option value="1">手机类型</option>
		<option value="4">&nbsp;&nbsp;&nbsp;&nbsp;3G手机</option>
		<option value="5">&nbsp;&nbsp;&nbsp;&nbsp;双模手机</option>
		<option value="2">&nbsp;&nbsp;&nbsp;&nbsp;CDMA手机</option>
		<option value="3">&nbsp;&nbsp;&nbsp;&nbsp;GSM手机</option>
		<option value="12">充值卡</option>
		<option value="15">&nbsp;&nbsp;&nbsp;&nbsp;联通手机充值卡</option>
		<option value="13">&nbsp;&nbsp;&nbsp;&nbsp;小灵通/固话充值卡</option>
		<option value="14">&nbsp;&nbsp;&nbsp;&nbsp;移动手机充值卡</option>
		<option value="6">手机配件</option>
		<option value="11">&nbsp;&nbsp;&nbsp;&nbsp;读卡器和内存卡</option>
		<option value="7">&nbsp;&nbsp;&nbsp;&nbsp;充电器</option>
		<option value="8">&nbsp;&nbsp;&nbsp;&nbsp;耳机</option>
		<option value="9">&nbsp;&nbsp;&nbsp;&nbsp;电池</option>
	</select>
    <!-- 品牌 -->
    <select name="brand_id">
		<option value="0">所有品牌</option>
		<option value="1">诺基亚</option>
		<option value="10">金立</option>
		<option value="9">联想</option>
		<option value="8">LG</option>
		<option value="7">索爱</option>
		<option value="6">三星</option>
		<option value="5">夏新</option>
		<option value="4">飞利浦</option>
		<option value="3">多普达</option>
		<option value="2">摩托罗拉</option>
		<option value="11">  恒基伟业</option>
	</select>
    <!-- 推荐 -->
    <select name="intro_type">
		<option value="0">全部</option>
		<option value="is_best">精品</option>
		<option value="is_new">新品</option>
		<option value="is_hot">热销</option>
		<option value="is_promote">特价</option>
		<option value="all_type">全部推荐</option>
	</select>
         
     <!-- 供货商 -->
     <select name="suppliers_id">
		<option value="0">全部</option>
		<option value="1">北京供货商</option>
		<option value="2">上海供货商</option>
	</select>
    <!-- 上架 -->
     <select name="is_on_sale">
		<option value="">全部</option>
		<option value="1">上架</option>
		<option value="0">下架</option>
	</select>
	<!-- 关键字 -->
		关键字 <input type="text" name="keyword" size="15">
		<input type="submit" value=" 搜索 " class="button">
  </form>
</div>

<form method="post" action="" name="listForm" onsubmit="return confirmSubmit(this)">
  <!-- start goods list -->
	<div class="list-div" id="listDiv">
		<table cellpadding="3" cellspacing="1">
			<tbody>
				<tr>
					<th><input type="checkbox">编号</th>
					<th>商品名称</th>
					<th>货号</th>
					<th>价格</th>
					<th>上架</th>
					<th>精品</th>
					<th>新品</th>
					<th>热销</th>
					<th>商品描述</th>
					<th>库存</th>
					<th>操作</th>
				</tr>
				<tr></tr>
				<?php if(is_array($goods)): $i = 0; $__LIST__ = $goods;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
					<td><input type="checkbox" name="checkboxes[]" value="<?php echo ($vo["goods_id"]); ?>"><?php echo ($vo["goods_id"]); ?></td>
					<td class="first-cell"><span><?php echo ($vo["goods_name"]); ?></span></td>
					<td><span><?php echo ($vo["goods_sn"]); ?></span></td>
					<td align="right"><span><?php echo ($vo["shop_price"]); ?></span></td>
					<td align="center"><?php if($vo['is_onsale'] == 1): ?><img src="<?php echo (ADMIN_PUBLIC); ?>/images/yes.gif" onclick=""> <?php else: ?><img src="<?php echo (ADMIN_PUBLIC); ?>/images/no.gif" onclick=""><?php endif; ?></td>
					<td align="center"><?php if($vo['is_best'] == 1): ?><img src="<?php echo (ADMIN_PUBLIC); ?>/images/yes.gif" onclick=""> <?php else: ?><img src="<?php echo (ADMIN_PUBLIC); ?>/images/no.gif" onclick=""><?php endif; ?></td>
					<td align="center"><?php if($vo['is_new'] == 1): ?><img src="<?php echo (ADMIN_PUBLIC); ?>/images/yes.gif" onclick=""> <?php else: ?><img src="<?php echo (ADMIN_PUBLIC); ?>/images/no.gif" onclick=""><?php endif; ?></td>
					<td align="center"><?php if($vo['is_hot'] == 1): ?><img src="<?php echo (ADMIN_PUBLIC); ?>/images/yes.gif" onclick=""> <?php else: ?><img src="<?php echo (ADMIN_PUBLIC); ?>/images/no.gif" onclick=""><?php endif; ?></td>
					<td align="center"><span onclick=""><?php echo ($vo["goods_desc"]); ?></span></td>
					<td align="right"><span onclick=""><?php echo ($vo["goods_number"]); ?></span></td>
					<td align="center">
						<a href="../goods.php?id=32" target="_blank" title="查看"><img src="<?php echo (ADMIN_PUBLIC); ?>/images/icon_view.gif" width="16" height="16" border="0"></a>
						<a href="goods.php?act=edit&amp;goods_id=32" title="编辑"><img src="<?php echo (ADMIN_PUBLIC); ?>/images/icon_edit.gif" width="16" height="16" border="0"></a>
						<a href="goods.php?act=copy&amp;goods_id=32" title="复制"><img src="<?php echo (ADMIN_PUBLIC); ?>/images/icon_copy.gif" width="16" height="16" border="0"></a>
						<a href="javascript:;" onclick="listTable.remove(32, '您确实要把该商品放入回收站吗？')" title="回收站"><img src="<?php echo (ADMIN_PUBLIC); ?>/images/icon_trash.gif" width="16" height="16" border="0"></a>
						<a href="goods.php?act=product_list&amp;goods_id=32" title="货品列表"><img src="<?php echo (ADMIN_PUBLIC); ?>/images/icon_docs.gif" width="16" height="16" border="0"></a>          
					</td>
				</tr><?php endforeach; endif; else: echo "" ;endif; ?>
	
  
  </tbody>
 </table>
<!-- end goods list -->

	<!-- 分页 -->
	<?php echo ($page); ?>
</div>
<div>
	<input type="hidden" name="act" value="batch">
	<select name="type" id="selAction" onchange="changeAction()">
		<option value="">请选择...</option>
		<option value="trash">回收站</option>
		<option value="on_sale">上架</option>
		<option value="not_on_sale">下架</option>
		<option value="best">精品</option>
		<option value="not_best">取消精品</option>
		<option value="new">新品</option>
		<option value="not_new">取消新品</option>
		<option value="hot">热销</option>
		<option value="not_hot">取消热销</option>
		<option value="move_to">转移到分类</option>
		<option value="suppliers_move_to">转移到供货商</option>
	</select>

    <input type="hidden" name="extension_code" value="">
    <input type="submit" value=" 确定 " id="btnSubmit" name="btnSubmit" class="button" disabled="true">
</div>
</form>

<div id="footer">
	版权所有 &copy; 天津科技大学 毕业设计 
</div>

</body>
</html>