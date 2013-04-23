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

$PATH="../";
require_once($PATH.'libs/db_object.php');
require_once($PATH.'libs/property.php');
require_once($PATH.'libs/logs.php');

if ($_POST['submit']=='新增') {
	echo "新增";
	echo "<br />";
	echo "資料庫編號：".$_POST['p_id'];
	echo "<br />";
	echo "名稱：".$_POST['p_name'];
	echo "<br />";
	echo "產編：".$_POST['p_acc'];
	echo "<br />";
	echo "狀態：".$_POST['optionsRadios'];
	echo "<br />";
	echo "描述：".$_POST['note'];
	addProperty( $_POST['p_id'], $_POST['p_acc'], $_POST['p_name'], $_POST['optionsRadios'], $_POST['note'] );
	makeLog("System", '建立物品資料 - [P:'.$_POST['p_id'].']');
}
if ($_POST['submit']=='更新') {
	echo "更新 --->";
	echo "<br />";
	echo "資料庫編號：".$_POST['p_id'];
	echo "<br />";
	echo "名稱：".$_POST['p_name'];
	echo "<br />";
	echo "產編：".$_POST['p_acc'];
	echo "<br />";
	echo "狀態：".$_POST['optionsRadios'];
	echo "<br />";
	echo "描述：".$_POST['note'];

	updateProperty( $_POST['p_id'], $_POST['p_acc'], $_POST['p_name'], $_POST['optionsRadios'], $_POST['note'] );
	makeLog("System", '更新物品資料 - [P:'.$_POST['p_id'].']');
}
if ($_POST['submit']=='刪除') {
	echo "刪除";
	echo "<br />";
	echo "資料庫編號：".$_POST['p_id'];
	echo "<br />";
	echo "名稱：".$_POST['p_name'];
	echo "<br />";
	echo "產編：".$_POST['p_acc'];
	echo "<br />";
	echo "狀態：".$_POST['optionsRadios'];
	echo "<br />";
	echo "描述：".$_POST['note'];
	deleteProperty( $_POST['p_id'] );
	makeLog("System", '刪除物品資料 - [P:'.$_POST['p_id'].']');
}

header("Location:./admin_list.php");
?>
