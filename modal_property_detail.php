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

	require_once("libs/reserve.php");
	require_once("libs/property.php");
	$id = htmlspecialchars(addslashes($_GET['id']));
?>

<div class="">
  <h4>財產名稱</h4>
  <blockquote>
    <p><?php echo getPropertyName($id)." (".getPropertyID($id).")"; ?></p>
  </blockquote>
  <h4>狀態</h4>
  <blockquote>
    <p>
	<?php
		switch (getPropertyState($id)) {
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
	?>
	</p>
  </blockquote>
</div>
