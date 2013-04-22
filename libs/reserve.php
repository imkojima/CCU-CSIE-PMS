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
require_once('search.php');
require_once('property.php');

function getReserveList(){
    $usr = new pms_db();
    $sql = "SELECT * FROM `Reserve`";
    $result = $usr->my_query($sql,2);
    $i = 0;
    foreach ($result as $key) {
        $reserves[$i] = $key;
        $i++;
    }   

    return $reserves;
} 

function getReserveAuditList(){
    $usr = new pms_db();
    $sql = "SELECT * FROM `Reserve` WHERE `r_state`=0 OR `r_state`=1";
    $result = $usr->my_query($sql,2);
    $i = 0;
    foreach ($result as $key) {
        $reserves[$i] = $key;
        $i++;
    }   

    return $reserves;
} 

function getReserveReturnList(){
    $usr = new pms_db();
    $sql = "SELECT * FROM `Reserve` WHERE `r_state`=2";
    $result = $usr->my_query($sql,2);
    $i = 0;
    foreach ($result as $key) {
        $reserves[$i] = $key;
        $i++;
    }   

    return $reserves;
} 

//   Function:  Make a new Reservation
//   Input:     $keyword(Property Keyword) $type(type of Search) $u_id(User ID) 
//              $date(Reservation date)  $days(delay days) 
//              $reason(Borrow reason)  
//   Output:    no output
function makeReserve($keyword,$type,$u_id,$date,$days,$reason){

	switch($type){
		case 'id':
		$a = Search($keyword, 'Property', 'id');
		break;
		
		case 'acc':
		$a = Search($keyword, 'Property', 'acc');
		break;
	}
	
	$existCheck = "SELECT * FROM `Reserve` WHERE `u_id`='".$u_id."' AND `p_id`='".$a[0]['p_id']."' AND (`r_state` LIKE '0' OR `r_state` LIKE '1')";

	$test = new pms_db();
	$result = $test->my_query($existCheck, 2);
	if (count($result) > 1) {
		return "EXIST";
	}
	else {
//			$str="INSERT INTO Reserve ( u_id, p_id, r_date, r_state, r_days, r_reason) VALUES ('".$u_id."', '".$a[0]['p_id']."', '".$date."', '".$a[0]['p_state']."','".$days."' , '".$reason."');";
            $str="INSERT INTO Reserve ( u_id, p_id, r_date, r_state, r_days, r_reason) VALUES ('".$u_id."', '".$a[0]['p_id']."', '".$date."', '0','".$days."' , '".$reason."');";
			$test->my_query($str, 1);
			$result = $test->my_query("SELECT LAST_INSERT_ID();", 2);
			return $result[''][0];	// last insert id
	}
}

function getUserReserve($uacc){
    $usr = new pms_db();
    $sql = "SELECT * FROM `Reserve` WHERE `u_id`='".$uacc."'";
    $result = $usr->my_query($sql,2);
    $i = 0;
    foreach ($result as $key) {
        $reserves[$i] = $key;
        $i++;
    }   

    return $reserves;
} 

function getUserReserveBySearch($uacc, $class, $query){
    $usr = new pms_db();
    switch($class){
		case 'title':
			$sql = "SELECT * FROM `Reserve` JOIN `Property` WHERE (`u_id` = ".$uacc." AND `Reserve`.`p_id` = `Property`.`p_id`) AND ( `p_name` LIKE '%".$query."%' )";
			break;
 		case 'description':
			$sql = "SELECT * FROM `Reserve` JOIN `Property` WHERE (`u_id` = ".$uacc." AND `Reserve`.`p_id` = `Property`.`p_id`) AND ( `model` LIKE '%".$query."%' )";
			break; 
  		case 'accno':
			$sql = "SELECT * FROM `Reserve` JOIN `Property` WHERE (`u_id` = ".$uacc." AND `Reserve`.`p_id` = `Property`.`p_id`) AND ( `p_acc` LIKE '%".$query."%' )";
			break;   	
		case 'full':
		default:
			$sql = "SELECT * FROM `Reserve` JOIN `Property` WHERE (`u_id` = ".$uacc." AND `Reserve`.`p_id` = `Property`.`p_id`) AND ( `p_name` LIKE '%".$query."%' OR `model` LIKE '%".$query."%' )";
			break;
	}
	$result = $usr->my_query($sql,2);
    $i = 0;
    foreach ($result as $key) {
        $reserves[$i] = $key;
        $i++;
    }   

    return $reserves;
} 

function getUserReserveAccount($uacc, $type){
    $usr = new pms_db();
	switch($type){
		case 'borrowed':
			$sql = "SELECT * FROM `Reserve` WHERE `u_id`='".$uacc."' AND `r_state`= 2";
			break;
		case 'avaliable':
		default:
		    $sql = "SELECT * FROM `Reserve` WHERE `u_id`='".$uacc."' AND (`r_state`=0 OR `r_state`=1)";
			break;
	}
    $result = $usr->my_query($sql,2);
    $i = 0;
    foreach ($result as $key) {
        $reserves[$i] = $key;
        $i++;
    }   

    return $reserves;
} 

function getReserveByRID( $r_id ){
    $usr = new pms_db();
    $sql = "SELECT * FROM `Reserve` WHERE r_id = '".$r_id."'";
    $result = $usr->my_query($sql,2); 

    return $result;
}

function cancelReserve( $r_id ){
    $usr = new pms_db();
    $sql = "UPDATE `Reserve` SET `r_state`=5 WHERE `r_id`='".$r_id."'";
    $usr->my_query($sql,2); 
}

function rejectReserve( $r_id ){
    $usr = new pms_db();
    $sql = "UPDATE `Reserve` SET `r_state`=6 WHERE `r_id`='".$r_id."'";
    $usr->my_query($sql,2); 
}

function acceptReserve( $r_id ){
    $usr = new pms_db();
    $sql = "UPDATE `Reserve` SET `r_state`=1 WHERE `r_id`='".$r_id."'";
    $usr->my_query($sql,2); 
}

function lentReserve( $r_id ){
    $usr = new pms_db();

    $sql = "UPDATE `Reserve` SET r_state=2 WHERE `r_id`='".$r_id."'";
    $usr->my_query($sql,2); 

    $property = getReserveByRID( $r_id );
    $sql_property = "UPDATE `Property` SET `p_state`=1 WHERE `p_id` ='".$property['']['p_id']."'";
    $usr->my_query($sql_property,2); 
}

function returnReserve( $r_id ){
    $usr = new pms_db();

    $sql = "UPDATE `Reserve` SET `r_state`=3 WHERE `r_id`='".$r_id."'";
    $usr->my_query($sql,2); 

    $property = getReserveByRID( $r_id );
    $sql_property = "UPDATE `Property` SET `p_state`=0 WHERE `p_id`='".$property['']['p_id']."'";
    $usr->my_query($sql_property,2); 
}

function setReserveDays( $r_id , $r_days ){
    $usr = new pms_db();
    $sql = "UPDATE `Reserve` SET `r_days` = '".$r_days."' WHERE `r_id`='".$r_id."'";
    $usr->my_query($sql,2); 
}

?>
