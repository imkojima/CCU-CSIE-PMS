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
	/* admin_audit.php */
	if( $_GET['action'] == "denial" ) {
		echo "
		<form method=\"post\" action=\"admin_audit.php\">
			<input type=\"submit\" class=\"btn btn-danger\" value=\"駁回預約\">
			<a href=\"#\" class=\"btn\" data-dismiss=\"modal\">關閉</a>
			<input class=\"hidden\" name=\"action\" value=\"denial\">
			<input class=\"hidden\" name=\"r_id\" value=\"".$_GET['r_id']."\">
		</form>
		";
	}
	if( $_GET['action'] == "accept" ) {
	echo "
	<form method=\"post\" action=\"admin_audit.php\">
		<input type=\"submit\" class=\"btn btn-danger\" value=\"核准\">
		<a href=\"#\" class=\"btn\" data-dismiss=\"modal\">關閉</a>
		<input class=\"hidden\" name=\"action\" value=\"accept\">
		<input class=\"hidden\" name=\"r_id\" value=\"".$_GET['r_id']."\">
	</form>
	";
	}
	if( $_GET['action'] == "lent" ) {
	echo "
	<form method=\"post\" action=\"admin_audit.php\">
		<input type=\"submit\" class=\"btn btn-danger\" value=\"已交給使用者\">
		<a href=\"#\" class=\"btn\" data-dismiss=\"modal\">關閉</a>
		<input class=\"hidden\" name=\"action\" value=\"lent\">
		<input class=\"hidden\" name=\"r_id\" value=\"".$_GET['r_id']."\">
	</form>
	";
	}
	if( $_GET['action'] == "return" ) {
	echo "
	<form method=\"post\" action=\"admin_audit.php\">
		<input type=\"submit\" class=\"btn btn-danger\" value=\"確定歸還\">
		<a href=\"#\" class=\"btn\" data-dismiss=\"modal\">關閉</a>
		<input class=\"hidden\" name=\"action\" value=\"return\">
		<input class=\"hidden\" name=\"r_id\" value=\"".$_GET['r_id']."\">
	</form>
	";
	}
	/* admin_account_detail.php */
	
	if( $_GET['action'] == "denial_edit" ) {
	echo "
	<form method=\"post\" action=\"admin_account_detail.php?u_acc=".$_GET['u_acc']."\">
		<input type=\"submit\" class=\"btn btn-danger\" value=\"取消預約\">
		<a href=\"#\" class=\"btn\" data-dismiss=\"modal\">關閉</a>
		<input class=\"hidden\" name=\"action\" value=\"denial\">
		<input class=\"hidden\" name=\"r_id\" value=\"".$_GET['r_id']."\">
	</form>
	";
	}
	if( $_GET['action'] == "accept_edit" ) {
	echo "
	<form method=\"post\" action=\"admin_account_detail.php?u_acc=".$_GET['u_acc']."\">
		<input type=\"submit\" class=\"btn btn-danger\" value=\"核准\">
		<a href=\"#\" class=\"btn\" data-dismiss=\"modal\">關閉</a>
		<input class=\"hidden\" name=\"action\" value=\"accept\">
		<input class=\"hidden\" name=\"r_id\" value=\"".$_GET['r_id']."\">
	</form>
	";
	}
	if( $_GET['action'] == "lent_edit" ) {
	echo "
	<form method=\"post\" action=\"admin_account_detail.php?u_acc=".$_GET['u_acc']."\">
		<input type=\"submit\" class=\"btn btn-danger\" value=\"已交給使用者\">
		<a href=\"#\" class=\"btn\" data-dismiss=\"modal\">關閉</a>
		<input class=\"hidden\" name=\"action\" value=\"lent\">
		<input class=\"hidden\" name=\"r_id\" value=\"".$_GET['r_id']."\">
	</form>
	";
	}
	if( $_GET['action'] == "return_edit" ) {
	echo "
	<form method=\"post\" action=\"admin_account_detail.php?u_acc=".$_GET['u_acc']."\">
		<input type=\"submit\" class=\"btn btn-danger\" value=\"確定歸還\">
		<a href=\"#\" class=\"btn\" data-dismiss=\"modal\">關閉</a>
		<input class=\"hidden\" name=\"action\" value=\"return\">
		<input class=\"hidden\" name=\"r_id\" value=\"".$_GET['r_id']."\">
	</form>
	";
	}
?>
