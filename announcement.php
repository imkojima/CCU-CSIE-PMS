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
	require_once("auth.php");
	require_once("libs/announce.php");
?>
<!DOCTYPE html>
<html lang="zh-tw">
  <head>
    <meta charset="utf-8">
    <title>公告 | CCU CSIE Property</title>
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

<?php include_once('blocks/navbar.php'); ?>

  <div class="container" >
      
    <section id="query-list">
      <ul class="breadcrumb">
        <li><a href="index.php">首頁</a> <span class="divider">/</span></li>
        <li><a href="#">公告</a> <span class="divider">/</span></li>
        <li class="active">公告列表</li>
      </ul>
      
      <div class="row">
      	<div class="span8 offset2">
      
    <!-- READ Database here for list -->
<?php
		$announce = getAnnounceList();
		if(count( $announce ) <= 1)
			echo "<tr><td colspan=\"5\">尚無記錄</td></tr>";
		else
        for ($i=0; $i < count( $announce )-1; $i++) {
          echo "<div class=\"thumbnail\" style=\"margin-bottom:10px;\"><legend><span class=\"badge badge-info\"><i style=\"vertical-align:baseline;\" class=\"icon-bullhorn\"></i></span> ".$announce[$i]['title']."<div class=\"pull-right\" style=\"font-size:12px;\"><i style=\"vertical-align:baseline;\" class=\"icon-calendar\"></i>".$announce[$i]['date']."</div></legend><p>".$announce[$i]['content']."</p></div>";
        }
?>
      	</div>
      </div>
    </section>

    <div class="footer">
      <hr />
      <p>Property Management System - &#169;2012 Dept. of CSIE, National Chung Cheng University</p>
    </div> 
    
  </div>

  <!--Record List Modal Start-->
  <div class="modal hide" id="infor" role="dialog"><!-- note the use of "hide" class -->
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

  <!--Record List Modal Start-->
  <div class="modal hide" id="modal" role="dialog"><!-- note the use of "hide" class -->
    <div class="modal-header">
      <button class="close" data-dismiss="modal">×</button>
      <h3>預約借用</h3>
    </div>
    <div class="modal-body">
      Loading...
    </div>
    <div class="modal-footer">
      <a href="#" class="btn btn-primary" data-dismiss="modal">關閉</a><!-- note the use of "data-dismiss" -->
    </div>
  </div>​
  <!--Record List Modal End-->

  <script type="text/javascript" src="js/jquery.js"></script>
  <script type="text/javascript" src="js/bootstrap.js"></script>
  <script type="text/javascript" src="js/jquery.tablesorter.js"></script>
  <script type="text/javascript" src="js/jquery.metadata.js"></script>
  <script type="text/javascript" src="js/jquery.tablecloth.js"></script>
  <script type="text/javascript">

  $("a[data-target=#infor]").click(function(ev) {
    ev.preventDefault();
    var target = $(this).attr("href");

    // load the url and show modal on success
    $("#infor .modal-body").load(target, function() { 
        $("#infor").modal("show"); 
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
    $('#table_list').tablesorter({
      headers: {5:{sorter:false}},
      sortList: [[0,0]]
    });
  });
  </script>
  </body>
</html>
