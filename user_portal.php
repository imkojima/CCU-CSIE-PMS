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
	require_once('auth.php');
	require_once('libs/logs.php');
?>
<!DOCTYPE html>
<html lang="zh-tw">
  <head>
    <meta charset="utf-8">
    <title>使用者入口 | CCU CSIE Property</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
	<meta property="og:image" content="img/logo.png" />

    <!-- Le styles -->
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/bootstrap-responsive.css">
    <link rel="stylesheet" type="text/css" href="css/font-awesome.css">
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
  </head>

  <body>
    
<?php include_once('blocks/navbar.php'); ?>

  <div class="container" >
    <?php include_once('blocks/inforbar.php'); ?>
    <section id="welcome">
      <div class="row">
        <div class="span6">
           <div class="well">
              <legend>使用者選單 Menu</legend>
              <div class="row-fluid" style="text-align:center;padding-top:30px">

                <div class="span4">
				  <a href="announcement.php" style="text-decoration: none;">
                  <div style="font-size: 70px;">
                    <i class="icon-bullhorn" style="height:auto; width:auto; line-height:auto;"></i>
                  </div>
                  <p style="line-height:30px;">公告</p>
				  </a>
                </div>

                <div class="span4">
                  <a href="list.php" style="text-decoration: none;">
				  <div style="font-size: 70px;">
					<i class="icon-book" style="height:auto; width:auto; line-height:auto;"></i>
                  </div>
                  <p style="line-height:30px;">借用</p>
				  </a>
                </div>
                <div class="span4">
                  <a href="support.php" style="text-decoration: none;">
                  <div style="font-size: 70px;">
                    <i class="icon-question-sign" style="height:auto; width:auto; line-height:auto;"></i>
                  </div>
                  <p style="line-height:30px;">說明</p>
				  </a>
                </div>
              </div>
              <hr/>
              <div class="row-fluid" style="text-align:center;padding-top:30px">
                <div class="span4">
				  <a href="user_account.php" style="text-decoration: none;">
                  <div style="font-size: 70px;">
					<i class="icon-user" style="height:auto; width:auto; line-height:auto;"></i>
                  </div>
                  <p style="line-height:30px;">帳號</p>
				  </a>
                </div>
                <div class="span4">
                  <a href="user_history.php" style="text-decoration: none;">
			      <div style="font-size: 70px;">
                    <i class="icon-list" style="height:auto; width:auto; line-height:auto;"></i>
                  </div>
                  <p style="line-height:30px;">紀錄</p>
				  </a>
                </div>
<?php if(getUserPerm($_SESSION['ccupms_acc'])=='admin') { ?>
                <div class="span4">
				  <a href="admin/admin_portal.php" style="text-decoration: none;">
                  <div style="font-size: 70px;">
					<i class="icon-cog" style="height:auto; width:auto; line-height:auto;"></i>
                  </div>
                  <p style="line-height:30px;">管理</p>
				  </a>
                </div>
<?php } ?>
              </div>
           </div>
        </div>

        <div class="span6">
          <table class="table table-striped">
            <caption>最近使用記錄</caption>
            <thead>
              <th>事由</th>
              <th style="width:150px;">日期</th>
            </thead>
            <tbody>
<?php 
	$logs = getUserLogs($_SESSION['ccupms_acc'], 9);

        for ($i=0; $i < count( $logs )-1; $i++) { 
?>
              <tr>
                <td><?php echo $logs[$i]['reason'];?></td>
                <td><?php echo $logs[$i]['time'];?></td>
              </tr>
<?php	} ?>
            </tbody>
          </table>
        </div>
      </div>
      <div class="footer">
        <hr />
        <p>Property Management System - &#169;2012 Dept. of CSIE, National Chung Cheng University</p>
      </div> 
    </section>    
  </div>
  
  <!-- First Login Message Close -->
  <script>
    function loginMsg(id){
      var target=document.getElementById(id);
      $(target).hide("slow");
    }
  </script>
  <!-- END First Login Message Close -->
  
  <script type="text/javascript" src="js/jquery.js"></script>
  <script type="text/javascript" src="js/bootstrap.min.js"></script>
 </body>
</html>
