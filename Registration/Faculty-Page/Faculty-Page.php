<!DOCTYPE html>
<html lang ="en">
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="style.css" type="text/css"/>
	<link rel="stylesheet" href="table-design.css" type="text/css"/>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Faculty Page</title>
</head>


	<body class="body">
	
		<header class="mainheader">
		
		<img src="img/Header.jpg" alt="Welcome Admin" width="" height="">
			<nav>
				<ul>
					<?php include_once("../db_connect.php"); 

	if(!isset($_SESSION['faculty_id']) && empty($_SESSION['faculty_id']))
	{
		die("You are not logged in <a href = '../Login-Faculty.php'> Login </a> " );
	}
	$instructor_id = $_SESSION['faculty_id'];
	
	$query = "SELECT * FROM `instructor` WHERE `instructorID` = '$instructor_id'";
	
	$result = $connect->query($query) or die($connect->error);
	
	if($result)
	{
		$faculty_data = (object)$result->fetch_assoc();
		
	}

	$results = mysqli_query($connect,"SELECT * FROM schedule LIMIT 1");
	$sched = mysqli_fetch_array($results);
	$query = 
		"SELECT * FROM `evaluation_data` as ed
		 JOIN `student` as st ON
		 `st`.`studentID` = `ed`.`user_id`
		 WHERE `instructorID` = '$instructor_id'
		   AND `evaluators_type` = 'Student' 
		 AND `scheduleID` = ".$sched['scheduleID'];
	$evals = db_query($query);

?>
				<li class="active"><a href="index.php">Home</a></li>
				<li><a href="../form/Evaluation-FormFaculty.php">Evaluate</a></li>
				<li><a href="">About Us</a></li>
				<li><a href="../logout.php?user_type=faculty">Logout</a></li>
				</ul>
			</nav>			
		</header>
		
<div class="maincontent">

	<div class="content">
		<div class="pagecontent">
			<span> <?php echo "Hello ". $faculty_data->FName ." ". $faculty_data->LName ;?>

			<span style = "float:right;" > Total Evaluators :  <?php echo count($evals); ?> </span>
			</span>
			<table align="center" class="CSSTableGenerator">
				<tr>
					<td>Student Name</td>
					<td>Submitted</td>
					<td>Time/Date</td>
					<td>IP Address</td>
				</td>

			<?php
				
			if(!empty($evals))
			{

				foreach ($evals as $eval) 
				{
					$eval = (object)$eval;
					echo "<tr>
							<td>$eval->FName $eval->LName</td>
							<td>Submitted</td>
							<td>$eval->date</td>

					      </tr>";
				}

			}else
			{
				echo "<tr><td colspan= '4'>No record yet</td></tr>";
			}

			?>


				
				
			</table>
		</div>
	</div>

</div>
<footer>
	<img class="bgfooter" src="img/footerbg.jpg" alt="Decano Group" >
				
</footer>
	</body>
</html>
