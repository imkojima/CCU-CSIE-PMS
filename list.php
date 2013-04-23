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

require_once "auth.php";
require_once "libs/property.php";
require_once "libs/reserve.php";
require_once "libs/logs.php";
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

  <?php include_once $PATH."blocks/navbar.php"; ?>

  <div class="container" >

    <section id="query-list">
      <ul class="breadcrumb">
        <li><a href="index.php">首頁</a> <span class="divider">/</span></li>
        <li class="active">借用</li>
    <?php if ( $_GET['search']=='yes' ) { ?>
    <span class="divider">-</span></li>
    <li class="active">搜尋: <?php echo htmlspecialchars( addslashes( $_GET['query'] ) );?></li>
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
<!--            <option value="place">地點</option>
            <option value="keeper">保管者</option> -->
          </select>
          <div class="input-append">
            <input type="text" name="query" class="span4 search-query" placeholder="<?php echo ( htmlspecialchars( addslashes( $_GET['query'] ) ) =='' )?"在找些什麼嗎？":htmlspecialchars( addslashes( $_GET['query'] ) ); ?>">
      <button type="submit" class="btn">搜尋</button>
          </div>
        </form>
      </div>

      <table class="table table-bordered table-striped responsive-table" id="property-list">
        <thead>
          <tr>
            <th width="50px">編號</th>
            <th width="300px">財產名稱</th>
            <th>描述</th>
            <th width="150px">狀態</th>
            <th width="140px">執行</th>
          </tr>
        </thead>
        <tbody>
<!-- READ Database here for list -->
<?php
if ( $_GET['search']="yes" )
  $properties = getPropertyBySearch( $_GET['class'], htmlspecialchars( addslashes( $_GET['query'] ) ) );
else
  $properties = getPropertyList();
if ( count( $properties ) <= 1 )
  echo "<tr><td colspan=\"5\">尚無記錄</td></tr>";
else
  for ( $i=0; $i < count( $properties )-1; $i++ ) {
  echo "
                <tr"; if ( $properties[$i]['p_state'] == 2 ) echo " class=\"warning\""; elseif ( $properties[$i]['p_state'] == 3 ) echo " class=\"error\""; echo ">
                  <td data-title=\"編號\">".$properties[$i]['p_id']."</td>
                  <td data-title=\"財產名稱\">".$properties[$i]['p_name']."</td>
                  <td data-title=\"描述\">".$properties[$i]['model']."</td>
              ";
  echo "<td data-title=\"狀態\">";
  switch ( $properties[$i]['p_state'] ) {
  case 0:
    echo "可預約";
    break;
  case 1:
    echo "已被借用，可預約";
    break;
  case 2:
    echo "不可預約";
    break;
  case 3:
    echo "遺失";
    break;
  default:
    echo "未知";
    break;
  }
  echo "<td data-title=\"執行\"><div class=\"btn-group\"><a "; if ( $properties[$i]['p_state'] <=1 ) echo "data-toggle=\"modal\" href=\"modal_reserve.php?p_id=".$properties[$i]['p_id']."\" data-target=\"#modal\""; echo "role=\"button\" class=\"btn btn-primary\""; if ( $properties[$i]['p_state']>1 ) echo "disabled"; echo ">預約</a><a data-toggle=\"modal\" href=\"modal_property_detail.php?id=".$properties[$i]['p_id']."\" data-target=\"#infor\" role=\"button\" class=\"btn\">詳細資訊</a></div></td>
              </tr>";
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
        <div class="span3"style="width:120px;"><p>共有 <span class="badge badge-info"><?php echo count( $properties )-1; ?></span> 筆結果</p></div>
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
  </div>
  <!--Record List Modal End-->

  <?php
    if ( $_POST['action'] == "done" ) {
      $p_id = htmlspecialchars( addslashes( $_POST['p_id'] ) );
      $p_name = htmlspecialchars( addslashes( $_POST['p_name'] ) );
      $expired_days = htmlspecialchars( addslashes( $_POST['expired_days'] ) );
      $reason = htmlspecialchars( addslashes( $_POST['reason'] ) );

      if( $expired_days == '' || $expired_days <=0 || $expired_days > 15  ) // 不滿足
        $results = "INCOMPLETE";
      else
        $results = makeReserve( $p_id, 'id', $_SESSION['ccupms_acc'], date( "Y-m-d H:i:s" ), $expired_days ,  $reason );

      echo "
          <div class=\"modal hide\" id=\"reserve_done\" role=\"dialog\">
            <div class=\"modal-header\">
              <button class=\"close\" data-dismiss=\"modal\">×</button>";

      if ( $results == "EXIST" ) {
        echo "<h3>預約失敗！</h3>";
        makeLog( $_SESSION['ccupms_acc'], "重複預約 - [".$_SESSION['ccupms_acc']."]" );
      }
      else if( $results == "INCOMPLETE" ) {
        echo "<h3>預約失敗</h3>";
      }
      else{
        echo "<h3>預約成功！</h3>";
        makeLog( $_SESSION['ccupms_acc'], "預約成功 - [".$results."]" );
      }

      echo "
            </div>
            <div class=\"modal-body\">";

      if ( $results == "EXIST" ) {
        echo "<blockquote>您已經預約過了！</blockquote>";
      }
      else if( $results == "INCOMPLETE") {
        echo "<blockquote>請您填寫正確的資料</blockquote>";
      }
      else{
        echo "<h4>借用物品</h4><blockquote>".$p_name."</blockquote>";
        echo "<h4>天數</h4><blockquote>".$expired_days."</blockquote>";
        echo "<h4>送出時間</h4><blockquote>".date( "Y-m-d H:i:s" )."</blockquote>";
        echo "<h4>理由</h4><blockquote>".$reason."</blockquote>";
      }

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
  <script type="text/javascript" src="js/jquery.validate.js"></script>
  <script type="text/javascript">
    $(window).load(function() {
        $('#reserve_done').modal('show');
    });
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
			$("#reserveForm").validate({
				rules: {
					daylimits: {
						required: true,
						digits: true
					}
				},
				highlight: function(element) {
					$(element).closest('.control-group').removeClass('success').addClass('error');
				},
				unhighlight: function(element) {
					$(element).closest('.control-group').removeClass('error').addClass('success');
				},
				errorPlacement: function (error,element){}		
			});
        });
    });
    $("#reserve_done").on('hidden', function() {
        location.reload();
    });
    $(document).ready(function() {
        $('#property-list').tablesorter({
            headers: {
                4: {
                    sorter: false
                }
            },
            sortList: [
                [0, 0]
                ]
        }).tablesorterPager({
            container: $("#npager")
        });
    });
  </script>
  </body>
</html>
