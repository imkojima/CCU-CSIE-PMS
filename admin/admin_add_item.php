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
  $PATH="../";
  require_once($PATH."auth.php");
  require_once($PATH."libs/property.php");
?>

<!DOCTYPE html>
<html lang="zh-tw">
  <head>
    <meta charset="utf-8">
    <title>新增物品 | CCU CSIE Property</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <script src="http://code.jquery.com/jquery-1.8.3.js"></script>
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../css/bootstrap-responsive.css">
    <link rel="stylesheet" type="text/css" href="../css/font-awesome.css">
    <link rel="stylesheet" type="text/css" href="../css/tablecloth.css">
    <link rel="stylesheet" type="text/css" href="../css/nomoretable.css">

    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>    
  </head>
  <body>

  <? include_once($PATH."blocks/navbar.php"); ?>

    <div class="container" >

      <ul class="breadcrumb">
        <li><a href="index.php">首頁</a> <span class="divider">/</span></li>
        <li><a href="admin_portal.php">管理</a> <span class="divider">/</span></li>
        <li><a href="admin_list.php">物品管理</a> <span class="divider">/</span></li>
        <li class="active">新增物品</li>
      </ul>

      <div class="well">
        <form class="form-horizontal" method="post" action="modal_edit_property.php">
          <fieldset>
            <!-- 再討論 -->
            <div class="control-group">
                <label class="control-label">資料庫ID</label>
                <div class="controls">
                  <input class="span3" type="text" id="database_id" name="p_id" <?php echo "value=\"".getPropertyMaxID()."\""; ?> readonly="true">
                </div>
            </div>
            <!-- END -->

            <div class="control-group">
                <label class="control-label">財產編號</label>
                <div class="controls">
                  <input class="span3" type="text" id="property_id" name="p_acc">
                </div>
            </div>
            <div class="control-group">
                <label class="control-label">物品名稱</label>
                <div class="controls">
                  <input class="span3" type="text" id="item_name" name="p_name">
                </div>
            </div>
            <div class="control-group">
                <label class="control-label">物品狀態</label>
                <div class="controls">
                  <label class="radio">
                    <input type="radio" name="optionsRadios" id="lent" value="0">
                    可預約
                  </label>
                  <label class="radio">
                    <input type="radio" name="optionsRadios" id="lent" value="1">
                    已借出, 可預約
                  </label>
                  <label class="radio">
                    <input type="radio" name="optionsRadios" id="lent" value="2">
                    不可預約
                  </label>
                  <label class="radio">
                    <input type="radio" name="optionsRadios" id="lent" value="3">
                    遺失
                  </label>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label">保管者</label>
                <div class="controls">
                  <input class="span3" type="text" id="holder">
                </div>
            </div>
            <div class="control-group">
              <label class="control-label">描述</label>
              <div class="controls">
                <textarea class="span6" rows="3" id="ps" name="note"></textarea>
              </div>
            </div>
          </fieldset>
          <div style="text-align:center;">
            <div class="btn-group">
              <input class="btn btn-primary" type="submit" name="submit" value="新增">
              <a class="btn" href="admin_list.php">取消</a>
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
    <script type="text/javascript">
      $('#property_id').focus();
    </script>
 </body>
</html>
