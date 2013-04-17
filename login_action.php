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

/*================
主要用途：介接學校帳號驗證

用途說明：
TBD

使用範例：
TBD
最後編輯：
全家 2013/02/07
================*/
	session_start();
	require_once('libs/logs.php');

	if($_SESSION['ccupms_idy']== true)
		header("Location:./user_portal.php");
	
	if(isset($_POST['account']) and isset($_POST['passwd']))
	{
		/*user login from subsystem*/
		$acc=$_POST['account'];
		$passwd=$_POST['passwd'];
	
		$_SESSION['ccupms_idy'] = false;
		
		$result = file_get_contents("http://140.123.4.217/ccuVerifyAccount.php?para1=$acc&para2=$passwd");
		$findme = "Success!";
		
		$pos=strpos($result,$findme);
		if($pos!==false)
		{                             
			makeLog($acc, '登入成功');
			$_SESSION['ccupms_idy']=true;  // login identity
			$_SESSION['ccupms_acc']=$acc;  // user account
			header("Location:./user_portal.php");
		}
		else
		{
			makeLog($acc, '登入失敗');
			echo "<meta content=\"text/html; charset=UTF-8\" http-equiv=\"Content-Type\"/>";
			echo "<script>alert(\"帳號或密碼錯誤 , 請在返回登入頁後重試\");</script>";
			echo '<meta http-equiv=REFRESH CONTENT=0;url=./index.php>';
		}	
	}
	
	else if(isset($_GET['token']) and $_GET['token']!="" and isset($_GET['account']) and $_GET['account']!="")
	{
		/*user login from sso*/
		$ccu_acc = $_GET['account'];
		$filePath = $_GET['token'];
		$verify_result = file_get_contents("http://140.123.104.217/keymatch.php?token=$filePath");		
		if(strcmp($verify_result,'success') == 0)
		{
			/*登入成功  各子系統做相對應的處理(設定session之類的)*/
			makeLog($ccu_acc, '登入成功');
			$_SESSION['ccupms_idy']=true;  // login identity
			$_SESSION['ccupms_acc']=$ccu_acc;  // user account
			header("Location:./user_portal.php");
		}
		else
		{
			/*登入失敗的對應處理*/
			makeLog($ccu_acc, '登入失敗');
			echo "<meta content=\"text/html; charset=UTF-8\" http-equiv=\"Content-Type\"/>";
			echo "<script>alert(\"帳號或密碼錯誤 , 請在返回登入頁後重試\");</script>";
			echo '<meta http-equiv=REFRESH CONTENT=0;url=./index.php>';
		}
	}
	else
	{
		echo '請從子系統或者統一入口登入';
	}
	
?>