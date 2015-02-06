<?php
	/*
		Allows the user to both create new records and edit existing records
	*/

	// connect to the database
	include("connect.php");

	// creates the new/edit record form
 	// since this form is used multiple times in this file, I have made it a function that is easily reusable
	function renderForm($instructor = '', $start ='', $end ='', $error = '', $id = '')
	{ ?>
		<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
		<html>
			<head>	
			<meta charset="UTF-8">
			<link rel="stylesheet" href="style.css" type="text/css"/>
			<meta name="viewport" content="width=device-width, initial-scale=1.0">
				<title>
					<?php if ($id != '') { echo "Edit Record"; } else { echo "New Record"; } ?>
				</title>
				<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
			</head>
			<body class="body">
			<header class="mainheader">
					<img src="img/Header.jpg" alt="Welcome Admin" width="" height="">
						<nav>
							<ul>
							<li class="active"><a href="index.php">Home</a></li>
							<li><a href="">About Us</a></li>
							<li><a href="">Logout</a></li>
							</ul>
						</nav>			
			</header>
				
				<form action="" method="post">
				<div class="maincontent">
					<div class="content">
						<div class="pagecontent">
				<h1>
					<?php 
					if ($id != '') { echo "Edit Record"; } else { echo "New Record"; } 
					?>
				</h1>
				<?php if ($error != '') {
					echo "<div style='padding:4px; border:1px solid red; color:red'>" . $error
						. "</div>";
							} 
						?>
					<?php if ($id != ''){ ?>
						<input type="hidden" name="id" value="<?php echo $id; ?>" />
						<!--<p>ID: <?php /*echo*/ $id; ?></p>-->
					<?php } ?>
					
					<strong>Name of Instructor:&nbsp;&nbsp;</strong> <input type="text" name="instructor"
						value="<?php echo $instructor; ?>"/><br/>
					<strong>Start:</strong> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="start"
						value="<?php echo $start; ?>"/>
					<strong>End:</strong> <input type="text" name="end"
						value="<?php echo $end; ?>"/>
					
					<input type="submit" name="submit" value="Submit" />
						</div>
					</div>
				</div>
				</form>
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
		
	<?php }



        /*

           EDIT RECORD

        */
	// if the 'id' variable is set in the URL, we know that we need to edit a record
	if (isset($_GET['id']))
	{
		// if the form's submit button is clicked, we need to process the form
		if (isset($_POST['submit']))
		{
			// make sure the 'id' in the URL is valid
			if (is_numeric($_POST['id']))
			{
				// get variables from the URL/form
				$id = $_POST['id'];
				$instructor = htmlentities($_POST['instructor'], ENT_QUOTES);
				$start = htmlentities($_POST['start'], ENT_QUOTES);
				$end = htmlentities($_POST['end'], ENT_QUOTES);
				
				// check that firstname and lastname are both not empty
				if ($instructor == '' || $start == '' || $end == '')
				{
					// if they are empty, show an error message and display the form
					$error = 'ERROR: Please fill in all required fields!';
					renderForm($instructor, $start,$end , $error, $id);
				}
				else
				{
					// if everything is fine, update the record in the database
					if ($stmt = $connect->prepare("UPDATE schedule SET instructor = ?, start = ?, end = ?
						WHERE id=?"))
					{
						$stmt->bind_param("sssi", $instructor, $start, $end, $id);
						$stmt->execute();
						$stmt->close();
					}
					// show an error message if the query has an error
					else
					{
						echo "ERROR: could not prepare SQL statement.";
					}
					
					// redirect the user once the form is updated
					header("Location: evaluation-schedule.php");
				}
			}
			// if the 'id' variable is not valid, show an error message
			else
			{
				echo "Error!";
			}
		}
		// if the form hasn't been submitted yet, get the info from the database and show the form
		else
		{
			// make sure the 'id' value is valid
			if (is_numeric($_GET['id']) && $_GET['id'] > 0)
			{
				// get 'id' from URL
				$id = $_GET['id'];
				
				// get the recod from the database
				if($stmt = $connect->prepare("SELECT * FROM schedule WHERE scheduleID=?"))
				{
					$stmt->bind_param("i", $id);
					$stmt->execute();
					
					$stmt->bind_result($id, $instructor, $start , $end);
					$stmt->fetch();
					
					// show the form
					renderForm($instructor, $start, $end, NULL, $id);
					
					$stmt->close();
				}
				// show an error if the query has an error
				else
				{
					echo "Error: could not prepare SQL statement";
				}
			}
			// if the 'id' value is not valid, redirect the user back to the view.php page
			else
			{
				header("Location: evaluation-schedule.php");
			}
		}
	}



        /*

           NEW RECORD

        */
	// if the 'id' variable is not set in the URL, we must be creating a new record
	else
	{
		// if the form's submit button is clicked, we need to process the form
		if (isset($_POST['submit']))
		{
			// get the form data
				$instructor = htmlentities($_POST['instructor'], ENT_QUOTES);
				$start = htmlentities($_POST['start'], ENT_QUOTES);
				$end = htmlentities($_POST['end'], ENT_QUOTES);
			
			// check that firstname and lastname are both not empty
			if ($instructor == '' || $start == '' || $end == '')
			{
				// if they are empty, show an error message and display the form
				$error = 'ERROR: Please fill in all required fields!';
				renderForm($instructor, $start, $end, $error);
			}
			else
			{
				// insert the new record into the database
				if ($stmt = $connect->prepare("INSERT schedule (instructor, start, end) VALUES (?, ?, ?)"))
				{
					$stmt->bind_param("sss", $instructor, $start, $end);
					$stmt->execute();
					$stmt->close();
				}
				// show an error if the query has an error
				else
				{
					echo "ERROR: Could not prepare SQL statement.";
				}
				
				// redirec the user
				header("Location: evaluation-schedule.php");
			}
			
		}
		// if the form hasn't been submitted yet, show the form
		else
		{
			renderForm();
		}
	}
	
	// close the mysqli connection
	$connect->close();
?>