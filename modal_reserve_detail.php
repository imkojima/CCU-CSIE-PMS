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
	$reserve = getReserveByRID(htmlspecialchars(addslashes($_GET['r_id'])));
?>

<div class="">
  <h4>預約編號</h4>
    <blockquote>
      <p><?php echo $reserve['']['r_id']; ?></p>
    </blockquote>
  <h4>財產名稱</h4>
  <blockquote>
    <p><?php echo getPropertyName($reserve['']['p_id'])." (".$reserve['']['p_id'].")"; ?></p>
  </blockquote>
  <h4>預約時間</h4>
  <blockquote>
    <p><?php echo $reserve['']['r_date']; ?></p>
  </blockquote>
  <h4>預約有效日期</h4>
  <blockquote>
    <p>剩下 <span class="badge badge-important"><?php echo $reserve['']['r_days']; ?></span> 天</p>
  </blockquote>
  <h4>借用原因</h4>
  <blockquote>
    <p><?php echo $reserve['']['r_reason']; ?></p>
  </blockquote>

  <h4>狀態</h4>
  <blockquote>
    <p>
	<?php
		switch ($reserve['']['r_state']) {
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
	?>
	</p>
  </blockquote>
</div>
