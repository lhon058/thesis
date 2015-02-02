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
			if($result)
			{
				if($result->num_rows > 0 )
					$in_table = true;
			}
				
			if($in_table)
			{
				$insert = "INSERT INTO signup (username,password,type,confirmation)
				VALUES ('$_POST[stud_id]',' $_POST[password]',' $_POST[type]','0')";

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