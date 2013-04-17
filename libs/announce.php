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
	getAnnouncementList();
	getAnnouncementTitle( $announce_id );
    getAnnouncementDate( $announce_id );
	getAnnouncementPin( $announce_id );
	getAnnouncementContent( $announce_id );

===============================*/


/*
名稱: 回傳整份公告清單
用途: 公告列表
*/
function getAnnounceList(){
    $usr = new pms_db();
    $sql = "SELECT * FROM Announcement";
    $result = $usr->my_query($sql,2);
    $i = 0;
    foreach ($result as $key) {
        $announce[$i] = $key;
        $i++;
    }   

    return $announce;
}

/*
名稱: 取得特定公告之標題
用途: 取得公告標題
*/ 
function getAnnouncementTitle($announce_id){
 	$usr = new pms_db();
	$sql = "SELECT title FROM `Announcement` WHERE `ID` = '".$announce_id."'";
	$result = $usr->my_query($sql,2);
	
	return $result['']['title']; 
}

/*
名稱: 取得特定公告的日期
用途: 取得公告日期
*/ 
function getAnnouncementDate($announce_id){
 	$usr = new pms_db();
	$sql = "SELECT date FROM `Announcement` WHERE `ID` = '".$announce_id."'";
	$result = $usr->my_query($sql,2);
	
	return $result['']['date']; 
}
 
/*
名稱: 取得特定公告的內容
用途: 取得公告內容
*/ 
function getAnnouncementContent($announce_id){
 	$usr = new pms_db();
	$sql = "SELECT content FROM `Announcement` WHERE `ID` = '".$announce_id."'";
	$result = $usr->my_query($sql,2);
	
	return $result['']['content']; 
}

/*
名稱: 取得特定公告是否置頂
用途: 取得公告是否置頂
*/ 
function getAnnouncementPin($announce_id){
 	$usr = new pms_db();
	$sql = "SELECT pin FROM `Announcement` WHERE `ID` = '".$announce_id."'";
	$result = $usr->my_query($sql,2);
	
	return $result['']['pin']; 
}

/*
	Used to: 增加帳號

	Pre Condition: 傳入 資料庫編號, 財產編號, 財產名稱, 財產狀態, 描述
	Post Condition: 增加資料到資料庫
*/
function addAnnouncement( $title, $pin, $date, $content ) {
	$usr = new pms_db();
	$sql = "INSERT INTO `Announcement` (`title`, `pin`, `date`, `content`) VALUES ('".$title."', '".$pin."', '".$date."', '".$content."')";
	$usr->my_query($sql,2);
}

/*
	Used to: 移除使用者

	Pre Condition: 傳入 使用者帳號
	Post Condition: 刪除該筆資料庫資料
*/
function deleteAnnouncement( $announce_id ) {
	$property = new pms_db();
	$sql = "DELETE FROM `Announcement` WHERE `ID` = '".$announce_id."'";
	$property->my_query($sql,2);
}

function editAnnouncement($ID,$title,$pin,$date, $content){
	$NDB = new pms_db();

	$str = "UPDATE Announcement SET title = '".$title."', pin = '".$pin."' , date = '".$date."', `content` = '".$content."'  WHERE ID LIKE '%".$ID."%'";
	$NDB->my_query($str,1);
	$NDB->close();
}
?>
