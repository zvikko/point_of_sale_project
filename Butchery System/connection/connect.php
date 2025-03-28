<?php
$mysql_host = 'localhost';
$mysql_user = 'root';
$mysql_password = '';
$db = 'butchery_store';

$sq = mysqli_connect("$mysql_host", "$mysql_user", "$mysql_password") or die("Not connected");
mysqli_select_db($sq, $db);
$today = date('d/m/Y');
