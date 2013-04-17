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

	echo "<div class=\"thumbnail\" style=\"margin-bottom:10px;\"><legend><span class=\"badge badge-info\"><i style=\"vertical-align:baseline;\" class=\"icon-bullhorn\"></i></span> ".getAnnouncementTitle($_GET['ID'])."<div class=\"pull-right\" style=\"font-size:12px;\"><i style=\"vertical-align:baseline;\" class=\"icon-calendar\"></i>".getAnnouncementDate($_GET['ID'])."</div></legend><p>".getAnnouncementContent($_GET['ID'])."</p></div>";

?>
