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
	使用者資料相關功能

函式一覽:
	getUserList();
	getUserName( $account );
    getUserGrade( $account );
	getUserPhone( $account );
	getUserMail( $account );
	getUserPerm( $account );

===============================*/


/*
名稱: 回傳整份使用者清單
用途: 使用者列表(admin_account_list)
*/
function getUserList(){
    $usr = new pms_db();
    $sql = "SELECT * FROM User";
    $result = $usr->my_query($sql,2);
    $i = 0;
    foreach ($result as $key) {
        $users[$i] = $key;
        $i++;
    }   

    return $users;
}

/*
名稱: 回傳搜尋結果的使用者清單
用途: 使用者列表(admin_account_list)
*/
function getUserBySearch($class, $query){
    $usr = new pms_db();               
	switch($class){
		case 'acc':
			$sql = "SELECT * FROM User WHERE `u_acc` LIKE '%".$query."%'";
			break;
		case 'name':
			$sql = "SELECT * FROM User WHERE `u_acc` LIKE '%".$query."%'";
			break;
		case 'phone':
			$sql = "SELECT * FROM User WHERE `phone` LIKE '%".$query."%'";
			break;
		case 'mail':
			$sql = "SELECT * FROM User WHERE `mail` LIKE '%".$query."%'";
			break;
		case 'full':
		default:
		    $sql = "SELECT * FROM User WHERE `u_acc` LIKE '%".$query."%' OR `name` LIKE '%".$query."%' OR `phone` LIKE '%".$query."%' OR `mail` LIKE '%".$query."%'";
			break;
	}
    $result = $usr->my_query($sql,2);
    $i = 0;
    foreach ($result as $key) {
        $users[$i] = $key;
        $i++;
    }   

    return $users;
}

/*
名稱: 取得特定帳號之使用者名稱
用途: 取得使用者名稱
*/ 
function getUserName($account){
 	$usr = new pms_db();
	$sql = "SELECT name FROM `User` WHERE `u_acc` = '".$account."'";
	$result = $usr->my_query($sql,2);
	
	return $result['']['name']; 
}
 
/*
名稱: 取得特定帳號之使用者評等
用途: 取得使用者評等
*/ 
function getUserGrade($account){
 	$usr = new pms_db();
	$sql = "SELECT grade FROM `User` WHERE `u_acc` = '".$account."'";
	$result = $usr->my_query($sql,2);
	
	return $result['']['grade']; 
}

/*
名稱: 取得特定帳號之使用者聯絡電話
用途: 取得使用者聯絡電話
*/ 
function getUserPhone($account){
 	$usr = new pms_db();
	$sql = "SELECT phone FROM `User` WHERE `u_acc` = '".$account."'";
	$result = $usr->my_query($sql,2);
	
	return $result['']['phone']; 
}
 
/*
名稱: 取得特定帳號之使用者信箱
用途: 取得使用者信箱
*/ 
function getUserMail($account){
 	$usr = new pms_db();
	$sql = "SELECT mail FROM `User` WHERE `u_acc` = '".$account."'";
	$result = $usr->my_query($sql,2);
	
	return $result['']['mail']; 
}

function getUserAccount($u_id){
 	$usr = new pms_db();
	$sql = "SELECT u_acc FROM `User` WHERE `u_id` = '".$u_id."'";
	$result = $usr->my_query($sql,2);
	
	return $result['']['u_acc']; 
}

/*
名稱: 取得特定帳號之使用者權限
用途: 取得使用者權限
*/ 
function getUserPerm($account){
 	$usr = new pms_db();
	$sql = "SELECT permission FROM `User` WHERE `u_acc` = '".$account."'";
	$result = $usr->my_query($sql,2);
	if(count($result)==1)
		return 'empty';
	switch($result['']['permission']){
		case 0:
			return 'student';
			break;
		case 1:
			return 'admin';
			break;
		case 2:
			return 'faculty';
			break;
		default:
			return 'default';
			break;
	}
}

/*
名稱: 取得特定帳號之使用者權限
用途: 取得使用者權限
*/ 
function getUserPermID($account){
 	$usr = new pms_db();
	$sql = "SELECT permission FROM `User` WHERE `u_acc` = '".$account."'";
	$result = $usr->my_query($sql,2);

	return $result['']['permission'];
}

/*
	Used to: 增加帳號

	Pre Condition: 傳入 資料庫編號, 財產編號, 財產名稱, 財產狀態, 描述
	Post Condition: 增加資料到資料庫
*/
function addUser( $u_id, $u_acc, $name, $grade, $phone, $mail, $permission ) {
	$usr = new pms_db();
	$sql = "INSERT INTO `User` (`u_acc`, `name`, `grade`, `phone`, `mail`, `permission` ) VALUES ('".$u_acc."', '".$name."', '".$grade."',  '".$phone."', '".$mail."', '".$permission."')";
	$usr->my_query($sql,2);
}

/*
	Used to: 移除使用者

	Pre Condition: 傳入 使用者帳號
	Post Condition: 刪除該筆資料庫資料
*/
function deleteUser( $account_id ) {
	$property = new pms_db();
	$sql = "DELETE FROM `User` WHERE `u_acc` = '".$account_id."'";
	$property->my_query($sql,2);
}

/*
	Used to: 取得使用者資料庫最大編號

	Pre Condition: -
	Post Condition: 回傳使用者資料庫最大編號
*/
function getUserMaxID() {
	$usr = new pms_db();
	$sql = "SELECT MAX(u_id) FROM `User`";
	$result = $usr->my_query($sql,2);

	return $result['']['MAX(u_id)']+1;
}

function editUser($IDNumber,$Nname,$Ngrade,$Nphone,$Nmail, $Npermission){
	$NDB = new pms_db();

	$str = "UPDATE User SET name = '".$Nname."',grade = '".$Ngrade."', phone = '".$Nphone."' , mail = '".$Nmail."', `permission` = '".$Npermission."'  WHERE u_acc LIKE '%".$IDNumber."%'";
	$NDB->my_query($str,1);
	$NDB->close();
}
?>
