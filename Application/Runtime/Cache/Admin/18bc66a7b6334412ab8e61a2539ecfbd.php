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
<span class="action-span1"><a href="index.php?act=main">SHOP 管理中心</a> </span><span id="search_id" class="action-span1"> - 订单列表 </span>
<div style="clear:both"></div>
</h1>

<div class="form-div">
  <form action="<?php echo U('Admin/Order/index');?>" method="post">
    <img src="<?php echo (ADMIN_PUBLIC); ?>/images/icon_view.gif" width="26" height="22" border="0" alt="SEARCH">
     <input type="text" name="order_name" size="15">
    <input type="submit" value=" 搜索 " class="button">
      <a  style="margin-left: 5px"  class="button" href="<?php echo U('Admin/Order/phpexcel');?>">导出Excel</a>
  </form>

</div>

<form method="post" action="" name="listForm">
<!-- start brand list -->
<div class="list-div" id="listDiv">

  <table cellpadding="3" cellspacing="1">
    <tbody>
		<tr>
			<th>订单号(单击查看订单详情)</th>
			<th>用户名</th>
			<th>联系电话</th>
			<th>订单状态</th>
			<th>送货方式</th>
      <th>快递费用</th>
			<th>支付方式</th>
      <th>总金额</th>
		</tr>
      <?php if(is_array($order)): $i = 0; $__LIST__ = $order;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
      <td class="first-cell" style="margin-left: 10px"><a href="../data/brandlogo/1240803062307572427.gif" target="_brank"><?php echo ($vo["order_sn"]); ?></a>
      </td>
      <td align="center"><?php echo ($vo["user_name"]); ?></td>
      <td align="center" ><?php echo ($vo["telephone"]); ?></td>
      <td align="center"><?php echo ($vo["order_status"]); ?></span></td>
      <td align="center"><?php echo ($vo["shipping_name"]); ?></td>
      <td align="center"><?php echo ($vo["shipping_fee"]); ?></td>
      <td align="center"><?php echo ($vo["pay_name"]); ?></td>
       <td align="center"><?php echo ($vo["order_amount"]); ?></td>

      
    </tr><?php endforeach; endif; else: echo "" ;endif; ?>
    <tr>
		<td align="right" nowrap="true" colspan="6">
            <div id="turn-page">
            <?php echo ($page); ?>
     
      </div>
      </td>
    </tr>
  </tbody>

  </table>

<!-- end brand list -->
</div>
</form>


<div id="footer">
	<meta charset=utf-8>
<div id="footer">
	版权 &copy; 天津科技大学-毕业设计 </div>
</div>
</div>

</body>
</html>