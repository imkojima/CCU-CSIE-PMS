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
  require_once($PATH.'auth.php');
  require_once($PATH.'libs/users.php');
  require_once($PATH.'libs/reserve.php');
  require_once($PATH.'libs/property.php');
  require_once($PATH.'libs/logs.php');
?>

<!DOCTYPE html>
<html lang="zh-tw">
  <head>
    <meta charset="utf-8">
    <title>系統紀錄 | CCU CSIE Property</title>
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

  <? include_once($PATH.'blocks/navbar.php'); ?>

  <div class="container" >

    <section id="query-list">
      <ul class="breadcrumb">
        <li><a href="../index.php">首頁</a> <span class="divider">/</span></li>
		<li><a href="admin_portal.php">管理</a> <span class="divider">/</span></li>
        <li class="active">系統紀錄</li>
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
            <option value="acc">行為者</option>
			<option value="reason">行為</option>
			<option value="address">IP位址</option>
			<option value="time">時間</option>
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
            <th width="150px">行為者(帳號)</th>
            <th>行為</th>
			<th width="150px">IP位址</th>
            <th width="160px">時間</th>
          </tr>
        </thead>
        <tbody>
           <?php
			if($_GET['search']=='yes')
				$logs = getLogsBySearch($_GET['class'], htmlspecialchars(addslashes($_GET['query'])));
			else
	            $logs = getLogs(-1);

            if (count($logs) <= 1) {
              echo "<tr>
                      <td colspan=\"3\">尚無記錄</td>
                    </tr>";
            }
            else {
              for ($i=0; $i < count( $logs )-1; $i++) { 
                echo "
                  <tr>
                    <td data-title=\"行為者(帳號)\">".$logs[$i]['u_acc']."</td>
                    <td data-title=\"行為\">".$logs[$i]['reason']."</td>
					<td data-title=\"IP位址\">".$logs[$i]['address']."</td>
                    <td data-title=\"時間\">".$logs[$i]['time']."</td>
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
        <div class="span3"style="width:120px;"><p>共有 <span class="badge badge-info"><?php echo count($logs)-1; ?></span> 筆結果</p></div>
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
      makeLog($_SESSION['ccupms_acc'], "取消預約 - [R:".$_POST['r_id']."]");
    }
  ?>
  <script type="text/javascript" src="../js/jquery.js"></script>
  <script type="text/javascript" src="../js/bootstrap.js"></script>
  <script type="text/javascript" src="../js/jquery.tablesorter.js"></script>
  <script type="text/javascript" src="../js/jquery.tablesorter.pager.js"></script>
  <script type="text/javascript" src="../js/jquery.metadata.js"></script>
  <script type="text/javascript" src="../js/jquery.tablecloth.js"></script>
  <script type="text/javascript">

  $(document).ready(function(){
    $(window).load(function(){
      $('#done').modal('show');
    });
  });

  $('body').on('hidden', '.modal', function () {
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
      headers: {},
      sortList: [[3,1]]
    })
    .tablesorterPager({
      container: $("#npager")
    });
  });
  </script>
  </body>
</html>
