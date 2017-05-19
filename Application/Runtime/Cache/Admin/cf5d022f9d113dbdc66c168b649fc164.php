<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>SHOP 管理中心 - 品牌管理 </title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="<?php echo (ADMIN_PUBLIC); ?>/styles/general.css" rel="stylesheet" type="text/css" />
<link href="<?php echo (ADMIN_PUBLIC); ?>/styles/main.css" rel="stylesheet" type="text/css" />
</head>
<body>

<h1>
<span class="action-span"><a href="/shop/index.php/Admin/GoodsShow/index">商品品牌</a></span>
<span class="action-span1"><a href="index.php?act=main">SHOP 管理中心</a> </span><span id="search_id" class="action-span1">—首页轮播图上传 </span>
<div style="clear:both"></div>
</h1>

<div class="main-div">
<form method="post" action="" name="theForm" enctype="multipart/form-data" onsubmit="return validate()">
<table cellspacing="1" cellpadding="3" width="100%">
  <tbody><tr>
    <td class="label">商品名称</td>
    <td><input type="text" name="goods-name" maxlength="60" value=""><span class="require-field">*</span>上传图片：
  <input type="file" name="goods_image" maxlength="60" size="40" ></td>
  </tr>
  
 
 
  <tr>
    <td colspan="2" align="center"><br>
      <input type="submit" class="button" value=" 确定 ">
      <input type="reset" class="button" value=" 重置 ">
    </td>
  </tr>
</tbody></table>
</form>
</div>


<div id="footer">
	<meta charset=utf-8>
<div id="footer">
	版权 &copy; 天津科技大学-毕业设计 </div>
</div>
</div>

</body>
</html>