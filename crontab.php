#!/usr/bin/php -q
<?php
require_once('libs/reserve.php');

/* Crontabl Daily Script */
$reserves = getReserveList()

echo "<pre>";
print_r($reserves);
echo "</pre>";

?>
