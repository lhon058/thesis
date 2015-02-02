<?php
	session_start();
	
	if(isset($_SESSION['user_id']) && !empty($_SESSION['user_id']) && isset($_SESSION['user_type']))
	{


		switch ($_SESSION['user_type']) 
		{
			case 'student':
				header("location:form/Evaluation-Form.php");
				break;
			case 'faculty':
				# code...
				break;
			case 'admin':
				# code...
				break;
			
			default:
				# code...
				break;
		}



	}

	if(isset($_GET['redir']) && !empty($_GET['redir']))
	{
		switch ($_GET['redir']) 
		{
			case 'student_login':
			{
				include_once("Login-Students.php");
				break;
			}
			case 'faculty_login':
			{
				include_once("Login-Faculty.php");
				break;
			}
			case 'admin_login':
			{
				include_once("Login-Admin.php");
				break;
			}
				
			
			default:
				# code...
				break;
		}
	}
	else
	{
		include_once("Login-Admin.php");
	}







?>