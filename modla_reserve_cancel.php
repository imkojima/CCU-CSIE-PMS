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
<form method="post" action="<?php if($_GET['page']=="history") echo "user_history.php"; else echo "user_account.php"; ?>">
	<button type="submit" class="btn btn-danger">取消預約</button><!-- note the use of "data-dismiss" -->
	<a href="#" class="btn" data-dismiss="modal">關閉</a>
	<input class="hidden" name="action" value="done">
	<input class="hidden" name="submit" value="cancel">
	<input class="hidden" name="r_id" value="<?php echo htmlspecialchars(addslashes($_GET['r_id'])); ?>">
</form>
