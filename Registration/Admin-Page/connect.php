<?php 
$server = 'localhost';
$username = 'root';
$password = '';
$db = 'evaluation_db';

$connect = new mysqli($server,$username,$password,$db);
mysqli_report(MYSQLI_REPORT_ERROR);
 ?>