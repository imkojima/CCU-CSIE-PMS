<?php

$db_host = '127.0.0.1';	//MySQL Server IP
$db_user = 'root';			//MySQL Account Name
$db_passwd = 'office107';	//MySQL Account Password
$db = "Teacher";
$teacher_dbc = mysqli_connect($db_host, $db_user, $db_passwd, $db) or die("oops! , failed to connect to database!");   // database 'TEACHER' connected

$salt = 'onichichi';

$account = $_GET['t_account'];
$passwd = md5($salt.$_GET['t_passwd']);

echo $passwd.'   ';

$query = "SELECT u_passwd FROM user WHERE u_acc = '$account'";
$result = mysqli_query($teacher_dbc,$query) or die("die here");

list($encode_passwd) = mysqli_fetch_array($result);

$encode_passwd;

if($encode_passwd == $passwd)
	echo 'match';
else
	echo 'no match';


?>