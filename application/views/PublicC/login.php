<?php

?>
<!DOCTYPE />
	   <meta charset="UTF-8">
	   <title>登录</title>
   <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
   <meta name="apple-mobile-web-app-capable" content="yes">
   <meta name="apple-mobile-web-app-status-bar-style" content="black">
   <meta name="format-detection" content="telephone=no">
   <meta name="description" content="{bb:$vote.title}">
   
  <script src="/public/js/jquery-1.11.2.min.js"></script>
<head>
	<style>
		.top {width:100%;text-align:center;height:60px;line-height:60px;}
		.form {margin:auto auto;text-align:center;}
		input {width:92%;height:42px;margin-top:2px;}
	</style>
</head>
<body style="margin:0px 0px;">
	<div class="top">
		登陆页面
	</div>
	<div class="form">
		<form action="" method="post" >
			<input type="text" name="user[username]" placeholder="请输入用户名">
			<input type="password" name="user[password]" placeholder="请输入密码">
			<!-- <input type="ppassword" id="ppassword" placeholder="请再次输入密码" /> -->
			<input type="hidden" name="_logintoken" value="<?=$logintoken?>" />
			<br>
			<span style="color:red;font-size:80%;"><?=$mes;?></span>
			<br>
			<input type="submit" name="btn" value="登陆" />
			<br><br>
			<a href="<?php site_url('PublicC/register');?>">注册</a>
			<br>
		</form>
	</div>
</body>

<script>
	$(function(){

		$("form").submit(function(e){
			 //var password = $().val();
		});
		
	});
</script>