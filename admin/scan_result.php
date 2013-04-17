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
        <form class="form-horizontal" action="scan_process.php">
          <fieldset>
            <legend>條碼掃描</legend>

            <div class="control-group">
              <label class="control-label">條碼 (財產編號/學生證)</label>
              <div class="controls">
                <input id="barcode" type="text" class="input-xxlarge" name="barcode" placeholder="">
              </div>
            </div>

            <div class="control-group">
              <div class="controls">
                <button type="submit" class="btn btn-large btn-primary">確定</button>
                <button onClick="javascript:window.close();" class="btn btn-large">取消</button>
              </div>
            </div>
          </fieldset>
        </form>
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
