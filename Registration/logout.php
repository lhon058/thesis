<?php

	include_once("db_connect.php");

	if(isset($_GET['user_type']) && !empty($_GET['user_type']))
		{
			switch ($_GET['user_type']) 
			{
				case 'faculty':
				{
					session_destroy();
					header("location:index.php?redir=faculty_login");
					break;
				}
					
				
				default:
					# code...
					break;
			}
		}
	
	if(isset($_SESSION['user_id']) && !empty($_SESSION['user_id']))
	{
		
		session_destroy();
	}
	
	
	

?>