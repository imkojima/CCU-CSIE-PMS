<?php
/*
    This file is part of CCU CSIE Property Management System.

    CCU CSIE Property Management System is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    CCU CSIE Property Management System is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with CCU CSIE Property Management System.  If not, see <http://www.gnu.org/licenses/>.
*/

require_once('db_object.php');

/*===============================
	系統相關功能

函式一覽:
	makeLog($uacc, $reason)
	getLogs()
	getUserLogs($uacc)

===============================*/

/*
名稱: 產生操作紀錄
用途: as title
*/ 
function makeLog($uacc, $reason){

	$time = date("Y-m-d H:i:s");    
    $usr = new pms_db();

	if(isset($_SERVER["REMOTE_ADDR"]))
		$ip = $_SERVER["REMOTE_ADDR"];
	else
		$ip = "無法取得";

	$sql = "INSERT INTO `Log`(`logid`, `u_acc`, `reason`, `address`, `time`) VALUES (NULL, '".$uacc."', '".$reason."', '".$ip."', '".$time."')";
    $result = $usr->my_query($sql,2);
	//echo "UserAcc:".$uacc." / ".$reason." / ".$time."<br/>";
}

/*
名稱: 回傳整份使用紀錄
用途: 紀錄列表
*/
function getLogsBySearch($class,$query){
    $usr = new pms_db();
	switch($class){
		case 'acc':
			$sql = "SELECT * FROM `Log` WHERE `u_acc` LIKE '%".$query."%' ORDER BY logid DESC";
			break;
 		case 'reason':
			$sql = "SELECT * FROM `Log` WHERE `reason` LIKE '%".$query."%' ORDER BY logid DESC";
			break; 
 		case 'address':
			$sql = "SELECT * FROM `Log` WHERE `address` LIKE '%".$query."%' ORDER BY logid DESC";
			break; 
		case 'time':
			$sql = "SELECT * FROM `Log` WHERE `time` LIKE '%".$query."%' ORDER BY logid DESC";
			break;
		case 'full':	
		default:
			$sql = "SELECT * FROM `Log` WHERE (`u_acc` LIKE '%".$query."%') OR (`reason` LIKE '%".$query."%') OR (`address` LIKE '%".$query."%') OR (`time` LIKE '%".$query."%') ORDER BY logid DESC";
			break;
	}
    $result = $usr->my_query($sql,2);
    $i = 0;
    foreach ($result as $key) {
        $logs[$i] = $key;
        $i++;
    }   

    return $logs;
} 

/*
名稱: 回傳整份使用紀錄
用途: 紀錄列表
*/
function getLogs($max = 10){
    $usr = new pms_db();
    if($max<0)
		$sql = "SELECT * FROM `Log` ORDER BY logid DESC";
	else
		$sql = "SELECT * FROM `Log` ORDER BY logid DESC LIMIT 0,".$max;
    $result = $usr->my_query($sql,2);
    $i = 0;
    foreach ($result as $key) {
        $logs[$i] = $key;
        $i++;
    }   

    return $logs;
} 

/*
名稱: 回傳特定使用者帳號的使用紀錄
用途: 紀錄列表
*/
function getUserLogs($uacc, $max = 10){
    $usr = new pms_db();
    $sql = "SELECT * FROM `Log` WHERE u_acc = '".$uacc."' ORDER BY logid DESC LIMIT 0,".$max;
    $result = $usr->my_query($sql,2);
    $i = 0;
    foreach ($result as $key) {
        $logs[$i] = $key;
        $i++;
    }   

    return $logs;
} 

?>
