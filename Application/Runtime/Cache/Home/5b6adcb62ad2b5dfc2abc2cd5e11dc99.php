<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
	<title>用户登录</title>
	<link rel="stylesheet" href="/shop/Public/css/base.css" />
	<link rel="stylesheet" href="/shop/Public/css/global.css" />
	<link rel="stylesheet" href="/shop/Public/css/login-register.css" />、
	<script src="/shop/Public/js/jquery-1.11.2.min.js"></script>
	<script type="text/javascript">
$(document).ready(function(){
$('#submit').click(function(){
	/*登录验证*/
if($('#name').val()==""){
	alert("登录名不能为空!!");
	return;
}
if($('#password').val()==""){
	alert("密码不能为空!!");
	return;
	
}
if($('#captcha').val()==""){
	alert("验证码不能为空!!");
	return;
	
}
$.ajax({
	type:"post",
	url:"<?php echo U('Home/Login/index');?>",
	data:$('#form').serialize(),
	success:function(data){
		
	if(data==1){
		window.location.href="<?php echo U('Home/index/index');?>";
	}else{
		alert(data);
	}
	},
});
});
});


</script>
</head>
<body>
	
	
	<div class="header wrap1000">
		<a href=""><img src="/shop/Public/images/logo.png" alt="" /></a>
	</div>
	
	<div class="main">
		<div class="login-form fr">
			<div class="form-hd">
				<h3>用户登录</h3>
			</div>
			<div class="form-bd">
				<form id="form" action="" method="POST">
					<dl>
						<dt>用户名</dt>
						<dd><input type="text" name="username" class="text" id="name"/></dd>
					</dl>
					<dl>
						<dt>密&nbsp;&nbsp;&nbsp;&nbsp;码</dt>
						<dd><input type="password" name="password" class="text" id="password"/></dd>
					</dl>
					<dl>
						<dt>验证码</dt>
						<dd><input type="text" name="captcha" id="captcha"class="text" size="10" style="width:58px;"> <img src="/shop/index.php/Home/Login/code"  width="150" height="40" onclick= this.src="/shop/index.php/Home/Login/code/"+Math.random() alt="CAPTCHA" align="absmiddle" style="position:relative;top:-2px;" title="看不清，重新选一张" /></dd>
					</dl>
					<dl>
						<dt>&nbsp;</dt>
						<dd><input type="button" value="登  录" class="submit" id="submit" /> <a href="/shop/index.php/Home/Login/password_eidt" class="forget">忘记密码?</a></dd>
					</dl>
				</form>
				<dl>
					<dt>&nbsp;</dt>
					<dd> 还不是本站会员？立即 <a href="/shop/index.php/Home/Login/register" class="register">注册</a></dd>
				</dl>
				<dl class="other">
					<dt>&nbsp;</dt>
					<dd>
						<p>您可以用合作伙伴账号登录：</p>
						<a href="" class="qq"></a>
						<a href="" class="sina"></a>
					</dd>
				</dl>
			</div>
			<div class="form-ft">
			
			</div>		
		</div>
		
		<div class="login-form-left fl">
			<img src="/shop/Public/images/left.jpg" alt="" />
		</div>
	</div>
	
	<div class="footer clear wrap1000">
		<p> <a href="">首页</a> | <a href="">招聘英才</a> | <a href="">广告合作</a> | <a href="">关于ShopCZ</a> | <a href="">联系我们</a></p>
		<p>Copyright 天津科技大学-毕业设计</p>
	</div>
	

</body>
</html>