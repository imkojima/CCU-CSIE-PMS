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
	require_once($PATH."libs/announce.php");
?> 
<!DOCTYPE html>
<html lang="zh-tw">
  <head>
    <meta charset="utf-8">
    <title>編輯公告 | CCU CSIE Property</title>
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

<?php include_once($PATH.'blocks/navbar.php'); ?>

  <div class="container">

    <section id="edit-page">
      <ul class="breadcrumb">
        <li><a href="../index.php">首頁</a> <span class="divider">/</span></li>
        <li><a href="admin_portal.php">管理</a> <span class="divider">/</span></li>
	    <li><a href="admin_announcement.php">管理公告</a> <span class="divider">/</span></li>
		<li class="active">編輯</li>
      </ul>        

	  <div class="row-fluid">
          <form class="form-horizontal well span12" method="post" action="admin_announcement.php">
            <fieldset>
              <div class="control-group">
                  <label class="control-label">公告編號</label>
                  <div class="controls">
                    <input class="input-medium" type="text" name="ID" id="user_name" value="<?php echo $_GET['ID']; ?>" readonly="true">
                  </div>
              </div>
              <div class="control-group">
                  <label class="control-label">標題</label>
                  <div class="controls">
                    <input class="input-xxlarge" type="text" name="title" id="user_name" value="<?php echo getAnnouncementTitle($_GET['ID']); ?>">
                  </div>
              </div>
              <div class="control-group">
              	<label class="control-label">時間</label>
                  <div class="controls">
                    <input class="input-large" type="text" name="date" id="user_name" value="<?php echo getAnnouncementDate($_GET['ID']); ?>">
                  </div>
              </div>
              <div class="control-group">
                  <label class="control-label">置頂</label>
                  <div class="controls">
                    <label class="radio">
                      <input type="radio" name="pin" id="top" value="1" <?php if(getAnnouncementPin($_GET['ID']) == '1') echo "checked";?> >
                      置頂
                    </label>
                    <label class="radio">
                      <input type="radio" name="pin" id="normal" value="0" <?php if(getAnnouncementPin($_GET['ID']) == '0') echo "checked";?>>
                      一般
                    </label>
                  </div>
              </div>
              <div class="control-group">
                  <label class="control-label">內文</label>
                  <div class="controls">
                    <textarea class="span7" rows="4" name="content"><?php echo getAnnouncementContent($_GET['ID']); ?></textarea>
                  </div>
              </div>
            </fieldset>
            <div class="btn-group span3 offset9" text-align="right">
              <button class="btn" name='submit' type="submit" value='Update'>更新</button>
              <a class="btn" href="admin_announcement.php">取消</a>
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
        <button class="btn btn-danger" name='submit' type='submit' value='Delete'>刪除</button>
        <button class="btn" data-dismiss="modal">取消</button>
      </div>
    </div>
    <!-- END Modal -->
    </form>

    <script type="text/javascript" src="../js/jquery.js"></script>
    <script type="text/javascript" src="../js/bootstrap.min.js"></script>
 </body>
</html>
