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
  $PATH="../";
	require_once($PATH."auth.php");
	require_once($PATH."libs/property.php");

	if(getUserPerm($_SESSION['ccupms_acc'])!='admin') header("Location:".$PATH."index.php");

	$barcode = htmlspecialchars(addslashes($_GET['barcode']));

	$barcode = str_replace(' ','', $barcode);

	if(strlen($barcode) == 9)
		$type = "User";
	else             
		if(strlen($barcode) == 17)
			$type = "Property";
		else
			$type = "Other";
	
?>  
<!DOCTYPE html>
<html lang="zh-tw">
  <head>
    <meta charset="utf-8">
    <title>條碼掃描 | CCU CSIE Property</title>
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

  <div class="container">
    <div class="row">
	  <div class="">
		<?php 
			if($type == "User"){
				if( getUserPerm($barcode) != 'empty'){
					echo "<legend>使用者 : ".getUserName($barcode)." - ".$barcode."</legend>";
					echo "<h4>審核過待取</h4>";

					// $reserves[$i]['r_state'] == 1 審核通過 待取
					$reserves = getUserReserveAccount($barcode, 'avaliable');
					echo "<pre>";
					var_dump($reserves);
					echo "</pre>";
					//echo "<blockquote>單槍投影機(2) <button class=\"btn btn-primary\">取用</button></blockquote>";

					echo "<h4>借用中待還</h4>";

					// $reserves[$i]['r_state'] == 2 借用中
					$reserves = getUserReserveAccount($barcode, 'borrowed');
					//echo "<blockquote>無</blockquote>";
	
					echo "<center><button onClick=\"javascript:window.history.back();\" class=\"btn btn-large\">返回</button></center>";
					//找尋此學生目前所有審核過待取/借用中待還的紀錄
				}else{
					echo "此編號 ".$barcode." 不存在或無任何紀錄";
				}
			}
			if($type == "Property"){
				$pid = getPropertyIDByAcc($barcode);
				echo "<legend>物品 : ".getPropertyName($pid)."(".$pid.")</legend>";
				//找尋此物品目前狀況
				if(getPropertyState($pid) == 1){
					echo "目前此物品以借出予 ...";
					echo "<button class=\"btn btn-large btn-primary\">歸還</button>";
				}else{	
					echo "目前此物品尚未借出<hr/>";
?>
         <form class="form-horizontal" action="scan_result.php">
          <fieldset>
            <div class="control-group">
              <label class="control-label">條碼 (學生證)</label>
              <div class="controls">
                <input id="barcode" type="text" class="input-xxlarge" name="barcode" placeholder="">
              </div>
            </div>

            <div class="control-group">
              <div class="controls">
                <button type="submit" class="btn btn-large btn-primary">借出</button>
                <a onClick="javascript:window.history.back();" class="btn btn-large">取消</a>
              </div>
            </div>
          </fieldset>
        </form> 
<?php
				}
			}
			if($type == "Other"){
				echo "<legend>其他</legend>";
				echo "您輸入的是正確的編碼嗎？";
				//例外狀況
			}
		?>
      </div>
    </div>
      <div class="footer">
        <hr />
        <p>Property Management System - &#169;2012 Dept. of CSIE, National Chung Cheng University</p>
      </div>   
  </div>
  <script type="text/javascript">
     document.getElementById("barcode").focus();
  </script>
  <script type="text/javascript" src="../js/jquery.js"></script>
  <script type="text/javascript" src="../js/bootstrap.js"></script>
 </body>
</html> 

