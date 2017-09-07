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
		购物车 <a href="http://<?=site_url('PublicC/logout')?>">退出</a>
	</div>
	<div class="center">
		<table id="car" class="car">
			
		</table>
		<table id="total" class="car">
			
		</table>
	</div>

</body>

<script>
	$(function(){

		$('body').on('click','.sub',function(){
			var goodid = $(this).parent().attr('goodid');
			var qty = $(this).parent().attr('qty')*(-1);
			var totalqty = $(this).parent().attr('totalqty');
			if(totalqty<=1){
				if(!confirm("确定要删除该商品吗?")){
					return;
				}
			}
			addcar(goodid,qty);
		});

		$('body').on('click','.add',function(){
			var goodid = $(this).parent().attr('goodid');
			var qty = $(this).parent().attr('qty')*(1);
			var store = $(this).parent().attr('store');
			var totalqty = $(this).parent().attr('totalqty');
			if(parseInt(totalqty)>=parseInt(store)){
				alert("库存不足 ");
				return;
			}
			addcar(goodid,qty);
		});
		

		getcarlist();
		function getcarlist(){
			$.ajax({
				url:"http://<?=site_url('Center/getcarlist') ?>",
				type:'post',
				cache:false,
				async:true,
				data:{
				}
			}).done(function(carlist){
				var carlist = eval("("+carlist+")");
				var html = "";
				if(carlist.length==0){
					$('#car').html(html);
					return;
				}
				for(var i in carlist){
					html+='<tr>'+
								'<td class="top" colspan=4>商品：'+carlist[i]['name']+'&nbsp;&nbsp;&nbsp;库存：'+carlist[i]['store']+'</td>'+
						  '</tr>'+
						  '<tr goodid="'+carlist[i]['goodid']+'" qty="'+carlist[i]['qty']+'" >'+
							//  '<td class="bottom">规格： <span>尺寸：'+carlist[i]['options']['Size']+'</span> <span>颜色：'+carlist[i]['options']['Color']+'</span></td>'+
							  '<td class="bottom">数量：'+carlist[i]['qty']+'</td>'+
							  '<td class="bottom">单价：'+carlist[i]['price']+'</td>'+
							  '<td class="bottom">总价：'+carlist[i]['total']+'</td>'+
							  '<td class="bottom" store="'+carlist[i]['store']+'" goodid="'+carlist[i]['goodid']+'" qty="1" totalqty='+carlist[i]['qty']+'><input class="as sub" type="button" value=" - " /><input class="as add"  type="button" value="+" /</td>'+
						  '</tr>';
					 $('#car').html(html);
				}
				getcartotal();
			}).fail(function(error){
				console.log(error);
			});
		}

		function addcar(goodid,qty){
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
				//alert(st);
				if(parseInt(st)){
					getcarlist();
				}
				
			}).fail(function(error){
				console.log(error);
			});
		}

		function getcartotal(){
			$.ajax({
				url:"http://<?=site_url('Center/getcartotal') ?>",
				type:'post',
				cacht:false,
				async:true,
				data:{}
			}).done(function(total){
				alert(total);
			}).fail(function(error){
				console.log(error);
			});
		}
	});
</script>