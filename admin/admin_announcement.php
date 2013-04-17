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
	require_once($PATH."libs/logs.php");
?>
<!DOCTYPE html>
<html lang="zh-tw">
  <head>
    <meta charset="utf-8">
    <title>公告管理 | CCU CSIE Property</title>
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

<?php include_once($PATH.'blocks/navbar.php'); ?>

  <div class="container">

    <section id="query-list">
      <ul class="breadcrumb">
        <li><a href="../index.php">首頁</a> <span class="divider">/</span></li>
        <li><a href="admin_portal.php">管理</a> <span class="divider">/</span></li>
        <li class="active">公告管理</li>
      </ul>
      
      <div class="row" style="padding-bottom:10px;">
        <div class="pull-left">
          <a class="offset1 btn btn-primary" href="admin_add_announcement.php">新增公告</a>
        </div>
      </div>

  	  <table class="table table-bordered table-striped responsive-table">
        <thead>
          <tr>
            <th width="50px">編號</th>
            <th>標題</th>
            <th width="100px">時間</th>
            <th width="80px">置頂</th>
            <th width="110px">執行</th>
          </tr>
        </thead>
        
        <tbody>
        <!-- READ Database here for list -->
<?php
		$announce = getAnnounceList();
		if(count( $announce ) <= 1)
			echo "<tr><td colspan=\"5\">尚無記錄</td></tr>";
		else
        for ($i=0; $i < count( $announce )-1; $i++) {
        
        	echo "<tr><td data-title=\"編號\">".$announce[$i]['ID']."</td>
            <td data-title=\"標題\">".$announce[$i]['title']."</td>
            <td data-title=\"時間\">".$announce[$i]['date']."</td>
            <td data-title=\"重要度\">";
            switch ($announce[$i]['pin']) {
            case 0:
              echo "一般";
              break;
            case 1:
              echo "置頂";
              break;
            default:
              echo "未知";
              break;
            }
            echo "</td>
            <td data-title=\"執行\"><div class=\"btn-group\"><a href=\"admin_edit_announcement.php?ID=".$announce[$i]['ID']."\" role=\"button\" class=\"btn\">編輯</a><a data-toggle=\"modal\" data-target=\"#an_content\" href=\"modal_announce_show.php?ID=".$announce[$i]['ID']."\" role=\"button\" class=\"btn\">檢視</a></div></td></tr>";
        }
?>
        </tbody>
      </table>
      <div class="well well-small">
        <div class="span3"style="width:120px;"><p>共有 <span class="badge badge-info"><?php echo count($announce)-1; ?></span> 筆結果</p></div>
      </div>
    </section>

    <div class="footer">
      <hr />
      <p>Property Management System - &#169;2012 Dept. of CSIE, National Chung Cheng University</p>
    </div> 
    
  </div>
  
  <?php
    if($_POST['submit'] == "Update") {
      echo "
      <div class=\"modal hide\" id=\"done\" role=\"dialog\">
        <div class=\"modal-header\">
          <button class=\"close\" data-dismiss=\"modal\">×</button>
          <h3>編輯公告成功！</h3>
        </div>
        <div class=\"modal-body\">";
      echo "<h4>標題</h4>";
      echo "<blockquote>".$_POST['title']."</blockquote>";
      echo "<h4>重要度</h4>";
      echo "<blockquote>";
      switch ($_POST['pin']) {
            case 0:
              echo "一般";
              break;
            case 1:
              echo "置頂";
              break;
            default:
              echo "未知";
              break;
      }
      echo "</blockquote>";
      echo "<h4>時間</h4>";
      echo "<blockquote>".date("Y-m-d")."</blockquote>";
      echo "<h4>內文</h4>";
      echo "<blockquote>".$_POST['content']."</blockquote>";
      echo "
      </div>
      <div class=\"modal-footer\">
        <a href=\"#\" class=\"btn btn-primary\" data-dismiss=\"modal\">關閉</a>
      </div>
      </div>";

      editAnnouncement($_POST['ID'],$_POST['title'],$_POST['pin'],$_POST['date'], $_POST['content']);
	  makeLog("System", "編輯公告 - [".$_POST['title']."]");
    }
    elseif($_POST['submit'] == "Delete"){
      echo "
      <div class=\"modal hide\" id=\"done\" role=\"dialog\">
        <div class=\"modal-header\">
          <button class=\"close\" data-dismiss=\"modal\">×</button>
          <h3>刪除成功！</h3>
        </div>
        <div class=\"modal-body\">";
      echo "<h4>標題</h4>";
      echo "<blockquote>".$_POST['title']."</blockquote>";
      echo "<h4>重要度</h4>";
      echo "<blockquote>";
      switch ($_POST['pin']) {
            case 0:
              echo "一般";
              break;
            case 1:
              echo "置頂";
              break;
            default:
              echo "未知";
              break;
      }
      echo "</blockquote>";
      echo "<h4>時間</h4>";
      echo "<blockquote>".date("Y-m-d")."</blockquote>";
      echo "<h4>內文</h4>";
      echo "<blockquote>".$_POST['content']."</blockquote>";
      echo "
      </div>
      <div class=\"modal-footer\">
        <a href=\"#\" class=\"btn btn-primary\" data-dismiss=\"modal\">關閉</a>
      </div>
      </div>";
      deleteAnnouncement( $_POST['ID'] );
      makeLog("System", "刪除公告 - [".$_POST['title']."]");
    }
    elseif($_POST['submit'] == "Add"){
      echo "
      <div class=\"modal hide\" id=\"done\" role=\"dialog\">
        <div class=\"modal-header\">
          <button class=\"close\" data-dismiss=\"modal\">×</button>
          <h3>新增成功！</h3>
        </div>
        <div class=\"modal-body\">";
      echo "<h4>標題</h4>";
      echo "<blockquote>".$_POST['title']."</blockquote>";
      echo "<h4>重要度</h4>";
      echo "<blockquote>";
      switch ($_POST['pin']) {
            case 0:
              echo "一般";
              break;
            case 1:
              echo "置頂";
              break;
            default:
              echo "未知";
              break;
      }
      echo "</blockquote>";
      echo "<h4>時間</h4>";
      echo "<blockquote>".date("Y-m-d")."</blockquote>";
      echo "<h4>內文</h4>";
      echo "<blockquote>".$_POST['content']."</blockquote>";
      echo "
      </div>
      <div class=\"modal-footer\">
        <a href=\"#\" class=\"btn btn-primary\" data-dismiss=\"modal\">關閉</a>
      </div>
      </div>";
      addAnnouncement( $_POST['title'], $_POST['pin'], date("Y-m-d"), $_POST['content'] );
      makeLog("System", "新增公告 - [".$_POST['title']."]");
	  }
?>

  <!--Record List Modal Start-->
  <div class="modal hide" id="an_content" role="dialog"><!-- note the use of "hide" class -->
    <div class="modal-header">
      <button class="close" data-dismiss="modal">×</button>
      <h3>檢視公告</h3>
    </div>
    <div class="modal-body">
      Loading...
    </div>
    <div class="modal-footer">
      <a href="#" class="btn btn-primary" data-dismiss="modal">關閉</a><!-- note the use of "data-dismiss" -->
    </div>
  </div>​
  <!--Record List Modal End-->

  <script type="text/javascript" src="../js/jquery.js"></script>
  <script type="text/javascript" src="../js/bootstrap.js"></script>
  <script type="text/javascript" src="../js/jquery.tablesorter.js"></script>
  <script type="text/javascript" src="../js/jquery.metadata.js"></script>
  <script type="text/javascript" src="../js/jquery.tablecloth.js"></script>
  <script type="text/javascript">
  $("a[data-target=#an_content]").click(function(ev) {
    ev.preventDefault();
    var target = $(this).attr("href");

    // load the url and show modal on success
    $("#an_content .modal-body").load(target, function() { 
        $("#an_content").modal("show"); 
    });
  });
  
  $(document).ready(function(){
    $(window).load(function(){
      $('#done').modal('show');
    });
  });
  
  $("#done").on('hidden', function () {
	  location.reload();
  }); 

  $(document).ready(function() {
    $('table').tablesorter({
      headers: {4:{sorter:false}},
      sortList: [[0,1]]
    });
  });
  </script>
  </body>
</html>
