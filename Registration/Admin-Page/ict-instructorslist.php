<!DOCTYPE html>
<html lang ="en">
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="style.css" type="text/css"/>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Admin</title>
</head>
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
			<p>ICT Instructor</p>
			
			<?php include_once("../db_connect.php");
			
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


			<form method = "GET" action = "../Form/Sectoral-Form.php"> 
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
				
				<select name = "evaluator_type" >
		
					<option><a href="ict-selfevaluatorlist.php">All</a></option>
					<option><a href="ict-selfevaluatorlist.php">Self</a></option>
					<option><a href="ict-evaluatorslist.php">Student</a></option>
					<option><a href="ict-peersevaluatorslist.php">Peer</a></option>
					<option><a href="ict-supervisorevaluatorslist.php">Supervisor</a></option>
					
				</select>
				<input type = "submit" name = "view_result" value = "View" >
				
			</form>
		</div>
	</div>

</div>
<aside >
<nav>
<ul>
<li><a href="evaluation-schedule.php">Schedule of Evaluation</a></li>
<li><a href="instructors-list.php">List Of Instructors</a></li>
<li><a href="results-list.php">List Of Results</a></li>
</ul>
</nav>
</aside>
<footer>
	<img class="bgfooter" src="img/footerbg.jpg" alt="Decano Group" >
				
</footer>
	</body>
</html>
