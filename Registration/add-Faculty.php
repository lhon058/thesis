<?php 
include('db_connect.php');

if (isset($_POST['submit'])){
	
	$username = $_POST['username'];

	
	$query = "SELECT * FROM `faclogin` WHERE `username` = '$username'";
	
	$result = $connect->query($query);
	$has_duplicate = false;
	
	if($result)
	{
		if($result->num_rows > 0 )
			$has_duplicate = true;
	}
	
	if($has_duplicate == false)
	{
		$_POST = (object)$_POST;
		
	
			
			$query = "SELECT * FROM `instructor` WHERE `FName` = '$_POST->FName' AND `LName` = '$_POST->LName'";
			$in_table = true;
			
			$result = $connect->query($query);
			if($result)
			{
				if($result->num_rows > 0 )
					$in_table = false;
			}
				
			if($in_table)
			{

				//insert into instructor data first
				

				$insert_instructor = "INSERT INTO `instructor` (`FName`,`MName`,`LName`,`age`,`FullName`)
									  VALUES ('$_POST->FName','$_POST->MInit','$_POST->LName',$_POST->age,
									  		  '$_POST->FName $_POST->MInit $_POST->LName')";

				
				if( mysqli_query($connect,$insert_instructor) or die(mysqli_error($connect)))
				{
					
					$query = "SELECT * FROM `instructor` WHERE `FName` = '$_POST->FName' AND `LName` = '$_POST->LName'
					 		  AND `age` = $_POST->age LIMIT 1";

					 $result = (object) db_query($query)[0];
					

					$insert = "INSERT INTO `faclogin` (instructorID,username,password,type,status)
					VALUES ($result->instructorID,'$_POST->username','$_POST->password','$_POST->type','0')";

					echo $insert;

					$addmember = mysqli_query($connect,$insert) or die(mysqli_error($connect));
					
					Header("Location:?redir=faculty_login"); 
				}
				else
				{
					echo "Invalid Inputs";
				}


				
			}
			else
			{
				echo "Duplicate Record ";
			}
			
	}
	else
	{
		echo "Duplicate Account";
	}


}
mysqli_close($connect);
 ?>