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
 	makeLog($_SESSION['ccupms_acc'], '手動登出');
    unset($_SESSION['ccupms_idy']);
	unset($_SESSION['ccupms_acc']);
	unset($_SESSION['admin_idy']);
?>
<!DOCTYPE html>
<html lang="zh-tw">
  <head>
    <meta charset="utf-8">
    <title>登出 | CCU CSIE Property</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

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

  <div class="container">
    <div class="row">
      <div class="span6 offset3">
         <div class="well">
            <fieldset>
              <legend>再會 Goodbye!</legend>
              <p>感謝您的使用，若要繼續使用請 <a href="index.php">再次登入</a>。</p>
			  <p>回到系務系統登入口，請按<a href="http://140.123.104.217">這裡</a>。</p>
              <div class="pull-right"><i class="icon-eject" style="width:160px; height:160px; font-size: 160px;"></i></div>
            </fieldset>
          </div>
      </div>
    </div>
      <div class="footer">
        <hr />
        <p>Property Management System - &#169;2012 Dept. of CSIE, National Chung Cheng University</p>
      </div>   
  </div>

  <script type="text/javascript" src="js/jquery.js"></script>
  <script type="text/javascript" src="js/bootstrap.js"></script>
 </body>
</html>
