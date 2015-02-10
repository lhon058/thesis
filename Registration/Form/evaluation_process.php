<?php

if(isset($_POST))
{
	include_once("../db_connect.php");
	
	$_POST = (object)$_POST;
	$date = date("Y-m-d h:i:sa");


	
	

	if(isset($_POST->studentID))
	{
		$user_id = $_POST->studentID;
	}
	else
	{
		$user_id = $_POST->user_id;
	}


	$query = "SELECT * FROM `evaluation_data` 
	          WHERE `user_id` = $user_id 
			  
			  AND `scheduleID` = $_POST->schedule_id
			  AND `evaluators_type` = '$_POST->evaluators'
			  AND `instructorID` = $_POST->instructorID"
	          ;
	  
	 $result = $connect->query($query) or die($connect->error);
	 
	 if($result)
	 {

		if($result->num_rows > 0 )
		{
			echo "You have already evaluated for this Faculty ";
			die();
		}
	 }
	
	$query = "INSERT INTO `evaluation_data` 
			  (`user_id`,`scheduleID`,`instructorID`,`evaluators_type`,
			   `a1`,`a2`,`a3`,`a4`,`a5`,
			   `b1`,`b2`,`b3`,`b4`,`b5`,
			   `c1`,`c2`,`c3`,`c4`,`c5`,
			   `d1`,`d2`,`d3`,`d4`,`d5`,
			   `Position_of_evaluator`,
			   `date`)
			   VALUES
			   ('$user_id','$_POST->schedule_id','$_POST->instructorID','$_POST->evaluators',
			    '$_POST->a','$_POST->b','$_POST->c','$_POST->d','$_POST->e',
				'$_POST->a2','$_POST->b2','$_POST->c2','$_POST->d2','$_POST->e2',
				'$_POST->a3','$_POST->b3','$_POST->c3','$_POST->d3','$_POST->e3',
				'$_POST->a4','$_POST->b4','$_POST->c4','$_POST->d4','$_POST->e4',
				'$_POST->poe','$date'
				)";
		

	
	
	$result = $connect->query($query) or die($connect->error);
	
	if($result)
		header("location:logout_student.php");
	else
		echo "Error";
	
	

}







?>