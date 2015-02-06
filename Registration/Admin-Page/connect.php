<?php 
	$server = 'localhost';
	$username = 'root';
	$password = '';
	$db = 'evaluation_db';


	// connect to the database

	
		// hahaha http://stackoverflow.com/questions/11826659/catching-mysql-connection-error 
		// dagdag "@" symbol kay makuliton an warning message
		$connect = @mysqli_connect($server,$username,$password,$db);

		if(mysqli_connect_error())
		{
			$connect = mysqli_connect($server,"Mine","theone","evaluation_db");
			if(mysqli_connect_error())
			{
				echo "There is an error ";
			}


		}


mysqli_report(MYSQLI_REPORT_ERROR);
 ?>