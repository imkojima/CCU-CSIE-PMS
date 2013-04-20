#!/usr/bin/php -q
<?php
require_once('libs/reserve.php');

/* Crontabl Daily Script */
$reserves = getReserveList();

for($i=0;$i<count($reserves)-1;$i++){
	if($reserves[$i]['r_state']==1){
		echo "->"$reserves[$i]['u_id']." - ".$reserves[$i]['r_days']."<br />";
	}
}

echo "<pre>";
print_r($reserves);
echo "</pre>";

?>
