<?php
require_once("db_connect.php");

if (isset($_POST['submit'])){
	$username = trim($_POST['username']);
	$password = trim($_POST['password']);
 
 		// edit ko lang query mo
	// dri dapat padi nagagamit sin like kapag malogin or macheck sin sensitive na data
	
	// - original
	//$sql = "SELECT * from signup WHERE username LIKE '{$username}' AND password LIKE '{$password}' LIMIT 1";
	
	// - edited   
	$sql = "SELECT * FROM `signup` WHERE `username` = '$username' AND `password` = '$password'  ";
	


	$result = $connect->query($sql) or die(mysqli_error($connect));
	



	
	

	
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
				Session::flash("message","Invalid username or password");
				header("location:index.php");
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

			if($data)
			{
				$query_nxt = "UPDATE `faclogin` SET `status` = 1 
						  WHERE `instructorID` = ".$data[0]['instructorID'];
	
				$is_updated = $connect->query($query_nxt);
				


				$_SESSION['user_type'] = "faculty";
				$_SESSION['user_id'] = $data[0]['instructorID'];
					
				header("location:Faculty-Page/Faculty-Page.php");
			}
			else
			{
				Session::flash("message","Invalid username or password");
				header("location:index.php?redir=faculty_login&error=Invalid username or password");
			}

			
			

			
			
			
			
		}
		
		
	} 

	else 
	{
		$data = db_query($sql);

		if($data)
		{
			
			$_SESSION['user_type'] = "student";
			$_SESSION['user_id'] = $data[0]['studentID'];
		


	
		
			header("location:Form/Evaluation-Form.php");
		}
		else
		{

			Session::flash("message","Invalid username or password");
			header("location:index.php?redir=student_login&error=Invalid username or password");
		}
		


	} 
}
?>