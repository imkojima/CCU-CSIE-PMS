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
   require_once($PATH.'libs/logs.php');
?>
<!DOCTYPE html>
<html lang="zh-tw">
  <head>
    <meta charset="utf-8">
    <title>帳號管理 | CCU CSIE Property</title>
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

<?php require_once($PATH.'blocks/navbar.php'); ?>

  <div class="container">

    <section id="query-list">
      <ul class="breadcrumb">
        <li><a href="../index.php">首頁</a> <span class="divider">/</span></li>
        <li><a href="admin_portal.php">管理</a> <span class="divider">/</span></li>
        <li class="active">帳號管理</li>
  		<?php if($_GET['search']=='yes'){ ?>
		<span class="divider">-</span></li>
		<li class="active">搜尋: <?php echo htmlspecialchars(addslashes($_GET['query']));?></li>
		<?php } ?>  
      </ul>
      
      <div class="row">
        <div class="pull-left">
          <a class="offset1 btn btn-primary" href="admin_add_account.php">新增帳號</a>
        </div>

		<div class="pull-right">   
		<form class="form-search">
		  <input type="hidden" name="search" value="yes"> 
		  <select name="class" class="span2">
			<option value="full">全文</option>
			<option value="acc">帳號</option>
			<option value="name">姓名</option>
			<option value="phone">聯絡電話</option>
			<option value="mail">電子信箱</option>
		  </select>
		  <div class="input-append">
			<input type="text" name="query" class="span4 search-query" placeholder="<?php echo (htmlspecialchars(addslashes($_GET['query'])) =='')?"在找些什麼嗎？":htmlspecialchars(addslashes($_GET['query'])); ?>">
			<button type="submit" class="btn">搜尋</button>
		  </div>
		</form> 
		</div> 
      </div>
  	  <table class="table table-bordered table-striped responsive-table">
        <thead>
          <tr>
            <th width="100px">帳號</th>
            <th width="80px">姓名</th>
            <th width="60px">權限</th>
            <th width="50px">評等</th>
            <th width="130px">聯絡電話</th>
            <th>電子信箱</th>
            <th width="100px">執行</th>
          </tr>
        </thead>
        <tbody>
		<?php
/* User List Output Format Start*/
			
			if($_GET['search']=='yes')
				$users = getUserBySearch($_GET['class'], htmlspecialchars(addslashes($_GET['query']))); 
			else
				$users = getUserList();

			for($i=0;$i<count($users)-1;$i++){
				echo "
					<tr>
					  <td data-title=\"帳號\">".$users[$i]['u_acc']."</td>
					  <td data-title=\"姓名\">".$users[$i]['name']."</td>
				";					  
				echo "<td data-title=\"權限\">";
				switch($users[$i]['permission']){
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
						break;
				}
				echo "</td>";	
				echo "
		          <td data-title=\"評等\">
				";
				if($users[$i]['grade']>0)	
					echo "<span class=\"badge badge-success\">".$users[$i]['grade']."</span>";
				else
					if($users[$i]['grade']<0)
						echo "<span class=\"badge badge-important\">".$users[$i]['grade']."</span>";
					else
						echo "<span class=\"badge badge\">".$users[$i]['grade']."</span>";
                echo "
					</td>
					  <td data-title=\"聯絡電話\">".$users[$i]['phone']."</td>
					  <td data-title=\"電子信箱\">".$users[$i]['mail']."</td>
					  <td data-title=\"執行\"><div class=\"btn-group\"><a href=\"admin_account_detail.php?u_acc=".$users[$i]['u_acc']."\" role=\"button\" class=\"btn\">詳細</a><a href=\"admin_edit_account.php?u_acc=".$users[$i]['u_acc']."\" role=\"button\" class=\"btn\">編輯</a></div></td>
                    </tr>
				";
			}
/* User List Output Format End */
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
        <div class="span3"style="width:120px;"><p>共有 <span class="badge badge-info"><?php echo count($users)-1; ?></span> 筆結果</p></div>
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

  <?php
    if($_POST['submit'] == "更新") {
      echo "
      <div class=\"modal hide\" id=\"done\" role=\"dialog\">
        <div class=\"modal-header\">
          <button class=\"close\" data-dismiss=\"modal\">×</button>
          <h3>編輯帳號成功！</h3>
        </div>
        <div class=\"modal-body\">";
      echo "<h4>帳號</h4>";
      echo "<blockquote>".$_POST['u_acc']."</blockquote>";
      echo "<h4>姓名</h4>";
      echo "<blockquote>".$_POST['name']."</blockquote>";
      echo "<h4>評等</h4>";
      echo "<blockquote>".$_POST['grade']."</blockquote>";
      echo "<h4>權限</h4>";
      echo "<blockquote>".$_POST['optionsRadios']."</blockquote>";
      echo "<h4>電話</h4>";
      echo "<blockquote>".$_POST['phone']."</blockquote>";
      echo "<h4>電子信箱</h4>";
      echo "<blockquote>".$_POST['mail']."</blockquote>";
      echo "
      </div>
      <div class=\"modal-footer\">
        <a href=\"#\" class=\"btn btn-primary\" data-dismiss=\"modal\">關閉</a>
      </div>
      </div>";

      editUser($_POST['u_acc'],$_POST['name'],$_POST['grade'],$_POST['phone'],$_POST['mail'],$_POST['optionsRadios']);
	    makeLog("System", "編輯帳號 - [U:".$_POST['u_acc']."]");
    }
    elseif ($_POST['submit'] == "刪除") {
      echo "
      <div class=\"modal hide\" id=\"done\" role=\"dialog\">
        <div class=\"modal-header\">
          <button class=\"close\" data-dismiss=\"modal\">×</button>
          <h3>刪除成功！</h3>
        </div>
        <div class=\"modal-body\">";
      echo "<h4>帳號</h4>";
      echo "<blockquote>".$_POST['u_acc']."</blockquote>";
      echo "<h4>姓名</h4>";
      echo "<blockquote>".$_POST['name']."</blockquote>";
      echo "<h4>評等</h4>";
      echo "<blockquote>".$_POST['grade']."</blockquote>";
      echo "<h4>權限</h4>";
      echo "<blockquote>".$_POST['optionsRadios']."</blockquote>";
      echo "<h4>電話</h4>";
      echo "<blockquote>".$_POST['phone']."</blockquote>";
      echo "<h4>電子信箱</h4>";
      echo "<blockquote>".$_POST['mail']."</blockquote>";  
      echo "
      </div>
      <div class=\"modal-footer\">
        <a href=\"#\" class=\"btn btn-primary\" data-dismiss=\"modal\">關閉</a>
      </div>
      </div>";

      deleteUser( $_POST['u_acc'] );
	  makeLog("System", "刪除帳號 - [U:".$_POST['u_acc']."]");
    }
    elseif($_POST['submit'] == "新增"){
      echo "
      <div class=\"modal hide\" id=\"done\" role=\"dialog\">
        <div class=\"modal-header\">
          <button class=\"close\" data-dismiss=\"modal\">×</button>
          <h3>新增成功！</h3>
        </div>
        <div class=\"modal-body\">";
      echo "<h4>帳號</h4>";
      echo "<blockquote>".$_POST['u_acc']."</blockquote>";
      echo "<h4>姓名</h4>";
      echo "<blockquote>".$_POST['name']."</blockquote>";
      echo "<h4>評等</h4>";
      echo "<blockquote>".$_POST['grade']."</blockquote>";
      echo "<h4>權限</h4>";
      echo "<blockquote>".$_POST['optionsRadios']."</blockquote>";
      echo "<h4>電話</h4>";
      echo "<blockquote>".$_POST['phone']."</blockquote>";
      echo "<h4>電子信箱</h4>";
      echo "<blockquote>".$_POST['mail']."</blockquote>";  
      echo "
      </div>
      <div class=\"modal-footer\">
        <a href=\"#\" class=\"btn btn-primary\" data-dismiss=\"modal\">關閉</a>
      </div>
      </div>";
      addUser( $_POST['u_id'], $_POST['u_acc'], $_POST['name'], $_POST['grade'], $_POST['phone'], $_POST['mail'], $_POST['permission'] );
	  makeLog("System", "新增帳號 - [U:".$_POST['u_acc']."]");
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

  $("#done").on('hidden', function () {
		      location.reload();
  }); 

  $("a[data-target=#infor]").click(function(ev) {
    ev.preventDefault();
    var target = $(this).attr("href");

    // load the url and show modal on success
    $("#infor .modal-body").load(target, function() { 
        $("#infor").modal("show"); 
    });
  });

  $(document).ready(function() {
    $('table').tablesorter({
      headers: {6:{sorter:false}},
      sortList: [[0,0]]
    })
    .tablesorterPager({
      container: $("#npager")
    });
  });
  </script>
  </body>
</html>
