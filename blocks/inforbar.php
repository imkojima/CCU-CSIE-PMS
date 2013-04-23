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
?>
<?php if(getUserPerm($_SESSION['ccupms_acc'])=='empty' && $_SESSION['ccupms_acc'] != ''){ 
	addUser('',$_SESSION['ccupms_acc'],'',0,'','',0);
	makeLog($_SESSION['ccupms_acc'],'初次建立 - [U:'.$_SESSION['ccupms_acc'].']');
?>
    <div class="alert" id="firstLogin">
      <a class="close" onclick="loginMsg('firstLogin')">×</a>
      <i class="icon-info-sign"></i> 第一次登錄的同學請先完成基本資料登錄方可使用系統功能，詳見<a href="<?php echo $PATH;?>support.php">"說明</a>。
    </div>
<?php } ?>  
    <div class="alert alert-info" id="announcement">
      <a class="close" onclick="loginMsg('announcement')">×</a>
      <i class="icon-bullhorn"></i> <a href="<?php echo $PATH;?>announcement.php">公告有關物品借用相關規定事項，詳情請參閱公告頁面</a>
    </div> 
