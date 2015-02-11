<!DOCTYPE html>
<html lang ="en">
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="style.css" type="text/css"/>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Admin</title>
</head>


<?php

			include_once("../db_connect.php");
			$query = "SELECT * FROM `instructor`";
			
			$result = $connect->query($query);
			
			if($result)
			{
			
				while($row = $result->fetch_assoc())
				{
					$instructors[] = $row;
				}
				
				
			}




?>
	<body class="body">
		<header class="mainheader">
		<img src="img/Header.jpg" alt="Welcome Admin" width="" height="">
			<nav>
				<ul>
					<li class="active"><a href="index.php">Home</a></li>
					<li><a href="">About Us</a></li>
					<li><a href="../logout.php?user_type=admin">Logout</a></li>
				</ul>
			</nav>			
		</header>
		<div class="maincontent">
			<div class="content">
				<div class="pagecontent">

						<h3> Result List </h3>
						<form action = '' name = 'select_instructor'>

							<label for = "evaluator_type" >Evalution for </label>
							<select name = "instructor">
					
					
								<?php




									if(isset($instructors) && !empty($instructors))
									{					
										foreach($instructors as $i)
										{
											$i = (object)$i;
											echo "<option value = '$i->instructorID'> $i->FName $i->LName </option>";
										}
									}
									
									
								?>
							</select>
							
							<label for = "evaluator_type" >by</label>
							<select name = 'evaluator_type'>

								<option value = 'student'> Student </option>
								<option value = 'peer'> Peer </option>
								<option value = 'self'> Self </option>
								<option value = 'supervisor'> Supervisor </option>
							
							</select>
							<input type = 'submit' name = 'submit_ins' value = 'OK'>

						</form>


						<br><br><br>

						<div >
							<?php
								if(isset($_GET) && !empty($_GET))
								{
									if(isset($_GET['instructor']) && !empty($_GET['instructor']))
									{

										$instructorID = trim($_GET['instructor']);
										$eval_type    = strtolower(trim($_GET['evaluator_type']));

										echo "<table class='bordered' border = 1> 
										      <thead> <th> Name </th> <th>Date Evaluated </th> <th>Action</th></thead>";

										switch ($eval_type) 
										{
											case 'student':
											{
												
												$query = "SELECT * FROM `evaluation_data` as ed
														  JOIN `student` as st 
														  ON `ed`.`user_id` = `st`.`studentID` 
														  WHERE `ed`.`instructorID` = $instructorID
														  AND `ed`.`evaluators_type` = 'Student' 
														  AND `ed`.`scheduleID` = 1";

												$result = $connect->query($query) or die(mysqli_error($connect));
			
												if($result)
												{
												
													while($row = $result->fetch_assoc())
													{
														$row = (object)$row;
														echo "<tr><td> $row->FName $row->LName</td>
																  <td>$row->date</td>
																  <td><a href ='../form/Evaluation-Form-Print.php?user_id=$row->user_id&action_type=view
																				&instructor=$instructorID&evaluator_type=Student
																  '> View Evaluation </a></td>
															</tr>";
													}
													
													
												}



												break;
											}
											case 'peer':
											{

												$query = "SELECT * FROM `evaluation_data` as ed
														  JOIN `instructor` as i
														  ON `ed`.`user_id` = `i`.`instructorID` 
														  WHERE `ed`.`instructorID` = $instructorID
														  AND `ed`.`evaluators_type` = 'Peer' 
														  AND `ed`.`scheduleID` = 1";

												$result = $connect->query($query) or die(mysqli_error($connect));
			
												if($result)
												{
												
													while($row = $result->fetch_assoc())
													{
														$row = (object)$row;
														echo "<tr><td> $row->FName $row->LName</td>
																  <td>$row->date</td>
																  <td><a href ='../form/Evaluation-Form-Print.php?user_id=$row->user_id&action_type=view
																				&instructor=$instructorID&evaluator_type=Peer
																  '> View Evaluation </a></td>
															</tr>";
													}
													
													
												}
												break;
											}
											case 'self':
											{
												$query = "SELECT * FROM `evaluation_data` as ed
														  JOIN `instructor` as i
														  ON `ed`.`user_id` = `i`.`instructorID` 
														  WHERE `ed`.`instructorID` = $instructorID
														  AND `ed`.`evaluators_type` = 'Self' 
														  AND `ed`.`scheduleID` = 1";

												$result = $connect->query($query) or die(mysqli_error($connect));
			
												if($result)
												{
												
													while($row = $result->fetch_assoc())
													{
														$row = (object)$row;
														echo "<tr><td> $row->FName $row->LName</td>
																  <td>$row->date</td>
																  <td><a href ='../form/Evaluation-Form-Print.php?user_id=$row->user_id&action_type=view
																				&instructor=$instructorID&evaluator_type=Self
																  '> View Evaluation </a></td>
															</tr>";
													}
													
													
												}
												break;
											}
											case 'supervisor':
											{
												$query = "SELECT * FROM `evaluation_data` as ed
														  JOIN `instructor` as i
														  ON `ed`.`user_id` = `i`.`instructorID` 
														  WHERE `ed`.`instructorID` = $instructorID
														  AND `ed`.`evaluators_type` = 'Supervisor' 
														  AND `ed`.`scheduleID` = 1";

												$result = $connect->query($query) or die(mysqli_error($connect));
			
												if($result)
												{
												
													while($row = $result->fetch_assoc())
													{
														$row = (object)$row;
														echo "<tr><td> $row->FName $row->LName</td>
																  <td>$row->date</td>
																  <td><a href ='../form/Evaluation-Form-Print.php?user_id=$row->user_id&action_type=view
																				&instructor=$instructorID&evaluator_type=Supervisor
																  '> View Evaluation </a></td>
															</tr>";
													}
													
													
												}
												break;
											}
												
											
											default:
												# code...
												break;
										}

										echo "</table>";
									}
								}

							?>

					

				</div>
			</div>

		</div>

		<aside >
			<nav>
				<ul>
					<li><a href="evaluation-schedule.php">Schedule of Evaluation</a></li>
					<li><a href="instructors-list.php">List Of Instructors</a></li>
					<li><a href="results-list.php">List Of Results</a></li>
					<li><a href="Total_Rating.php">Total Rating</a></li>
					<li><a href="kmeans.php">Performance Grouping</a></li>
				</ul>
			</nav>
		</aside>




		<footer>
			<img class="bgfooter" src="img/footerbg.jpg" alt="Decano Group" >
						
		</footer>
	</body>
</html>
