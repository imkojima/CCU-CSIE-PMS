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
	$PATH = "../";
	require_once($PATH."auth.php");
	require_once($PATH."libs/announce.php");
?> 
<!DOCTYPE html>
<html lang="zh-tw">
  <head>
    <meta charset="utf-8">
    <title>新增公告 | CCU CSIE Property</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../css/bootstrap-responsive.css">
    <link rel="stylesheet" type="text/css" href="../css/font-awesome.css">
    <link rel="stylesheet" type="text/css" href="../css/tablecloth.css">
    <link rel="stylesheet" type="text/css" href="../css/nomoretable.css">

    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
  </head>
  <body>
 
<?php include_once($PATH.'blocks/navbar.php'); ?>

  <div class="container"> 
      <ul class="breadcrumb">
        <li><a href="../index.php">首頁</a> <span class="divider">/</span></li>
        <li><a href="admin_portal.php">管理</a> <span class="divider">/</span></li>
        <li><a href="admin_announcement.php">公告管理</a> <span class="divider">/</span></li>
        <li class="active">新增公告</li>
      </ul>

      <div class="well">
        <form class="form-horizontal" method="post" action="admin_announcement.php">
          <fieldset>
            <div class="control-group">
                <label class="control-label">標題</label>
                <div class="controls">
                  <input class="input-xxlarge" type="text" id="announce_title" name="title">
                </div>
            <div class="control-group">
                <label class="control-label">是否置頂</label>
                <div class="controls">
                  <label class="radio">
                    <input type="radio" name="pin" id="pin" value="1">
                    置頂
                  </label>
                  <label class="radio">
                    <input type="radio" name="pin" id="normal" value="0">
                    一般
                  </label>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label">內文</label>
                <div class="controls">
                  <textarea class="span7" rows="4" name="content"></textarea>
                </div>
            </div>
          </fieldset>
          <div style="text-align:center;">
            <div class="btn-group">
              <button class="btn btn-primary" type="submit" name="submit" value="Add">新增</button>
              <a class="btn" href="admin_announcement.php">取消</a>
            </div>
          </div>
        </form>
      </div>

      <div class="footer">
        <hr />
        <p>Property Management System - &#169;2012 Dept. of CSIE, National Chung Cheng University</p>
      </div> 
    </div>

    <script type="text/javascript" src="../js/jquery.js"></script>
    <script type="text/javascript" src="../js/bootstrap.min.js"></script>
    <script type="text/javascript" src="../js/jquery.tablesorter.js"></script>
    <script type="text/javascript" src="../js/jquery.metadata.js"></script>
    <script type="text/javascript" src="../js/jquery.tablecloth.js"></script>

 </body>
</html>
