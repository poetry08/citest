<?php

?>
<!DOCTYPE />
 <title>个人中心</title>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
   <meta name="apple-mobile-web-app-capable" content="yes">
   <meta name="apple-mobile-web-app-status-bar-style" content="black">
   <meta name="format-detection" content="telephone=no">
   
  <script src="/public/js/jquery-1.11.2.min.js"></script>
<head>
	<style>
		.top {width:100%;text-align:center;height:60px;line-height:60px;}
		.center {border:0px solid red;margin:auto auto;text-align:center;height:400px;line-height:400px;}
		.car {width:96%;border:1px solid #eee;margin:auto auto;}
		.as {margin-left:2px;}
		.car .top {height:16px ;font-size:90%;text-align:left;}
		.car .bottom {height:20px ;font-size:90%;text-align:left;}
	</style>
</head>
<body style="margin:0px 0px;">
	<div class="top">
		商品列表 <a href="http://<?=site_url('PublicC/logout')?>">退出</a>
	</div>
	<div class="center">
		<table id="car" class="car">
			<?php foreach ($this->goodslist as $good){ ?>
				
				<tr>
					<td class="top" colspan=4>商品：<?=$good['name']?></td>
				</tr>
				<tr >
					<td class="bottom">价格：<?=$good['price']?></td>
					<td class="bottom">库存：<?=$good['store']?></td>
					<td class="bottom" goodid="<?=$good['goodid']?>" qty="1"><input class="as add"  type="button" value="加入购物车" /></td>
				</tr>
				
			<?php }
			?>
			
		</table>
	</div>

</body>

<script>
	$(function(){

		$('body').on('click','.add',function(){
			var goodid = $(this).parent().attr('goodid');
			var qty = $(this).parent().attr('qty');
			addcar(goodid,qty);
		});
		
		function addcar(goodid,qty){
			/**var d = [];
				d['goodid'] = goodid;
				d['qty'] = qty;
	
				var fd = new FormData();
				fd.append('data',d);
			**/
			
			$.ajax({
				url:"http://<?=site_url('Center/addcar') ?>",
				type:'post',
				cache:false,
				async:true,
				data:{
					goodid:goodid,
					qty:qty
				}
			}).done(function(st){
				if(parseInt(st)){
					if(confirm("是否跳转到购物车")){
						window.location.href="http://<?=site_url('Center/carlist')?>";
					}
				}
			}).fail(function(error){
				console.log(error);
			});
		}
		
	});
</script>