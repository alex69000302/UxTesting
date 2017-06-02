<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="zh-tw">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>列印撿貨單</title>
<link href="layout20161214.css" rel="stylesheet">
<style>
.tg  {border-collapse:collapse;border-spacing:0;}
.tg td{font-family:Arial, sans-serif;font-size:16px;padding:10px 5px;border-style:solid;border-width:0px;overflow:hidden;word-break:normal;border-top-width:1px;border-bottom-width:1px;}
.tg th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:0px;overflow:hidden;word-break:normal;border-top-width:1px;border-bottom-width:1px;}
.tg .tg-7oof{font-size:100%;font-family:serif !important;;vertical-align:top}
.tg .tg-baqh{text-align:center;vertical-align:top}
.tg .tg-yw4l{vertical-align:top}
.center {text-align:center;font-size:16px;font-weight:bolder;}
.checkbox {border: #000000 2px solid;width: 10px;height: 10px;margin: 0px;}
</style>
<script type="text/javascript"><!-- 
function printout() {
if (!window.print){alert("列印功能暫時停用，請按 Ctrl-P 來列印"); return;}
window.print();}
function MM_openBrWindow(theURL,winName,features) {
window.open(theURL,winName,features);}
// --></script>
</head>
<body>



<div id="header">
    <h1> (網購ROS)撿貨單</h1> 
	<?php
	include("../order/sql.php");
	$result = mysql_query("SET NAMES 'UTF8'");
	$order_uid1=$_POST["order_uid"];
	$order_uid2=$_POST["order_uid"];
	$array = count($order_uid1);
	$array2 = count($order_uid1);
	$i=0;

	?>
	</div>
	
	<div id="input_form">	
	
	<form class="w3-container w3-card-4 btn-right" action="order_df_merge.php" method="post" enctype="multipart/form-data">
	<button class="btn btn-pickupslef" name="order_uid"  value = "<?php 
		$order_uid_test = implode(",",$order_uid2);
		echo $order_uid_test;  
	?>"  >分車列印</button>
	</form>
	<form class="w3-container w3-card-4 btn-right" action="order_df_div.php" method="post" enctype="multipart/form-data">
	<button class="btn btn-confirmcheck" name="order_uid"  value = "<?php 
		$order_uid_test = implode(",",$order_uid2);
		echo $order_uid_test;  
	?>"  >分類列印</button>
	</form>
	
	
	
	<button class="btn btn-print btn-right" onclick="javascript:printout()"  >列印本頁</button>
	<p style="clear:both;"></p>
	</div>
	</div>

	  <center> 
	<?php
	while($i<$array){
	?>

<table class="tg" width="900px">
  <tr>
    <th class="tg-7oof" colspan="5"><h1>訂單編號:<?php echo "$order_uid1[$i]" ?></h1></th>
    <th class="tg-yw4l" colspan="5"><img src="http://ros.rt-mart.com.tw/website/libs/barcode/image.php?code=<?php echo "$order_uid1[$i]" ?>&style=196&type=C39&width=194&height=80&xres=1&font=12" width="194" height="80" /></th>
    </tr>
  <tr>
    <td class="tg-yw4l" colspan="5">
	印單時間:
	<?PHP $date= date("Y-m-d H:i:s"); ECHO $date?>
	
	<br>訂單日期:<?PHP
	$query = "select a.order_date,a.invoice_utcode,concat(a.invoice_zip,a.invoice_city,a.invoice_address),concat(b.order_city,'|',a.order_remarks)
	,case  
when a.web_uid = 2 then '大潤發網路購物'
when a.web_uid = 4 then '大潤發手機版'
when a.web_uid = 1599 then '大潤發冷凍館'
when a.web_uid = 1602 then '大潤發APP'
when a.web_uid = 1603 then '大潤發生鮮館'
when a.web_uid = 1597 then '大潤發平鎮店'
else  '大潤發到店取貨'
end,
case  
when a.order_specify_arrival_date = 1 then date(order_date) 
when a.order_specify_arrival_date < 7 then date_add(date(order_date),interval 1 day) 
when a.order_specify_arrival_date <= 10 then date_add(date(order_date),interval 2 day)
when order_specify_arrival_date=11 then date_add(date(order_date),interval 1 day)
when order_specify_arrival_date=12 then date_add(date(order_date),interval 2 day)
when a.order_specify_arrival_date <= 120 then date(order_date) 
when a.order_specify_arrival_date <= 220 then date_add(date(order_date),interval 1 day)
when a.order_specify_arrival_date <= 320 then date_add(date(order_date),interval 2 day)
when a.order_specify_arrival_date <= 417 then date_add(date(order_date),interval 3 day)
when a.order_specify_arrival_date <= 517 then date_add(date(order_date),interval 4 day)
when a.order_specify_arrival_date <= 617 then date_add(date(order_date),interval 5 day)
when a.order_specify_arrival_date <= 717 then date_add(date(order_date),interval 6 day)
when a.order_specify_arrival_date <= 817 then date_add(date(order_date),interval 7 day)
when a.order_specify_arrival_date <= 917 then date_add(date(order_date),interval 8 day)
else  date_add(date(a.order_date),interval 9 day)
end
,a.order_specify_arrival_date,a.web_uid,b.order_addressee,a.order_telcellphone 
from order_mf a join order_delivery b  where   a.order_uid = $order_uid1[$i] && a.order_uid = b.order_uid  limit 1 ;";
/*	20170105	生鮮預購館:新增SQL語法web_uid,order_addressee,order_telcellphone*/
		$result = mysql_query($query,$con);
		$rs = mysql_fetch_array($result);
		$firstname = mb_substr($rs[8],0,1,"utf-8");
	echo $rs[0];	?></td>
	<?php
		/*	20170105	生鮮館	*/
		if($rs[7]=='1603'){
			$order_remark = $rs[3];
			$order_remark_result = explode(',<br >',$order_remark);
		}
	?>
    <td class="tg-yw4l" colspan="5" style="text-align:right;">
	<?PHP 
		/*	20170105	生鮮館	*/
		if($rs[7]!='1603')
			ECHO '<h1>' . $rs[4] .'|'. $firstname .'OO'. '</h1>';
		else{
			//店別要顯示在這裡
			echo $rs[4] .'|'. $firstname .'OO' . '<br >' . $order_remark_result[1];
		}
	?></td>
  </tr>
  <tr>
    <td class="tg-yw4l" colspan="5" style="max-width:200px;text-align:left;word-break:break-all;">
	統一編號:<?PHP 
	
		ECHO $rs[1];
	?> <br>
	發票另寄:<br><?PHP 
	
		ECHO $rs[2];
	?><br>
	備註:<?PHP 
		/*	20170105	生鮮館	*/
		if($rs[7]!='1603')
			ECHO $rs[3] . '<br >';
		else{
			echo $order_remark_result[0] . '<br >' . $firstname .'OO'. '<br >' . $rs[9];
		}
	?></td>
    <td class="tg-yw4l" colspan="5" style="text-align:right;">
	<h1><?php
	/*	20170105	生鮮館	*/
		if($rs[7]!='1603'){
	echo '送貨時間:' . $rs[5];

	switch (true) {
case $rs[6] == '1': $time = "(15 時-20時) "; break;
case $rs[6] == '2': $time = "(9 時-12時) "; break;
case $rs[6] == '3': $time = "(12 時-17時) "; break;
case $rs[6] == '4': $time = "(17 時-20時) "; break;
case $rs[6] == '5': $time = "(15 時-20時) "; break;
case $rs[6] == '7': $time = "(9 時-12時) "; break;
case $rs[6] == '8': $time = "(12 時-17時) "; break;
case $rs[6] == '9': $time = "(17 時-20時) "; break;
case $rs[6] == '10': $time = "偏遠地區(12 時-17時) "; break;
case $rs[6] == '11': $time ="不指定"; break;
case $rs[6] == '12': $time ="不指定"; break;
case $rs[6] == '411': $time ="不指定"; break;
case $rs[6] == '511': $time ="不指定"; break;
case $rs[6] == '611': $time ="不指定"; break;
case $rs[6] == '711': $time ="不指定"; break;
case $rs[6] == '811': $time ="不指定"; break;
case $rs[6] == '911': $time ="不指定"; break;
case $rs[6] == '111': $time = "(11 時-12時)  "; break;
case $rs[6] == '112': $time = "(12 時-13時)  "; break;
case $rs[6] == '113': $time = "(13 時-14時)  "; break;
case $rs[6] == '114': $time = "(14 時-15時)  "; break;
case $rs[6] == '115': $time = "(15 時-16時)  "; break;
case $rs[6] == '116': $time = "(16 時-17時)  "; break;
case $rs[6] == '117': $time = "(17 時-18時)  "; break;
case $rs[6] == '118': $time = "(18 時-19時)  "; break;
case $rs[6] == '119': $time = "(19 時-20時)  "; break;
case $rs[6] == '120': $time = "(20 時-21時)  "; break;
case $rs[6] == '211': $time = "(11 時-12時)  "; break;
case $rs[6] == '212': $time = "(12 時-13時)  "; break;
case $rs[6] == '213': $time = "(13 時-14時)  "; break;
case $rs[6] == '214': $time = "(14 時-15時)  "; break;
case $rs[6] == '215': $time = "(15 時-16時)  "; break;
case $rs[6] == '216': $time = "(16 時-17時)  "; break;
case $rs[6] == '217': $time = "(17 時-18時)  "; break;
case $rs[6] == '218': $time = "(18 時-19時)  "; break;
case $rs[6] == '219': $time = "(19 時-20時)  "; break;
case $rs[6] == '220': $time = "(20 時-21時)  "; break;
case $rs[6] == '311': $time = "(11 時-12時)  "; break;
case $rs[6] == '312': $time = "(12 時-13時)  "; break;
case $rs[6] == '313': $time = "(13 時-14時)  "; break;
case $rs[6] == '314': $time = "(14 時-15時)  "; break;
case $rs[6] == '315': $time = "(15 時-16時)  "; break;
case $rs[6] == '316': $time = "(16 時-17時)  "; break;
case $rs[6] == '317': $time = "(17 時-18時)  "; break;
case $rs[6] == '318': $time = "(18 時-19時)  "; break;
case $rs[6] == '319': $time = "(19 時-20時)  "; break;
case $rs[6] == '320': $time = "(20 時-21時)  "; break;
case $rs[6] == '409': $time = "(9 時-12時) "; break;
case $rs[6] == '412': $time = "(12 時-17時) "; break;
case $rs[6] == '417': $time = "(17 時-20時) "; break;
case $rs[6] == '509': $time = "(9 時-12時) "; break;
case $rs[6] == '512': $time = "(12 時-17時) "; break;
case $rs[6] == '517': $time = "(17 時-20時) "; break;
case $rs[6] == '609': $time = "(9 時-12時) "; break;
case $rs[6] == '612': $time = "(12 時-17時) "; break;
case $rs[6] == '617': $time = "(17 時-20時) "; break;
case $rs[6] == '709': $time = "(9 時-12時) "; break;
case $rs[6] == '712': $time = "(12 時-17時) "; break;
case $rs[6] == '717': $time = "(17 時-20時) "; break;
case $rs[6] == '809': $time = "(9 時-12時) "; break;
case $rs[6] == '812': $time = "(12 時-17時) "; break;
case $rs[6] == '817': $time = "(17 時-20時) "; break;
case $rs[6] == '909': $time = "(9 時-12時) "; break;
case $rs[6] == '912': $time = "(12 時-17時) "; break;
case $rs[6] == '917': $time = "(17 時-20時) "; break;
case $rs[6] == '917': $time = "你大雞雞臭機掰勒~"; break;
	}
	echo $time;
}
	else{
		echo $order_remark_result[2] . '<br >' . $order_remark_result[3];
	}		
	?></h1></td>
  </tr>
  
    <?php ////20170105滿1500 實體卡號綁定送贈品  ?>
  <tr>
  <td colspan="9">
  <div id="free_gift<?php echo $order_uid1[$i]; ?>" style="display:block;border: 5px solid black;">

<h2 style="font-size:30px;"><?php

	
		

		
		
			$query = "select order_service_remarks from order_mf where order_uid = $order_uid1[$i] ;";
		$result = mysql_query($query,$con);
		$gif_is = mysql_fetch_array($result);	
			
			
				if(!empty($gif_is[0])){
					
					if($gif_is[0] > 0){
						$query = "select order_service_remarks from order_mf where order_uid = $order_uid1[$i] ;";
					$result = mysql_query($query,$con);
					$gif_no = mysql_fetch_array($result);
					echo "活動贈品 941721 桂格三合一麥片 - 麥香原味1盒  \n";
					echo $gif_no[0];
					}else{
						$query = "select order_service_remarks from order_mf where order_uid = $order_uid1[$i] ;";
					$result = mysql_query($query,$con);
					$gif_no = mysql_fetch_array($result);
					echo "不符合資格\n";
					echo $gif_no[0];	
					}
					

				}else{
					$gif_no[0] = 0;
					echo $gif_no[0]; 

				}
			
			
			
		

	?>
	<script>
	
	var gift_count = "<?php echo $gif_no[0]; ?>";
	
	console.log(gift_count);
	
	if( gift_count == "" || gift_count <= 0 || gift_count == -1 ){
	document.getElementById( 'free_gift<?php echo $order_uid1[$i] ?>' ).style.display = "none"; 
	}
	
	</script>
	</h2>
</div>
</td>
  </tr>
  <?php ////20170105滿1500 實體卡號綁定送贈品  ?>
  
      </table>
  
  
  <table class="tg" width="1000px">
  <tr>
    <td class="tg-baqh">-</td>
    <td class="tg-baqh" style="width:20%;">儲位</td>
    <td class="tg-baqh">數量</td>
    <td class="tg-baqh">貨號</td>
    <td class="tg-baqh">品名</td>
	<td class="tg-baqh">EAN</td>
	<td class="tg-baqh">Fuck</td>
    <td class="tg-baqh">單位</td>
    <td class="tg-baqh">庫存</td>
    <td class="tg-baqh">單價</td>
  </tr>
 <?php
	/*  20170315 庫存 S10 S68 區別
				$query = "select if(isnull(c.prod_no_old),b.save_input,if(d.web_uid not in (2,4,1599,1602,1603),b.save_input,c.save_input)) save_input
,sum(a.order_df_qty),b.prod_no_old,a.prod_name,b.prod_ean,b.prod_spec,
if (isnull(c.prod_no_old),b.prod_stock * 2,b.prod_stock) prod_stock,a.order_df_price 
		,b.web_uid,a.delivery_uid,b.prod_uid
from order_df a join order_mf d on a.order_uid = d.order_uid join product b on a.prod_uid = b.prod_uid 
left join tmp_EC_save_input c on b.prod_no_old = c.prod_no_old 
 &&c.prod_no_old not in (
767208,
843675,
733245
) && c.save_input NOT LIKE 'D%' 

where   a.order_uid = $order_uid1[$i] &&b.prod_selling_price>0 group by prod_no_old order by save_input ;
 ";
 */
 $query = "select if(isnull(c.prod_no_old),b.save_input,if(d.web_uid not in (2,4,1599,1602,1603),b.save_input,c.save_input)) save_input
,sum(a.order_df_qty),b.prod_no_old,a.prod_name,b.prod_ean,b.prod_spec,b.prod_stock prod_stock,a.order_df_price 
		,b.web_uid,a.delivery_uid,b.prod_uid
from order_df a join order_mf d on a.order_uid = d.order_uid join product b on a.prod_uid = b.prod_uid 
left join tmp_EC_save_input c on b.prod_no_old = c.prod_no_old 
 &&c.prod_no_old not in (
767208,
843675,
733245
) && c.save_input NOT LIKE 'D%' 

where   a.order_uid = $order_uid1[$i] &&b.prod_selling_price>0 group by prod_no_old order by save_input ;
 ";
 
		
		
		$result = mysql_query($query,$con);
		if (!$result) die ("database acess failed:" .$conn->error);	
		
		
		while (($rs = mysql_fetch_array($result)) 
		){
	  ?>
  <tr>
  <td class="tg-yw4l center"><p class="checkbox"></p></td>
    <td class="tg-yw4l center"><?php echo $rs[0];   ?></td>
    <td class="tg-yw4l" style="text-align:center;font-size:30px;font-weight:bolder;"><?php echo $rs[1];   ?></td>
    <td class="tg-yw4l center"><?php echo $rs[2];   ?></td>
    <td class="tg-yw4l center"><?php echo $rs[3];   ?></td>
    <td class="tg-yw4l center" style="width:34%;word-break:break-all;font-size:14px;"><?php echo $rs[4];   ?></td>
    <td class="tg-yw4l center"><?php echo $rs[5];   ?></td>
    <td class="tg-yw4l center"><?php echo $rs[6];   ?></td>
    <td class="tg-yw4l center">$<?php echo $rs[7];   ?></td>
  </tr>
  	<?php }?>  
	
</table>


<span>

<h2><?php
	
	$query = "select count(order_df_qty),sum(order_df_qty) from order_df where order_uid = $order_uid1[$i] ;";
		$result = mysql_query($query,$con);
		$rs = mysql_fetch_array($result);
		ECHO "SKU = $rs[0],PCS = $rs[1]";
	
	?>
	</h2>
	</span>
<h3>
	揀貨人員:________ 覆核人員:________ 安管人員:________  訂單編號:<?php echo $order_uid1[$i]; ?>
	</h3>
	<?php
	$query = "select web_uid from order_mf where order_uid = $order_uid1[$i] ;";
		$result = mysql_query($query,$con);
		$order_web = mysql_fetch_array($result);
		if($order_web[0]==1603){
			
		
	?>
	<span><h3>
	冷凍箱數:________ 冷藏箱數:________ 總共箱數:________ 
	</h3></span>
	<span><h3>
	顧客簽收:________ 送貨人員:________ 
	</h3></span>
	<?php 
	}
	$query = "update order_mf set order_status = 19 where order_uid = $order_uid1[$i] && order_status = 11;";
	$result = mysql_query($query,$con);
	
	$query = "update order_df set order_df_status = 19 where order_uid = $order_uid1[$i] && order_df_status = 11;";
	$result = mysql_query($query,$con);
	
	$query = "update order_delivery set delivery_status = 19 where order_uid = $order_uid1[$i] && delivery_status = 11;";
	$result = mysql_query($query,$con);
	
	
	
	
	
	
		$b = 0;
	
	while($b < $rs[1]){
		$date= date("Y-m-d");
		$datetime= date("Y-m-d H:i:s");
		
		
		$query = "select b.web_uid,a.delivery_uid,b.prod_uid,sum(a.order_df_qty)
from order_df a  join product b on a.prod_uid = b.prod_uid 
where    a.order_uid = $order_uid1[$i] group by prod_no_old  limit $b , 1;";
		$result = mysql_query($query,$con);
		$ra = mysql_fetch_array($result);
		$c = 0;
		$a = 1;
		while($c < $ra[3]){ 
		
		$query = "
		
		INSERT INTO order_pickup (web_uid, pickup_date, pickup_batchno, pickup_serno, delivery_uid, auto_date, wadm_uid, pickup_status, pickup_status_date, prod_uid) 
VALUES ('$ra[0]', '$date', '$ra[1]', '$a', '$ra[1]', '$datetime', '0', '1', '$date', '$ra[2][$b]');
		
		";
		$result = mysql_query($query,$con);
		
		$a++;
		$c++;
		}
		$b++;
	}
	
	
	if($i!=$array){
	?>
	<p style='page-break-after:always'> </p>
	
	<?php 
	}
	$i++;
	}?>
	</center>
	
	

 </body>
 </html>
