#!/usr/bin/php -q
<?php
require_once('libs/reserve.php');
require_once('libs/logs.php');

if(isset($_SERVER['REQUEST_URI'])){
	makeLog("System", "試圖存取排程程式");
	exit();
}

/* Crontabl Daily Script */
$reserves = getReserveList();

$numDecrease = 0;	//遞減預約項目數
$numCancel = 0;		//取消預約項目數
for($i=0;$i<count($reserves)-1;$i++){
	//正在等待審核的預約
	if($reserves[$i]['r_state']==0){
		echo "-> 預約編號：".$reserves[$i]['r_id']." - 剩餘預約天數：".$reserves[$i]['r_days']." ... ";
		if($reserves[$i]['r_days'] != 0){
			//遞減它的預約天數
			setReserveDays( $reserves[$i]['r_id'] , $reserves[$i]['r_days']-1);
			echo "遞減<br/>";
			$numDecrease++;
		}else{
			//因超過預約期限，自動取消預約
			cancelReserve( $reserves[$i]['r_id'] );
			makeLog($reserves[$i]['u_id'], "取消預約 (自動) - [R:".$reserves[$i]['r_id']."]");	
			echo "取消<br/>";
			$numCancel++;
		}
	}
}
makeLog("Crontab", "完成排程操作 - 遞減:".$numDecrease.", 取消:".$numCancel);
?>
