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
  require_once('libs/users.php');
  require_once('libs/reserve.php');
  require_once('libs/property.php');
  require_once('libs/logs.php');
?>

<!DOCTYPE html>
<html lang="zh-tw">
  <head>
    <meta charset="utf-8">
    <title>資料列表 | CCU CSIE Property</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/bootstrap-responsive.css">
    <link rel="stylesheet" type="text/css" href="css/font-awesome.css">
    <link rel="stylesheet" type="text/css" href="css/tablecloth.css">
    <link rel="stylesheet" type="text/css" href="css/nomoretable.css">
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

  </head>

  <body>

  <? include_once('blocks/navbar.php'); ?>

  <div class="container" >

    <section id="query-list">
      <ul class="breadcrumb">
        <li><a href="index.php">首頁</a> <span class="divider">/</span></li>
        <li class="active">個人紀錄</li>
 		<?php if($_GET['search']=='yes'){ ?>
		<span class="divider">-</span></li>
		<li class="active">搜尋: <?php echo htmlspecialchars(addslashes($_GET['query']));?></li>
		<?php } ?> 
      </ul>

      <div class="pull-right">
        <form class="form-search">
		  <input type="hidden" name="search" value="yes"> 
          <select name="class" class="span2">
            <option value="full">全文</option>
            <option value="title">名稱</option>
			<option value="description">描述</option>
			<option value="accno">財產編號</option>
          </select>
          <div class="input-append">
            <input type="text" name="query" class="span4 search-query" placeholder="<?php echo (htmlspecialchars(addslashes($_GET['query'])) =='')?"在找些什麼嗎？":htmlspecialchars(addslashes($_GET['query'])); ?>">
			<button type="submit" class="btn">搜尋</button>
          </div>
        </form>
    	</div> 

      <table class="table table-bordered table-striped responsive-table">
        <thead>
          <tr>
            <th width="50px">編號</th>
            <th>財產名稱</th>
            <th width="190px">最後更新時間</th>
            <th width="150px">狀態</th>
            <th width="90px">執行</th>
          </tr>
        </thead>
        <tbody>
           <?php
			if($_GET['search']=='yes')
				$reserves = getUserReserveBySearch($_SESSION['ccupms_acc'], $_GET['class'], htmlspecialchars(addslashes($_GET['query'])));
			else
	            $reserves = getUserReserve($_SESSION['ccupms_acc']);

            if (count($reserves) <= 1) {
              echo "<tr>
                      <td colspan=\"5\">尚無記錄</td>
                    </tr>";
            }
            else {
              for ($i=0; $i < count( $reserves )-1; $i++) { 
                echo "
                  <tr>
                    <td data-title=\"編號\">".$reserves[$i]['r_id']."</td>
                    <td data-title=\"財產名稱\">".getPropertyName($reserves[$i]['p_id'])."</td>
                    <td data-title=\"最後更新時間\">".$reserves[$i]['r_date']."</td>
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
                    <td data-title=\"執行\"><div class=\"btn-group\"><button class=\"btn btn-primary\" data-toggle=\"modal\" data-target=\"#detail\" href=\"modal_reserve_detail.php?r_id=".$reserves[$i]['r_id']."\">詳細資料</button><button class=\"btn\" data-toggle=\"modal\" data-target=\"#cancel_reserve\" href=\"modal_reserve_cancel.php?r_id=".$reserves[$i]['r_id']."&page=history\""; if ($reserves[$i]['r_state'] > '1') echo "disabled"; echo " 
                    >取消預約</a></div></td>
                  </tr>
                ";
              }
            }
          ?>
        </tbody>
      </table>
       <div class="well well-small">
        <div class="span4 pull-right" id="npager">
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
        <div class="span3"style="width:120px;"><p>共有 <span class="badge badge-info"><?php echo count($reserves)-1; ?></span> 筆結果</p></div>
      </div>
    </section>

    <div class="footer">
      <hr />
      <p>Property Management System - &#169;2012 Dept. of CSIE, National Chung Cheng University</p>
    </div> 
    
  </div>

  <!--Record List Modal Start-->
  <div class="modal hide" id="detail" role="dialog"><!-- note the use of "hide" class -->
    <div class="modal-header">
      <button class="close" data-dismiss="modal">×</button>
      <h3>詳細資訊</h3>
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
  if($_POST['action']=="done" && $_POST['submit']=="cancel") {
      cancelReserve( $_POST["r_id"] );
      makeLog($_SESSION['ccupms_acc'], "取消預約 - [R:".$_POST['r_id']."]");
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
  }
  ?>
  <script type="text/javascript" src="js/jquery.js"></script>
  <script type="text/javascript" src="js/bootstrap.js"></script>
  <script type="text/javascript" src="js/jquery.tablesorter.js"></script>
  <script type="text/javascript" src="js/jquery.tablesorter.pager.js"></script>
  <script type="text/javascript" src="js/jquery.metadata.js"></script>
  <script type="text/javascript" src="js/jquery.tablecloth.js"></script>
  <script type="text/javascript">
    $(document).ready(function() {
        $(window).load(function() {
            $('#done').modal('show');
        });
    });

    $("#done").on('hidden', function() {
        location.reload();
    });

    $('body').on('hidden', '.modal', function() {
        $(this).removeData('modal');
    });

    $("a[data-target=#detail]").click(function(ev) {
        ev.preventDefault();
        var target = $(this).attr("href");

        // load the url and show modal on success
        $("#detail .modal-body").load(target, function() {
            $("#detail").modal("show");
        });
    });

    $("a[data-target=#modal]").click(function(ev) {
        ev.preventDefault();
        var target = $(this).attr("href");

        // load the url and show modal on success
        $("#modal .modal-body").load(target, function() {
            $("#modal").modal("show");
        });
    });
    $(document).ready(function() {
        $("table").tablesorter({
            headers: {
                2: {
                    sorter: false
                },
                4: {
                    sorter: false
                }
            },
            sortList: [[0, 1]]
        }).tablesorterPager({
            container: $("#npager")
        });
    });
  </script>
  </body>
</html>
