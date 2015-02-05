<?php 
$server = 'localhost';
$username = 'Mine';
$password = 'theone';
$db = 'evaluation_db';

$connect = new mysqli($server,$username,$password,$db);
mysqli_report(MYSQLI_REPORT_ERROR);
 ?>