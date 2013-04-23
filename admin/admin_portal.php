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
	$PATH = '../';
	require_once($PATH.'auth.php');
	require_once($PATH.'libs/logs.php');
?>
<!DOCTYPE html>
<html lang="zh-tw">
  <head>
    <meta charset="utf-8">
    <title>管理者入口 | CCU CSIE Property</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../css/bootstrap-responsive.css">
    <link rel="stylesheet" type="text/css" href="../css/font-awesome.css">
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
  </head>

  <body>
    
<?php include_once('../blocks/navbar.php'); ?>

  <div class="container" >

  <?php include_once('../blocks/inforbar.php'); ?>
    
    <section id="welcome">
      <div class="row">
        <div class="span6">
           <div class="well">
              <legend>管理者選單 Admin Menu</legend>
              <div class="row-fluid" style="text-align:center;padding-top:30px">

				<div class="span4">
				  <a href="admin_announcement.php" style="text-decoration: none;">
                  <div style="font-size: 70px;">
                    <i class="icon-bullhorn" style="height:auto; width:auto; line-height:auto;"></i>
                  </div>
				  <p style="line-height:30px;">公告管理</p>
				  </a>
                </div>

				<div class="span4">
				  <a href="admin_list.php" style="text-decoration: none;">
                  <div style="font-size: 70px;">
                    <i class="icon-briefcase" style="height:auto; width:auto; line-height:auto;"></i>
                  </div>
				  <p style="line-height:30px;">物品管理</p>
				  </a>
                </div>
				<div class="span4">
				  <a href="admin_audit.php" style="text-decoration: none;">
                  <div style="font-size: 70px;">
                    <i class="icon-legal" style="height:auto; width:auto; line-height:auto;"></i>
                  </div>
				  <p style="line-height:30px;">借用/歸還</p>
				  </a>
                </div>
              </div>
              <hr/>
              <div class="row-fluid" style="text-align:center;padding-top:30px">
				<div class="span4">
				  <a href="admin_account_list.php" style="text-decoration: none;">
                  <div style="font-size: 70px;">
                    <i class="icon-group" style="height:auto; width:auto; line-height:auto;"></i>
                  </div>
				  <p style="line-height:30px;">帳號管理</p>
				  </a>
                </div>
				<div class="span4">
				  <a href="#" onClick="javascript:PopupCenter('scan.html', 'barcode', 400, 320);">
                  <div style="font-size: 70px;">
                    <i class="icon-barcode" style="height:auto; width:auto; line-height:auto;"></i>
                  </div>
				  <p style="line-height:30px;">條碼掃描</p>
				  </a>
                </div>
				<div class="span4">
				  <a href="admin_history.php" style="text-decoration: none;">
                  <div style="font-size: 70px;">
                    <i class="icon-list" style="height:auto; width:auto; line-height:auto;"></i>
                  </div>
				  <p style="line-height:30px;">系統紀錄</p>
				  </a>
                </div>
              </div>
           </div>
        </div>

        <div class="span6">
          <table class="table table-striped">
            <caption>最近使用記錄</caption>
            <thead>
              <th>使用者</th>
              <th>事由</th>
              <th style="width:150px;">日期</th>
            </thead>
            <tbody>
<?php
		$logs = getLogs(9);
		for($i=0;$i< count($logs)-1;$i++){
?>
              <tr>
                <td><?php echo $logs[$i]['u_acc'];?></td>
				<td><?php echo $logs[$i]['reason'];?></td>
				<td><?php echo $logs[$i]['time'];?></td>
              </tr>
<?php   } ?>
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

  <!-- Modal -->
  <div class="modal hide" id="readmeMsg" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
      <h3 id="myModalLabel">說明</h3>
    </div>
    <div class="modal-body">
      <p>我是一隻小小郭</p>
    </div>
    <div class="modal-footer">
      <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
    </div>
  </div>
  <!-- ModalEnd -->
  
  <!-- First Login Message Close -->
  <script>
    function loginMsg(id){
      var target=document.getElementById(id);
      $(target).hide("slow");
    }

    function PopupCenter(pageURL, title,w,h) {
      var left = (screen.width/2)-(w/2);
      var top = (screen.height/2)-(h/2);
      var targetWin = window.open (pageURL, title, 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, copyhistory=no, width='+w+', height='+h+', top='+top+', left='+left);
    } 

  </script>
  <!-- END First Login Message Close -->
  
  <script type="text/javascript" src="../js/jquery.js"></script>
  <script type="text/javascript" src="../js/jquery.popupWindow.js"></script>
  <script type="text/javascript" src="../js/bootstrap.min.js"></script>
 </body>
</html>
