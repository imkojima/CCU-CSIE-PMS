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
	require_once($PATH."libs/logs.php");
	require_once($PATH."libs/reserve.php");
	require_once($PATH."libs/property.php");
?>
  <h4>財產資料庫編號</h4>
  <blockquote>
    <p><?php echo getPropertyID($_GET['id']); ?></p>
  </blockquote>
  <h4>財產名稱</h4>
  <blockquote>
    <p><?php echo getPropertyName($_GET['id']); ?></p>
  </blockquote>
  <h4>狀態</h4>
  <blockquote>
    <p>
	<?php
		switch (getPropertyState($_GET['id'])) {
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

  <table class="table table-striped">
	<thead>
	  <th>#</th>
	  <th>事由</th>
	  <th>日期</th>
	</thead>
	<tbody>
<?php
	$logs = getLogsBySearch('reason','['.$_GET['id'].']');

	if (count($logs) <= 1) {
?>
	  <tr>
		<td colspan="3">沒有紀錄</td>
	  </tr>
<?php		
	}else
		for ($i=0; $i < count( $logs )-1; $i++){
?>
	  <tr>
		<td><?php echo $logs[$i]['id']; ?></td>
		<td><?php echo $logs[$i]['u_acc']; ?> - <?php echo $logs[$i]['reason']; ?></td>
		<td><?php echo $logs[$i]['time']; ?></td>
	  </tr>
<?php } ?>
	</tbody>
  </table>
