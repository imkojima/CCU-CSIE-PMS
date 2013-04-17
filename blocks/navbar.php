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
  if($PATH=="")
    $PATH = './';
	//require_once($PATH.'auth.php');
	session_start();
	require_once($PATH.'libs/users.php');

	if( ($username = getUserName($_SESSION['ccupms_acc'])) == "")
		$username = $_SESSION['ccupms_acc'];	
?>
  <div class="navbar navbar-inverse navbar-static-top" style="padding-bottom:10px;">
    <div class="navbar-inner">
      <div class="container">
        <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>  
        </a>
        <a style="color:#fff;" class="brand" href="<?php echo $PATH;?>">CSIE Property</a>
        <div class="nav-collapse" id="main-menu">
          <ul class="nav" id="main-menu-left">
            <li><a href="<?php echo $PATH;?>announcement.php"><i class="icon-bullhorn"></i> 公告</a></li>
<?php if($_SESSION['ccupms_idy'] == TRUE){ ?>
            <li><a href="<?php echo $PATH;?>list.php"><i class="icon-book"></i> 借用</a></li>
<?php } ?>
            <li><a href="<?php echo $PATH;?>support.php"><i class="icon-question-sign"></i> 說明</a></li>
          </ul>
          <ul class="nav pull-right" id="main-menu-right">
            <li><a href="http://www.cs.ccu.edu.tw"><i class="icon-home"></i> 中正資工</a></li>
<?php
		if($_SESSION['ccupms_idy'] == TRUE)
			if(getUserPerm($_SESSION['ccupms_acc'])=='admin'){
?>
            <li class="dropdown">
              <a class="dropdown-toggle" data-toggle="dropdown" href="#"><i class="icon-cog"></i> 管理<b class="caret"></b></a>
              <ul class="dropdown-menu" id="swatch-menu">
                <li><a href="<?php echo $PATH;?>admin/admin_announcement.php"><i class="icon-bullhorn"></i> 公告管理</a></li>
                <li><a href="<?php echo $PATH;?>admin/admin_list.php"><i class="icon-book"></i> 物品管理</a></li>
                <li><a href="<?php echo $PATH;?>admin/admin_audit.php"><i class="icon-legal"></i> 借用/歸還</a></li>
                <li><a href="<?php echo $PATH;?>admin/admin_account_list.php"><i class="icon-group"></i> 帳號管理</a></li>
                <li><a href="#"><i class="icon-barcode"></i> 條碼掃描</a></li>
                <li><a href="#"><i class="icon-cog"></i> 系統管理</a></li>
                <li class="divider"></li>
                <li><a href="<?php echo $PATH;?>"><i class="icon-arrow-right"></i> 回到使用者入口</a></li>
              </ul>
            </li>
<?php } ?>
<?php if( $_SESSION['ccupms_idy'] == TRUE){ ?>
            <li class="dropdown">
              <a tabindex="-1" class="dropdown-toggle" data-toggle="dropdown" href="#"><i class="icon-info-sign"></i> Howdy, <?php echo $username;?><b class="caret"></b></a>
              <ul class="dropdown-menu" id="swatch-menu">
                <li><a tabindex="-1" href="<?php echo $PATH;?>user_account.php"><i class="icon-user"></i> 個人資料</a></li>
                <li><a tabindex="-1" href="<?php echo $PATH;?>user_history.php"><i class="icon-list"></i> 個人紀錄</a></li>
                <li class="divider"></li>
                <li><a tabindex="-1" href="<?php echo $PATH;?>logout.php"><i class="icon-signout"></i> 登出</a></li>
              </ul>
            </li>
<?php } ?>
          </ul>
        </div>
      </div>
    </div>
  </div>
