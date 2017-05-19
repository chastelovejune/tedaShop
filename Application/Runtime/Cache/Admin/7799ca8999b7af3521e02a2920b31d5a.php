<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>SHOP 管理中心 - 属性管理 </title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="<?php echo (ADMIN_PUBLIC); ?>/styles/general.css" rel="stylesheet" type="text/css" />
<link href="<?php echo (ADMIN_PUBLIC); ?>/styles/main.css" rel="stylesheet" type="text/css" />
</head>
<body>

<h1>
<span class="action-span"><a href="/shop/index.php/Admin/Attribute/add">添加属性</a></span>
<span class="action-span1"><a href="index.php?act=main">SHOP 管理中心</a> </span><span id="search_id" class="action-span1"> - 商品属性 </span>
<div style="clear:both"></div>
</h1>

<div class="form-div">
  <form action="" name="searchForm">
    <img src="<?php echo (ADMIN_PUBLIC); ?>/images/icon_search.gif" width="26" height="22" border="0" alt="SEARCH">
    按商品类型显示：
    <select name="goods_type" onchange="searchAttr(this.value)">
      <?php if(is_array($types)): $i = 0; $__LIST__ = $types;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["type_id"]); ?>"
        <?php if($vo['type_id'] == $type_id): ?>selected='selected'<?php endif; ?>
        ><?php echo ($vo["type_name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
    </select>
  </form>
</div>

<form method="post" action="attribute.php?act=batch" name="listForm">
<div class="list-div" id="listDiv">

  <table cellpadding="3" cellspacing="1">
    <tbody>
		<tr>
			<th><input onclick="listTable.selectAll(this, &quot;checkboxes[]&quot;)" type="checkbox">编号 </th>
			<th>属性名称</th>
			<th>商品类型</th>
			<th>属性值的录入方式</th>
			<th>可选值列表</th>
			<th>排序</a></th>
			<th>操作</th>
		</tr>
      <?php if(is_array($attrs)): $i = 0; $__LIST__ = $attrs;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
			<td nowrap="true" valign="top"><span><input value="1" name="checkboxes[]" type="checkbox">1</span></td>
			<td class="first-cell" nowrap="true" valign="top"><span onclick="listTable.edit(this, 'edit_attr_name', 1)"><?php echo ($vo["attr_name"]); ?></span></td>
			<td nowrap="true" valign="top"><span><?php echo ($vo["type_name"]); ?></span></td>
			<td nowrap="true" valign="top"><span><?php echo ($vo["attr_input_type"]); ?></span></td>
			<td valign="top"><span></span></td>
			<td align="right" nowrap="true" valign="top"><span onclick="listTable.edit(this, 'edit_sort_order', 1)"><?php echo ($vo["sort_order"]); ?></span></td>
			<td align="center" nowrap="true" valign="top">
				<a href="?act=edit&amp;attr_id=1" title="编辑"><img src="<?php echo (ADMIN_PUBLIC); ?>/images/icon_edit.gif" border="0" height="16" width="16"></a>
				<a href="javascript:;" onclick="removeRow(1)" title="移除"><img src="<?php echo (ADMIN_PUBLIC); ?>/images/icon_drop.gif" border="0" height="16" width="16"></a>
			</td>
		</tr><?php endforeach; endif; else: echo "" ;endif; ?>

        
      </tbody></table>

  <table cellpadding="4" cellspacing="0">
    <tbody><tr>
      <td style="background-color: rgb(255, 255, 255);"><input type="submit" id="btnSubmit" value="删除" class="button" disabled="true"></td>
      <td align="right" style="background-color: rgb(255, 255, 255);">      <!-- $Id: page.htm 14216 2008-03-10 02:27:21Z testyang $ -->
            <div id="turn-page">
            <?php echo ($page); ?>
        <!--
        总计  <span id="totalRecords">12</span>
        个记录分为 <span id="totalPages">2</span>
        页当前第 <span id="pageCurrent">1</span>
        页，每页 <input type="text" size="3" id="pageSize" value="10" onkeypress="return listTable.changePageSize(event)">
        <span id="page-link">
          <a href="javascript:listTable.gotoPageFirst()">第一页</a>
          <a href="javascript:listTable.gotoPagePrev()">上一页</a>
          <a href="javascript:listTable.gotoPageNext()">下一页</a>
          <a href="javascript:listTable.gotoPageLast()">最末页</a>
          <select id="gotoPage" onchange="listTable.gotoPage(this.value)">
            <option value="1">1</option><option value="2">2</option>          </select>
        </span>
        -->
      </div>
</td>
    </tr>
  </tbody></table>
</div>

</form>

<div id="footer">
	<meta charset=utf-8>
<div id="footer">
	版权 &copy; 天津科技大学-毕业设计 </div>
</div>
</div>
  <script type='text/javascript'>
      function searchAttr(type_id) {
        window.location.href = "__SLEF__/id/"+type_id;
      }
  </script>
</body>
</html>