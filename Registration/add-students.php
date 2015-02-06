<?php 
include('db_connect.php');

if (isset($_POST['submit'])){
	
	$username = $_POST['stud_id'];
	
	$query = "SELECT * FROM `signup` WHERE `username` = '$username'";
	
	$result = $connect->query($query);
	$has_duplicate = false;
	
	if($result)
	{
		if($result->num_rows > 0 )
			$has_duplicate = true;
	}
	
	if($has_duplicate == false)
	{
			$no_dash = str_ireplace("-", "", $username);
		
			
			$query = "SELECT * FROM `student` WHERE `StudentNo` = '$username' OR `StudentNo` = '$no_dash'";
			$in_table = false;
			
			$result = $connect->query($query);
			$data = (object) $result->fetch_assoc();

			if($result)
			{
				if($result->num_rows > 0 )
					$in_table = true;
			}
				
			if($in_table)
			{
				$stud_id = trim($_POST['stud_id']);
				$password = trim($_POST['password']);


				$insert = "INSERT INTO signup (studentRefID,username,password,type,confirmation)
				VALUES ($data->studentID,'$stud_id','$password',' $_POST[type]','0')";

				$addmember = mysqli_query($connect,$insert) or die(mysqli_error($connect));
				
				Header("Location: Login-Students.php"); 
			}
			else
			{
				echo "Your Student Number ";
			}
			
	}
	else
	{
		echo "Duplicate Account";
	}


}
mysqli_close($connect);
 ?>