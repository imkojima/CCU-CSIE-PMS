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
1. 編輯資料後頁面不會自動刷新 (加jQuery)  //已解 by kojima
*/
  $PATH="../";
  require_once($PATH.'auth.php');
  require_once($PATH.'libs/logs.php');
  require_once($PATH.'libs/users.php');
  require_once($PATH.'libs/reserve.php');
  require_once($PATH.'libs/property.php');
?>
<!DOCTYPE html>
<html lang="zh-tw">
  <head>
    <meta charset="utf-8">
    <title>帳號詳細資料 | CCU CSIE Property</title>
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

  <? include_once($PATH.'blocks/navbar.php'); ?>

    <div class="container" >

      <ul class="breadcrumb">
        <li><a href="../index.php">首頁</a> <span class="divider">/</span></li>
        <li><a href="admin_portal.php">管理</a> <span class="divider">/</span></li>
        <li><a href="admin_account_list.php">帳號管理</a> <span class="divider">/</span></li>
        <li class="active">帳號詳細資料 - <?php echo $_GET['u_acc']; ?></li>
      </ul>

      <section id="personal_account">
        <div class="row-fluid">
          <div class="span12">
            <div class="row-fluid">
              <div class="thumbnail span3">
                <h4><?php echo getUserName($_GET['u_acc']);?> <?php echo $_GET['u_acc'];?></h4>
                <dl>
                  <dt>權限</dt>
                     <blockquote>
					<?php 
						switch(getUserPermID($_GET['u_acc'])){
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
                    <blockquote><span class="badge <?php if(getUserGrade($_GET['u_acc'])>0) echo "badge-success"; ?>"><?php echo getUserGrade($_GET['u_acc']);?></span></blockquote>
                  <dt>聯絡電話</dt>
                    <blockquote><?php echo getUserPhone($_GET['u_acc']);?></blockquote>
                  <dt>電子信箱</dt>
                    <blockquote><?php echo getUserMail($_GET['u_acc']);?></blockquote>
                </dl>
                <div style="text-align:center;">
                  <a class="btn btn-primary" href="admin_edit_account.php?u_acc=<?php echo $_GET['u_acc']; ?>">編輯資料</a>
                </div>
              </div>
              <div class="thumbnail span9">
                <table class="table table-bordered table-striped responsive-table">
                  <caption><h4>預約狀況</h4>(所有狀態皆列出)</caption>
                  <thead>
                    <tr>
                      <th width="50px">編號</th>
                      <th>財產名稱</th>
                      <th width="150px">狀態</th>
                      <th width="220px">執行</th>
                    </tr>
                  </thead>
                  <tbody>
                   <?php
                  $reserves = getUserReserve($_GET['u_acc']);

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
                            <td data-title=\"執行\"><div class=\"btn-group\"><button class=\"btn btn-primary\" data-toggle=\"modal\" data-target=\"#detail\" href=\"../modal_reserve_detail.php?r_id=".$reserves[$i]['r_id']."\">詳細資料</button>
                        ";

					  if($reserves[$i]['r_state'] <= 2){
						  echo "
							  <button class=\"btn\" data-toggle=\"modal\" data-target=\"#action\" href=\"modal_audit_confirm.php?action="; 

						  if($reserves[$i]['r_state'] == 0) 
							  echo "accept_edit"; 
						  elseif($reserves[$i]['r_state'] == 1) 
							  echo "lent_edit"; 
						  elseif($reserves[$i]['r_state'] == 2) 
							  echo "return_edit";

						  echo "&u_acc=".$reserves[$i]['u_id']."&r_id=".$reserves[$i]['r_id']."\" "; if($reserves[$i]['r_state'] > 2) echo "disabled"; echo ">"; 

						  if($reserves[$i]['r_state'] == 0)
							  echo "核准"; 
						  elseif($reserves[$i]['r_state'] == 1)
							  echo "已取走"; 
						  elseif($reserves[$i]['r_state'] == 2)
							  echo "確認歸還";
						  else
							  echo " --- "; echo "</button>
							  <button class=\"btn\" data-toggle=\"modal\" data-target=\"#action\" href=\"modal_audit_confirm.php?action=denial_edit&u_acc=".$reserves[$i]['u_id']."&r_id=".$reserves[$i]['r_id']."\" ";

						  if($reserves[$i]['r_state'] > 2) echo "disabled"; echo ">";

						  if($reserves[$i]['r_state'] == 0) 
							  echo "不核准"; 
						  elseif($reserves[$i]['r_state'] == 1) 
							  echo "取消";
						  elseif($reserves[$i]['r_state'] == 2) 
							  echo "催促歸還";
						  else
							  echo " --- "; echo "</button>";
					  }	

					  echo "</div></td>
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
    </div>

    <!-- Modal -->
    <div class="modal hide" id="action" role="dialog"><!-- note the use of "hide" class -->
      <div class="modal-header">
        <button class="close" data-dismiss="modal">×</button>
        <h3>確認？</h3>
      </div>
        <div class="modal-body">
        Loading...
      </div>
    </div>
    <!-- END Modal -->

    <?php
      if($_POST['action'] == "denial") {
          echo "
          <div class=\"modal hide\" id=\"done\" role=\"dialog\">
            <div class=\"modal-header\">
              <button class=\"close\" data-dismiss=\"modal\">×</button>
              <h3>取消預約成功！</h3>
            </div>
            <div class=\"modal-body\">";
          echo "預約編號:".$_POST["r_id"];
          echo "
          </div>
          <div class=\"modal-footer\">
            <a href=\"#\" class=\"btn btn-primary\" data-dismiss=\"modal\">關閉</a>
          </div>
          </div>";
		  rejectReserve( $_POST["r_id"] );
 		  makeLog("System", "駁回預約 - [R:".$_POST['r_id']."]"); 
      }elseif ($_POST['action'] == "accept") {
        echo "
        <div class=\"modal hide\" id=\"done\" role=\"dialog\">
          <div class=\"modal-header\">
            <button class=\"close\" data-dismiss=\"modal\">×</button>
            <h3>核准成功！</h3>
          </div>
          <div class=\"modal-body\">";
        echo "預約編號:".$_POST["r_id"];
        echo "
        </div>
        <div class=\"modal-footer\">
          <a href=\"#\" class=\"btn btn-primary\" data-dismiss=\"modal\">關閉</a>
        </div>
        </div>";
        acceptReserve( $_POST["r_id"] );
 		makeLog("System", "核准預約 - [R:".$_POST['r_id']."]");
      }
      elseif ($_POST['action'] == "lent") {
        echo "
        <div class=\"modal hide\" id=\"done\" role=\"dialog\">
          <div class=\"modal-header\">
            <button class=\"close\" data-dismiss=\"modal\">×</button>
            <h3>借出成功！</h3>
          </div>
          <div class=\"modal-body\">";
        echo "預約編號:".$_POST["r_id"];
        echo "
        </div>
        <div class=\"modal-footer\">
          <a href=\"#\" class=\"btn btn-primary\" data-dismiss=\"modal\">關閉</a>
        </div>
        </div>";
		lentReserve( $_POST["r_id"] );
		$property = getReserveByRID( $_POST["r_id"] );
 		makeLog("System", "借出預約 - [R:".$_POST["r_id"]."][P:".$property['']['p_id']."]"); 
      }elseif ($_POST['action'] == "return") {
        echo "
        <div class=\"modal hide\" id=\"done\" role=\"dialog\">
          <div class=\"modal-header\">
            <button class=\"close\" data-dismiss=\"modal\">×</button>
            <h3>歸還成功！</h3>
          </div>
          <div class=\"modal-body\">";
        echo "預約編號:".$_POST["r_id"];
        echo "
        </div>
        <div class=\"modal-footer\">
          <a href=\"#\" class=\"btn btn-primary\" data-dismiss=\"modal\">關閉</a>
        </div>
        </div>";
		returnReserve( $_POST["r_id"] );
		$property = getReserveByRID( $_POST["r_id"] );
		makeLog("System", "歸還預約 - [R:".$_POST['r_id']."][P:".$property['']['p_id']."]");
      }
                                                             
      
    ?>
    <script type="text/javascript" src="../js/jquery.js"></script>
    <script type="text/javascript" src="../js/bootstrap.min.js"></script>
    <script type="text/javascript" src="../js/jquery.tablesorter.js"></script>
    <script type="text/javascript" src="../js/jquery.metadata.js"></script>
    <script type="text/javascript" src="../js/jquery.tablecloth.js"></script>

    <script type="text/javascript">
      $('body').on('hidden', '.modal', function () {
        $(this).removeData('modal');
      });

      $("a[data-target=#action]").click(function(ev) {
        ev.preventDefault();
        var target = $(this).attr("href");

        // load the url and show modal on success
        $("#action .modal-body").load(target, function() { 
            $("#action").modal("show"); 
        });
      });

      $(document).ready(function() {
        $("table").tablesorter({
          headers: {3:{sorter:false}},
          sortList: [[0,1]]
        });
      });
    </script>
 </body>
</html>
