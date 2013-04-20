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

/*
已知問題：
1. 編輯資料後頁面不會自動刷新 (加jQuery)	//已解 by kojima
*/
	require_once('auth.php');
	require_once('libs/logs.php');
	require_once('libs/users.php');
	require_once('libs/reserve.php');
	require_once('libs/property.php');
?>
<!DOCTYPE html>
<html lang="zh-tw">
  <head>
    <meta charset="utf-8">
    <title>個人資料 | CCU CSIE Property</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <script src="http://code.jquery.com/jquery-1.8.3.js"></script>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/bootstrap-responsive.css">
    <link rel="stylesheet" type="text/css" href="css/font-awesome.css">
    <link rel="stylesheet" type="text/css" href="css/tablecloth.css">
    <link rel="stylesheet" type="text/css" href="css/nomoretable.css">

    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>    
  </head>
  <body>

<? include_once('blocks/navbar.php'); ?>

    <div class="container" >

      <ul class="breadcrumb">
        <li><a href="index.php">首頁</a> <span class="divider">/</span></li>
        <li class="active">個人資料</li>
      </ul>

      <section id="personal_account">
        <div class="row-fluid">
          <div class="span12">
            <div class="row-fluid">
              <div class="thumbnail span3">
                <h4><?php echo getUserName($_SESSION['ccupms_acc']);?> <?php echo $_SESSION['ccupms_acc'];?></h4>
                <dl>
                  <dt>權限</dt>
                    <blockquote>
					<?php 
						switch(getUserPermID($_SESSION['ccupms_acc'])){
							case 0:
								echo "學生";
								break;
							case 1:
								echo "管理者";
								break;
							case 2:
								echo "教職員";
								break;
							default:
								echo "未歸類";
						}
					?>
					</blockquote>
                  <dt>評等</dt>
                    <blockquote><span class="badge <?php if(getUserGrade($_SESSION['ccupms_acc'])>0) echo "badge-success"; ?>"><?php echo getUserGrade($_SESSION['ccupms_acc']);?></span></blockquote>
                  <dt>聯絡電話</dt>
                    <blockquote><?php echo getUserPhone($_SESSION['ccupms_acc']);?></blockquote>
                  <dt>電子信箱</dt>
                    <blockquote><?php echo getUserMail($_SESSION['ccupms_acc']);?></blockquote>
                </dl>
                <div style="text-align:center;">
                  <button class="btn btn-primary" data-toggle="modal" data-target="#edit" href="modal_edit_account.php">編輯資料</button>
                </div>
              </div>
              <div class="thumbnail span9">
                 <table class="table table-bordered table-striped responsive-table">
                  <caption><h4>可用預約狀況</h4> (僅顯示可取消、審核中、審核通過的紀錄)</caption>
                  <thead>
                    <tr>
                      <th width="50px">編號</th>
                      <th>財產名稱</th>
                      <th width="150px">狀態</th>
                      <th width="160px">執行</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                    $reserves = getUserReserveAccount($_SESSION['ccupms_acc'], 'avaliable');

                    if (count($reserves) <= 1) {
                      echo "<tr>
                              <td colspan=\"4\">尚無記錄</td>
                            </tr>";
                    }
                    else {
                      for ($i=0; $i < count( $reserves )-1; $i++) { 
                        echo "
                          <tr>
                            <td data-title=\"編號\">".$reserves[$i]['r_id']."</td>
                            <td data-title=\"財產名稱\">".getPropertyName($reserves[$i]['p_id'])."</td>
                            <td data-title=\"狀態\">";
                        switch ($reserves[$i]['r_state']) {
                          case '0':
                            echo "正在審核中";
                            break;
                          case '1':
                            echo "審核通過";
                            break;
                          case '2':
                            echo "已借用";
                            break;
                          case '3':
                            echo "已歸還";
                            break;
                          case '4':
                            echo "未歸還";
                            break;
                          case '5':
                            echo "已取消預約";
                            break;
                          case '6':
                            echo "審核未過";
                            break;
                          default:
                            echo "未知狀態";
                            break;
                        }
                        echo "
                            </td>
                            <td data-title=\"執行\"><div class=\"btn-group\"><button class=\"btn btn-primary\" data-toggle=\"modal\" data-target=\"#detail\" href=\"modal_reserve_detail.php?r_id=".$reserves[$i]['r_id']."\">詳細資料</button><button class=\"btn\" data-toggle=\"modal\" data-target=\"#cancel_reserve\" href=\"modal_reserve_cancel.php?r_id=".$reserves[$i]['r_id']."&page=account\">取消預約</button></div></td>
                          </tr>
                        ";
                      }
                    }
                  ?>
                  </tbody>
                </table> 

                 <table class="table table-bordered table-striped responsive-table">
                  <caption><h4>目前借用狀況</h4> (僅顯示借用中的紀錄)</caption>
                  <thead>
                    <tr>
                      <th width="50px">編號</th>
                      <th>財產名稱</th>
                      <th width="150px">狀態</th>
                      <th width="160px">執行</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                    $reserves = getUserReserveAccount($_SESSION['ccupms_acc'], 'borrowed');

                    if (count($reserves) <= 1) {
                      echo "<tr>
                              <td colspan=\"4\">尚無記錄</td>
                            </tr>";
                    }
                    else {
                      for ($i=0; $i < count( $reserves )-1; $i++) { 
                        echo "
                          <tr>
                            <td data-title=\"編號\">".$reserves[$i]['r_id']."</td>
                            <td data-title=\"財產名稱\">".getPropertyName($reserves[$i]['p_id'])."</td>
                            <td data-title=\"狀態\">";
                        switch ($reserves[$i]['r_state']) {
                          case '0':
                            echo "正在審核中";
                            break;
                          case '1':
                            echo "審核通過";
                            break;
                          case '2':
                            echo "已借用";
                            break;
                          case '3':
                            echo "已歸還";
                            break;
                          case '4':
                            echo "未歸還";
                            break;
                          case '5':
                            echo "已取消預約";
                            break;
                          case '6':
                            echo "審核未過";
                            break;
                          default:
                            echo "未知狀態";
                            break;
                        }
                        echo "
                            </td>
                            <td data-title=\"執行\"><div class=\"btn-group\"><button class=\"btn btn-primary\" data-toggle=\"modal\" data-target=\"#detail\" href=\"modal_reserve_detail.php?r_id=".$reserves[$i]['r_id']."\">詳細資料</button></div></td>
                          </tr>
                        ";
                      }
                    }
                  ?>
                  </tbody>
                </table> 
              </div>
            </div>
          </div>
        </div>
      </section>

      <div class="footer">
        <hr />
        <p>Property Management System - &#169;2012 Dept. of CSIE, National Chung Cheng University</p>
      </div> 
    </div>

    <!--Record List Modal Start-->
    <div class="modal hide" id="edit" role="dialog"><!-- note the use of "hide" class -->
      <div class="modal-header">
        <button class="close" data-dismiss="modal">×</button>
        <h3>編輯資料</h3>
      </div>
      <div class="modal-body">
        Loading...
      </div>
      <div class="modal-footer">
        <a href="#" class="btn btn-primary" data-dismiss="modal">關閉</a><!-- note the use of "data-dismiss" -->
      </div>
    </div>​
    <!--Record List Modal End-->

    <div class="modal hide" id="detail" role="dialog"><!-- note the use of "hide" class -->
      <div class="modal-header">
        <button class="close" data-dismiss="modal">×</button>
        <h3>詳細資料</h3>
      </div>
      <div class="modal-body">
        Loading...
      </div>
      <div class="modal-footer">
        <a href="#" class="btn btn-primary" data-dismiss="modal">關閉</a><!-- note the use of "data-dismiss" -->
      </div>
    </div>​
    <!--Record List Modal End-->
    <div class="modal hide" id="cancel_reserve" role="dialog"><!-- note the use of "hide" class -->
      <div class="modal-header">
        <button class="close" data-dismiss="modal">×</button>
        <h3>確定要取消預約？</h3>
      </div>
        <div class="modal-body">
        Loading...
      </div>
    </div>​

    <?php
      if($_POST['action'] == "done") {
        if($_POST['submit'] == "cancel") {
          echo "
          <div class=\"modal hide\" id=\"done\" role=\"dialog\">
            <div class=\"modal-header\">
              <button class=\"close\" data-dismiss=\"modal\">×</button>
              <h3>取消預約成功！</h3>
            </div>
            <div class=\"modal-body\">";
          echo "<h4>已取消預約編號</h4><blockquote>".$_POST["r_id"]."</blockquote>";
          echo "
          </div>
          <div class=\"modal-footer\">
            <a href=\"#\" class=\"btn btn-primary\" data-dismiss=\"modal\">關閉</a>
          </div>
          </div>";
          cancelReserve( $_POST["r_id"] );
		      makeLog($_SESSION['ccupms_acc'], "取消預約 - [".$_POST['r_id']."]");
        }
        else {
          echo "
          <div class=\"modal hide\" id=\"done\" role=\"dialog\">
            <div class=\"modal-header\">
              <button class=\"close\" data-dismiss=\"modal\">×</button>
              <h3>編輯帳號成功！</h3>
            </div>
            <div class=\"modal-body\">";
          echo "<h4>帳號</h4><blockquote>".$_SESSION['ccupms_acc']."</blockquote>";
          echo "<h4>姓名</h4><blockquote>".htmlspecialchars(addslashes($_POST['user_name']))."</blockquote>";
          echo "<h4>電話</h4><blockquote>".htmlspecialchars(addslashes($_POST['phone']))."</blockquote>";
          echo "<h4>電子信箱</h4><blockquote>".htmlspecialchars(addslashes($_POST['email']))."</blockquote>";
          echo "
          </div>
          <div class=\"modal-footer\">
            <a href=\"#\" class=\"btn btn-primary\" data-dismiss=\"modal\">關閉</a>
          </div>
          </div>";

          editUser($_SESSION['ccupms_acc'],htmlspecialchars(addslashes($_POST['user_name'])),getUserGrade($_SESSION['ccupms_acc']),htmlspecialchars(addslashes($_POST['phone'])),htmlspecialchars(addslashes($_POST['email'])),getUserPermID($_SESSION['ccupms_acc']));
		      makeLog($_SESSION['ccupms_acc'],'個人資料編輯');
        }
      }
    ?>
    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/jquery.tablesorter.js"></script>
    <script type="text/javascript" src="js/jquery.metadata.js"></script>
    <script type="text/javascript" src="js/jquery.tablecloth.js"></script>

    <script type="text/javascript">
      $(document).ready(function() {
          $(window).load(function() {
              $('#done').modal('show');
          });
      });

      $("#cancel_reserve").on('hidden', function() {
          location.reload();
      });

      $("#done").on('hidden', function() {
          location.reload();
      });

      $("a[data-target=#edit]").click(function(ev) {
          ev.preventDefault();
          var target = $(this).attr("href");

          // load the url and show modal on success
          $("#edit .modal-body").load(target, function() {
              $("#edit").modal("show");
          });
      });

      $("a[data-target=#cancel_reserve]").click(function(ev) {
          ev.preventDefault();
          var target = $(this).attr("href");

          // load the url and show modal on success
          $("#cancel_reserve .modal-body").load(target, function() {
              $("#cancel_reserve").modal("show");
          });
      });

      $("a[data-target=#detail]").click(function(ev) {
          ev.preventDefault();
          var target = $(this).attr("href");

          // load the url and show modal on success
          $("#detail .modal-body").load(target, function() {
              $("#detail").modal("show");
          });
      });

      $(document).ready(function() {
          $("table").tablesorter({
              headers: {
                  3: {
                      sorter: false
                  }
              },
              sortList: [[0, 1]]
          });
      });
    </script>
 </body>
</html>
