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

/* Problems:
  1.縮小表格無法變橫向
*/
  $PATH="../";
  require_once($PATH."auth.php");
  require_once($PATH."libs/logs.php");
  require_once($PATH."libs/reserve.php");
  require_once($PATH."libs/users.php");
  require_once($PATH."libs/property.php");
?>

<!DOCTYPE html>
<html lang="zh-tw">
  <head>
    <meta charset="utf-8">
    <title>審查資料列表 | CCU CSIE Property</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../css/bootstrap-responsive.css">
    <link rel="stylesheet" type="text/css" href="../css/nomoretable.css">
    <link rel="stylesheet" type="text/css" href="../css/font-awesome.css">
    <link rel="stylesheet" type="text/css" href="../css/tablecloth.css">
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
  
  </head>

  <body>
  <?php require_once($PATH.'blocks/navbar.php'); ?>

    <div class="container" >

      <section id="query-list">
        <ul class="breadcrumb">
          <li><a href="../index.php">首頁</a> <span class="divider">/</span></li>
          <li><a href="admin_portal.php">管理</a> <span class="divider">/</span></li>
          <li class="active">審查列表</li>
        </ul>
     
		<div class="pull-right">   
		<form class="form-search" id="search">
		  <input type="hidden" name="search" value="yes"> 
 		  <input type="hidden" name="mode" value="<?php if($_GET['mode']!='') echo htmlspecialchars(addslashes($_GET['mode'])); else echo "reserve";?>">
		  <select name="class" class="span2">
			<option value="full">全文</option>
			<option value="title">名稱</option>
			<option value="description">描述</option>
			<option value="accno">財產編號</option>
<!--            <option value="place">地點</option>
			<option value="keeper">保管者</option> -->
		  </select>
		  <div class="input-append">
			<input type="text" name="query" class="span4 search-query" placeholder="<?php echo (htmlspecialchars(addslashes($_GET['query'])) =='')?"在找些什麼嗎？":htmlspecialchars(addslashes($_GET['query'])); ?>">
			<button type="submit" class="btn">搜尋</button>
		  </div>
		</form> 
		</div>

        <div class="tabbable">
          <ul class="nav nav-tabs">
            <li class="<?php if($_GET['mode']=='' || $_GET['mode']=='reserve') echo 'active'; ?>"><a href="#reserve" data-toggle="tab">借用</a></li>
            <li class="<?php if($_GET['mode']=='return') echo 'active'; ?>"><a href="#return" data-toggle="tab">歸還</a></li>
          </ul>
          <div class="tab-content">
            <div class="tab-pane <?php if($_GET['mode']=='' || $_GET['mode']=='reserve') echo 'active'; ?>" id="reserve">
          	  <table class="table table-bordered table-striped responsive-table" id="reservelist">
                <thead>
                  <tr>
                    <th width="50px">編號</th>
                    <th width="200px">財產名稱</th>
                    <th width="150px">借用人</th>
                    <th>借用原因</th>
                    <th width="120px">狀態</th>
                    <th width="120px">執行</th>
                  </tr>
                </thead>
                <tbody>
                <?php
                  $reserves = getReserveAuditList();

                  if (count($reserves) <= 1) {
                    echo "<tr>
                            <td colspan=\"6\">尚無記錄</td>
                          </tr>";
                  }
                  else {
                    for ($i=0; $i < count( $reserves )-1; $i++) { 
                      echo "
                        <tr>
                          <td data-title=\"編號\">".$reserves[$i]['r_id']."</td>
                          <td data-title=\"財產名稱\">".getPropertyName($reserves[$i]['p_id'])."</td>
                          <td data-title=\"借用人\">".getUserName($reserves[$i]['u_id'])."(".$reserves[$i]['u_id'].")</td>
                          <td data-title=\"借用原因\">".$reserves[$i]['r_reason']."</td>
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
                      echo "</td>
                          <td data-title=\"執行\"><div class=\"btn-group\"><button class=\"btn btn-primary\" data-toggle=\"modal\" data-target=\"#action\" href=\"modal_audit_confirm.php?action="; if($reserves[$i]['r_state'] == 0) echo "accept"; else echo "lent"; echo "&r_id=".$reserves[$i]['r_id']."\">"; if($reserves[$i]['r_state'] == 0) echo "核准"; else echo "已取走"; echo "</button><button class=\"btn\" data-toggle=\"modal\" data-target=\"#action\" href=\"modal_audit_confirm.php?action=denial&r_id=".$reserves[$i]['r_id']."\">";if($reserves[$i]['r_state'] == 0) echo "不核准"; else echo "取消"; echo "</div></td>
                        </tr>
                      ";
                    }
                  }
                ?>
                </tbody>
              </table>
       <div class="well well-small">

<?php	if(count($reserves)>1){ ?>
        <div class="span4 pull-right" id="reserve-pager">
          <form style="padding:0px;margin:0px;font-size:20px;" class="pull-right">
              <i class="icon-step-backward first"></i>
              <i class="icon-caret-left prev"></i>
              <input type="text" class="input-small pagedisplay"/>  
              <i class="icon-caret-right next"></i>
              <i class="icon-step-forward last"></i>
              <select class="pagesize input-small">
                  <option selected="selected"value="10">10</option>
                  <option value="20">20</option>
                  <option value="30">30</option>
                  <optionvalue="40">40</option>
              </select>
          </form> 
        </div>
<?php	} ?>
        <div class="span3"style="width:120px;"><p>共有 <span class="badge badge-info"><?php echo count($reserves)-1; ?></span> 筆結果</p></div>
      </div>
			</div>
            <div class="tab-pane <?php if($_GET['mode']=='return') echo 'active'; ?>" id="return">
              <table class="table table-bordered table-striped responsive-table" id="returnlist">
                <thead>
                  <tr>
                    <th width="50px">編號</th>
                    <th width="200px">財產名稱</th>
                    <th width="150px">借用人</th>
                    <th>借用日期</th>
                    <th width="150px">狀態</th>
                    <th width="120px">執行</th>
                  </tr>
                </thead>
                <tbody>
                <?php
                  $returns = getReserveReturnList();

                  if (count($returns) <= 1) {
                    echo "<tr>
                            <td colspan=\"6\">尚無記錄</td>
                          </tr>";
                  }
                  else {
                    for ($i=0; $i < count( $returns )-1; $i++) { 
                        echo "
                          <tr>
                            <td data-title=\"編號\">".$returns[$i]['r_id']."</td>
                            <td data-title=\"財產名稱\">".getPropertyName($returns[$i]['p_id'])."</td>
                            <td data-title=\"借用人\">".getUserName($returns[$i]['u_id'])."(".$returns[$i]['u_id'].")</td>
                            <td data-title=\"借用日期\">".$returns[$i]['r_date']."</td>
                            <td data-title=\"狀態\">";
                        switch ($returns[$i]['r_state']) {
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
                        echo "</td>
                            <td data-title=\"執行\"><div class=\"btn-group\"><button class=\"btn btn-primary\" data-toggle=\"modal\" data-target=\"#action\" href=\"modal_audit_confirm.php?action=return&r_id=".$returns[$i]['r_id']."\">歸還</button><button class=\"btn\" data-toggle=\"modal\" href=\"#hurry\">催促歸還</div></td>
                          </tr>
                        ";
                    }
                  }
                ?>
                </tbody>
              </table>
        <div class="well well-small">
<?php if(count($returns)>1){ ?> 
       <div class="span4 pull-right" id="return-pager">
          <form style="padding:0px;margin:0px;font-size:20px;" class="pull-right">
              <i class="icon-step-backward first"></i>
              <i class="icon-caret-left prev"></i>
              <input type="text" class="input-small pagedisplay"/>  
              <i class="icon-caret-right next"></i>
              <i class="icon-step-forward last"></i>
              <select class="pagesize input-small">
                  <option selected="selected"value="10">10</option>
                  <option value="20">20</option>
                  <option value="30">30</option>
                  <optionvalue="40">40</option>
              </select>
          </form> 
        </div>
<?php	} ?>
        <div class="span3"style="width:120px;"><p>共有 <span class="badge badge-info"><?php echo count($returns)-1; ?></span> 筆結果</p></div>
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
              <h3>駁回預約成功！</h3>
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
		makeLog("System", "借出預約 - [R:".$_POST['r_id']."]");
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
		makeLog("System", "歸還預約 - [R:".$_POST['r_id']."]");
      }
    ?>

    <script type="text/javascript" src="../js/jquery.js"></script>
    <script type="text/javascript" src="../js/bootstrap.js"></script>
    <script type="text/javascript" src="../js/jquery.tablesorter.js"></script>
    <script type="text/javascript" src="../js/jquery.tablesorter.pager.js"></script>
    <script type="text/javascript" src="../js/jquery.metadata.js"></script>
    <script type="text/javascript" src="../js/jquery.tablecloth.js"></script>
    <script type="text/javascript">

	  $(window).load(function(){
		  $('#done').modal('show');
	  }); 

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


	  $('a[href="#reserve"]').on('shown', function (e) {
		$("#search input[name=mode]").val('reserve');
	  }); 

	  $('a[href="#return"]').on('shown', function (e) { 
		$("#search input[name=mode]").val('return');
	  });

   	  $("#done").on('hidden', function () {
		      location.reload();
      }); 

      $(document).ready(function() {
        $("table").tablesorter({
          headers: {3:{sorter:false}, 5:{sorter:false}},
          sortList: [[0,1]]
        });
		$("#reservelist").tablesorterPager({
		  container: $("#reserve-pager")
		});
		$("#reservelist").tablesorterPager({
		  container: $("#return-pager")
		});
      });
    </script>
  </body>
</html>
