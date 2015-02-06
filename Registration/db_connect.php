<?php
	$server = 'localhost';
	$username = 'root';
	$password = '';
	$db = 'evaluation_db';
session_start();


	// connect to the database

	
		// hahaha http://stackoverflow.com/questions/11826659/catching-mysql-connection-error 
		// dagdag "@" symbol kay makuliton an warning message
		$connect = @mysqli_connect($server,$username,$password,$db);

		if(mysqli_connect_error())
		{
			$connect = mysqli_connect($server,"Mine","theone","evaluation_db");
			session_start();
			if(mysqli_connect_error())
			{
				echo "There is an error ";
			}


		}

		
	

			
	

	// para makagamit kita na duwa kay iba an password ko



	// para qn sakali dri maimod sin iba na file - parang out of coverage baga
	$GLOBALS['db'] = $connect;

	// check if the connect is valid
	
	if(!mysqli_connect_errno())
	{
		// proceed with the operation
		// include nato an mga files na kaipuhan
		
		include("functions/database_functions.php");
		
	}
	else
	{
		
		echo "There is an error in connecting to the database";
	}



?>