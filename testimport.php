<?php

	include_once("db_connect.php");

	include_once("Config.php");
	include_once("core/db_relationship.php");
	include_once("PDO_Mine.php");
	include_once("Importer.php");



	$db = new PDO_Mine("localhost","Mine","theone","evaluation");
	$importer = new Importer('dbBackup 20130111 1554.sql', "student","student_table");
	$importer->process_all_view();
?>