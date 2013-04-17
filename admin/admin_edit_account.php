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
  require_once($PATH.'libs/users.php');
?>
<!DOCTYPE html>
<html lang="zh-tw">
  <head>
    <meta charset="utf-8">
    <title>編輯帳號 | CCU CSIE Property</title>
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
<?php include_once($PATH.'blocks/navbar.php'); ?>

    <div class="container" >
    <form class="form-horizontal" method="post" action="admin_account_list.php">
      <section id="edit-page">
        <ul class="breadcrumb">
          <li><a href="index.php">首頁</a> <span class="divider">/</span></li>
          <li><a href="admin_portal.php">管理</a> <span class="divider">/</span></li>
          <li><a href="admin_account_list.php">帳號管理</a> <span class="divider">/</span></li>
          <li class="active">編輯帳號</li>
        </ul>
        <div class="row-fluid form-horizontal well span12">
            <fieldset>
              <div class="control-group">
                  <label class="control-label">學號</label>
                  <div class="controls">
                    <input class="input-medium" type="text" id="user_id" name="u_acc" value="<?php echo $_GET['u_acc'];?>" readonly="true">
                  </div>
              </div>
              <div class="control-group">
                  <label class="control-label">姓名</label>
                  <div class="controls">
                    <input class="input-medium" type="text" id="user_name" name="name" value="<?php echo getUserName($_GET['u_acc']);?>">
                  </div>
              </div>
              <div class="control-group">
                  <label class="control-label">評等</label>
                  <div class="controls">
                    <input class="input-medium" type="text" id="repute" name="grade" value="<?php echo getUserGrade($_GET['u_acc']);?>">
                  </div>
              </div>
              <div class="control-group">
                  <label class="control-label">權限</label>
                  <div class="controls">
                    <label class="radio">
                      <input type="radio" name="optionsRadios" id="student" value="0" <?php if(getUserPerm($_GET['u_acc']) == 'student') echo "checked"; ?>>
                      學生
                    </label>
                    <label class="radio">
                      <input type="radio" name="optionsRadios" id="admin" value="1" <?php if(getUserPerm($_GET['u_acc']) == 'admin') echo "checked"; ?>>
                      管理員
                    </label>
                    <label class="radio">
                      <input type="radio" name="optionsRadios" id="ungroup" value="2" <?php if(getUserPerm($_GET['u_acc']) == 'faculty') echo "checked"; ?>>
                      教職員
                    </label>
                    <label class="radio">
                      <input type="radio" name="optionsRadios" id="ungroup" value="3" <?php if(getUserPerm($_GET['u_acc']) == 'default') echo "checked"; ?>>
                      未歸類
                    </label>
                  </div>
              </div>
              <div class="control-group">
                  <label class="control-label">聯絡電話</label>
                  <div class="controls">
                    <input class="input-medium" type="text" id="phone" name="phone" value="<?php echo getUserPhone($_GET['u_acc']);?>">
                  </div>
              </div>
              <div class="control-group">
                  <label class="control-label">電子信箱</label>
                  <div class="controls">
                    <input class="input-medium" type="text" id="email" name="mail" value="<?php echo getUserMail($_GET['u_acc']);?>">
                  </div>
              </div>
            </fieldset>
            <div style="text-align:center;">
              <div class="btn-group">
                <input class="btn btn-primary" type="submit" name="submit" value="更新">
                <a class="btn" href="admin_account_list.php">取消</a>
                <button class="btn btn-danger" data-toggle="modal" href="#remove">刪除</button>
              </div>
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
        <h3 id="myModalLabel">確定要刪除此帳號？</h3>
      </div>
      <div class="modal-footer">
        <input class="btn btn-danger" type="submit" name="submit" value="刪除">
        <button class="btn" data-dismiss="modal">取消</button>
      </div>
    </div>
    <!-- END Modal -->
    </form>

    <script type="text/javascript" src="../js/jquery.js"></script>
    <script type="text/javascript" src="../js/bootstrap.min.js"></script>
 </body>
</html>
