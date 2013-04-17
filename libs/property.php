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

/*============================
	財產相關資料

函式一覽：
	[取得]
	getPropertyList();
	getPropertyID( $database_id );
	getPropertyName( $database_id );
	getPropertyModel( $database_id );
	getPropertyState( $database_id );

	[更改]
	updateProperty( $p_id, $p_acc, $p_name, $p_state, $model );

	[刪除]
	deleteProperty( $database_id );

============================*/

/*
	Used to: 列出所有財產資料

	Pre Condition: -
	Post Condition: 回傳所有財產資料
*/
function getPropertyList() {
	$property = new pms_db();
	$sql = "SELECT * FROM Property";
	$result = $property->my_query($sql,2);
	$i = 0;
	foreach ($result as $key) {
		$properties[$i] = $key;
		$i++;
	}

	return $properties;
}

/*
	Used to: 列出特定財產資料

	Pre Condition: -
	Post Condition: 回傳所有財產資料
*/
function getPropertyBySearch($class, $query) {
	$property = new pms_db();

	switch($class){
		case 'title':
			$sql = "SELECT * FROM  `Property` WHERE  (`p_name` LIKE  '%".$query."%')";
			break;
		case 'description':
			$sql = "SELECT * FROM  `Property` WHERE  (`model` LIKE  '%".$query."%')";
			break;
		case 'accno':
            $sql = "SELECT * FROM  `Property` WHERE  (`p_acc` LIKE  '%".$query."%')";
			break;
/*
		case 'place':
			$sql = "SELECT * FROM  `Property` WHERE  (`p_name` LIKE  '%".$query."%')";
			break;
		case 'keeper':
			$sql = "SELECT * FROM  `Property` WHERE  (`p_name` LIKE  '%".$query."%')";
			break;
*/
	    case 'full':
		default:
			$sql = "SELECT * FROM  `Property` WHERE  (`p_name` LIKE  '%".$query."%') OR (`p_acc` LIKE '".$query."') OR (`model` LIKE '%".$query."%')";
			break;
	}

	$result = $property->my_query($sql,2);
	$i = 0;
	foreach ($result as $key) {
		$properties[$i] = $key;
		$i++;
	}

	return $properties;
} 


/*
	Used to: 取得財產編號

	Pre Condition: 傳入財產的資料庫編號
	Post Condition: 回傳財產編號
*/
function getPropertyID( $database_id ) {
	$property = new pms_db();
	$sql = "SELECT `p_acc` FROM `Property` WHERE `p_id` = '".$database_id."'";
	$result = $property->my_query($sql,2);

	if($result['']['p_acc'] == '')
		return 'none';
	else
		return $result['']['p_acc'];
}

/*
	Used to: 取得財產資料庫編號

	Pre Condition: 傳入財產編號
	Post Condition: 回傳財產資料庫編號
*/

function getPropertyIDByAcc( $accno ) {
	$property = new pms_db();
	$sql = "SELECT  `p_id` FROM  `Property` WHERE  `p_acc` = '".$accno."'";
	$result = $property->my_query($sql,2);

	return $result['']['p_id'];
}

/*
	Used to: 取得財產名稱

	Pre Condition: 傳入財產的資料庫編號
	Post Condition: 回傳財產名稱
*/
function getPropertyName( $database_id ) {
	$property = new pms_db();
	$sql = "SELECT `p_name` FROM `Property` WHERE `p_id` = '".$database_id."'";
	$result = $property->my_query($sql,2);

	return $result['']['p_name'];
}

/*
	Used to: 取得描述

	Pre Condition: 傳入財產的資料庫編號
	Post Condition: 回傳財產的描述
*/
function getPropertyModel( $database_id ) {
	$property = new pms_db();
	$sql = "SELECT `model` FROM `Property` WHERE `p_id` = '".$database_id."'";
	$result = $property->my_query($sql,2);

	return $result['']['model'];
}

/*
	Used to: 取得財產狀態

	Pre Condition: 傳入財產的資料庫編號
	Post Condition: 回傳財產狀態
*/
function getPropertyState( $database_id ) {
	$property = new pms_db();
	$sql = "SELECT `p_state` FROM `Property` WHERE `p_id` = '".$database_id."'";
	$result = $property->my_query($sql,2);

	return $result['']['p_state'];
}

/*
	Used to: 取得資料庫最大ID給新的物品使用

	Pre Condition: -
	Post Condition: 回傳最大ID+1
*/
function getPropertyMaxID() {
	$property = new pms_db();
	$sql = "SELECT MAX(p_id) FROM `Property`";
	$result = $property->my_query($sql,2);

	return $result['']['MAX(p_id)']+1;
}

/*
	Used to: 增加物品

	Pre Condition: 傳入 資料庫編號, 財產編號, 財產名稱, 財產狀態, 描述
	Post Condition: 增加資料到資料庫
*/
function addProperty( $p_id, $p_acc, $p_name, $p_state, $model ) {
	$property = new pms_db();
	$sql = "INSERT INTO `Property` (`p_id`, `p_acc`, `p_name`, `model`, `p_state`) VALUES ('".$p_id."', '".$p_acc."', '".$p_name."', '".$model."', '".$p_state."')";
	$property->my_query($sql,2);
}

/*
	Used to: 更新物品資訊

	Pre Condition: 傳入 資料庫編號, 財產編號, 財產名稱, 財產狀態, 描述
	Post Condition: 更新資料到資料庫
*/
function updateProperty( $p_id, $p_acc, $p_name, $p_state, $model ) {
	$property = new pms_db();
	$sql = " UPDATE `Property` SET `p_acc`='".$p_acc."', `p_name`='".$p_name."', `p_state`='".$p_state."', `model`='".$model."' WHERE `p_id`='".$p_id."' ";
	$property->my_query($sql,2);
}

/*
	Used to: 刪除物品

	Pre Condition: 傳入 資料庫編號
	Post Condition: 刪除資料
*/
function deleteProperty( $database_id ) {
	$property = new pms_db();
	$sql = "DELETE FROM `Property` WHERE `p_id` = '".$database_id."'";
	$property->my_query($sql,2);
}

?>
