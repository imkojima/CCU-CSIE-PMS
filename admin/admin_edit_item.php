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
  $p_id = $_GET["p_id"];
?>

<!DOCTYPE html>
<html lang="zh-tw">
  <head>
    <meta charset="utf-8">
    <title>編輯 | CCU CSIE Property</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <script src="http://code.jquery.com/jquery-1.8.3.js"></script>
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../css/bootstrap-responsive.css">
    <link rel="stylesheet" type="text/css" href="../css/font-awesome.css">

    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>    
  </head>
  <body>
  <? include_once($PATH."blocks/navbar.php"); ?>

    <div class="container" >
      <form method="post" action="modal_edit_property.php">
      <section id="edit-page">
        <ul class="breadcrumb">
          <li><a href="index.php">首頁</a> <span class="divider">/</span></li>
          <li><a href="admin_portal.php">管理</a> <span class="divider">/</span></li>
          <li><a href="admin_list.php">物品管理</a> <span class="divider">/</span></li>
          <li class="active">編輯</li>
        </ul>
        <div class="row-fluid form-horizontal well span12">
            <fieldset>
              <div class="control-group">
                  <label class="control-label">資料庫ID</label>
                  <div class="controls">
                    <input class="span3" type="text" readonly="true" id="database_id" name="p_id" <?php echo "value=\"$p_id\""; ?> >
                  </div>
              </div>
              <div class="control-group">
                  <label class="control-label">財產編號</label>
                  <div class="controls">
                    <input class="span3" type="text" id="property_id" name="p_acc" <?php echo "value=\"".getPropertyID($p_id)."\""; ?> >
                  </div>
              </div>
              <div class="control-group">
                  <label class="control-label">物品名稱</label>
                  <div class="controls">
                    <input class="span3" type="text" id="item_name" name="p_name" <?php echo "value=\"".getPropertyName($p_id)."\""; ?> >
                  </div>
              </div>
              <div class="control-group">
                  <label class="control-label">物品狀態</label>
                  <div class="controls">
                    <label class="radio">
                      <input type="radio" name="optionsRadios" id="state" value="0" <?php if(getPropertyState($p_id) == '0') echo "checked";?> >
                      可預約
                    </label>
                    <label class="radio">
                      <input type="radio" name="optionsRadios" id="state" value="1" <?php if(getPropertyState($p_id) == '1') echo "checked";?> >
                      已借出，可預約
                    </label>
                    <label class="radio">
                      <input type="radio" name="optionsRadios" id="state" value="2" <?php if(getPropertyState($p_id) == '2') echo "checked";?> >
                      不可預約
                    </label>
                    <label class="radio">
                      <input type="radio" name="optionsRadios" id="state" value="3" <?php if(getPropertyState($p_id) == '3') echo "checked";?> >
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
                  <textarea class="span5" rows="3" id="ps" name="note" ><?php echo getPropertyModel($p_id); ?></textarea>
                </div>
              </div>
            </fieldset>
            <div class="btn-group span3 offset9" text-align="right">
              <input class="btn" name='submit' type="submit" value='更新'>
              <a class="btn" href="admin_list.php">取消</a>
              <button class="btn btn-danger" data-toggle="modal" href="#remove">刪除</button>
            </div>
        </div>
      </section>

      <div class="footer">
        <hr />
        <p>Property Management System - &#169;2012 Dept. of CSIE, National Chung Cheng University</p>
      </div> 
    </div>

    <!-- Modal -->
    <div class="modal hide" id="remove" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 id="myModalLabel">確定要刪除此項物品？</h3>
      </div>
      <div class="modal-footer">
        <input class="btn btn-danger" name='submit' type='submit' value='刪除'>
        <button class="btn" data-dismiss="modal">取消</button>
      </div>
    </div>
    </form>
    <!-- END Modal -->

    <script type="text/javascript" src="../js/jquery.js"></script>
    <script type="text/javascript" src="../js/bootstrap.min.js"></script>
 </body>
</html>

