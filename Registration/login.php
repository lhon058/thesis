<?php
require_once("db_connect.php");

if (isset($_POST['submit'])){
	$username = $_POST['username'];
	$password = $_POST['password'];
 
 		// edit ko lang query mo
	// dri dapat padi nagagamit sin like kapag malogin or macheck sin sensitive na data
	
	// - original
	//$sql = "SELECT * from signup WHERE username LIKE '{$username}' AND password LIKE '{$password}' LIMIT 1";
	
	// - edited   
	$sql = "SELECT * FROM `signup` WHERE `username` = '$username' AND `password` = $password OR `password` = '$password' ";
	


	$result = $connect->query($sql) ;
	

	
	if (!$result) 
	{

		$query = "SELECT * FROM `faclogin` WHERE `username` = '".trim($username) ."' AND `password` = '". trim($password)."'";
		
		$is_faculty = $connect->query($query);

		

		$_SESSION['faculty_id'] = $is_faculty->fetch_assoc()['instructorID'];
		if (!$is_faculty->num_rows == 1) 
		{

			$query = "SELECT * FROM `admin` WHERE `username` = '$username' AND `password` = '$password'";
			$is_admin = $connect->query($query) or die($connect->error);

			$data = db_query($query);
			
			if (!$is_admin->num_rows == 1) 
			{
				header("location:index.php?redir=admin_login&error=Invalid username or password");
			}
			else
			{
				$_SESSION['user_type'] = "admin";
				$_SESSION['user_id'] = $data[0]['admin_id'];
				header("location:Admin-Page/index.php");
				
			}
					
		}
		else
		{
			$data = db_query($query);

			$query_nxt = "UPDATE `faclogin` SET `status` = 1 
						  WHERE `instructorID` = ".$data[0]['instructorID'];
	
			$is_updated = $connect->query($query_nxt);
			

			$_SESSION['user_type'] = "faculty";
			$_SESSION['user_id'] = $data[0]['instructorID'];
				
			header("location:Faculty-Page/Faculty-Page.php");
			

			
			
			
			
		}
		
		
	} 

	else 
	{

		$data = db_query($sql);
		if($data)
		{
			$_SESSION['user_type'] = "student";
			$_SESSION['user_id'] = $data[0]['studentID'];

<<<<<<< HEAD
	
		$_SESSION['user_type'] = "student";
		$_SESSION['user_id'] = $data[0]['studentID'];

		

		header("location:Form/Evaluation-Form.php");
=======
		
			header("location:Form/Evaluation-Form.php");
		}
		else
		{

			header("location:index.php?redir=student_login&error=Invalid username or password");
		}
		

		
>>>>>>> 08a3b4830cf8e8142eff359fbda4018e970cb17f
	} 
}
?>