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
主要用途：登入驗證

用途說明：
此檔案應該被每個需要登入後才能瀏覽的頁面引入，且保持在該檔案的頂端

使用範例：
require_once('auth.php');

最後編輯：
kojima 2012/12/03
================*/

	session_start();
	
	if($PATH=='')
		$PATH='./';

	if($_SESSION['ccupms_idy']!= true)
		header("Location:".$PATH."index.php");

	require_once($PATH.'libs/users.php');

	if(substr(basename($_SERVER['PHP_SELF']),0,5) == 'admin')
		if(getUserPerm($_SESSION['ccupms_acc'])!='admin')
			header("Location:".$PATH."index.php");
?>

