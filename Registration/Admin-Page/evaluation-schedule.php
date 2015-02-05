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
			<h1>Schedule of Evaluation</h1>
								<form>
								<?php 
								// connect to the database
                        include('connect.php');

  							   if ($result = $connect->query("SELECT * FROM schedule ORDER BY scheduleID"))
                        {
                                // display records if there are records to display
                                if ($result->num_rows > 0)
                                {
                                        // display records in a table
                                        echo "<table class='bordered'>";
                                        
                                        // set table headers
                                        echo "<thead>
                                                <tr>
                                                <th>Name of Instructor</th>
                                                <th>Start</th>
                                                <th>End</th>
                                                <th>Edit</th>
                                                <th>Delete</th>
                                                </tr>
                                            <thead>";
                                        
                                        while ($row = $result->fetch_object())
                                        {
                                                // set up a row for each record
                                                echo "<tr>";
                                                echo "<td>" . $row->instructor . "</td>";
                                                echo "<td>" . $row->start . "</td>";
                                                echo "<td>" . $row->end . "</td>";
                                                echo "<td><a href='records.php?id=" . $row->scheduleID . "'>Edit</a></td>";
                                                echo "<td><a href='delete.php?id=" . $row->scheduleID . "'>Delete</a></td>";
                                                echo "</tr>";
                                        }
                                        
                                        echo "</table>";
                                }
                                // if there are no records in the database, display an alert message
                                else
                                {
                                        echo "No results to display!";
                                }
                        }
                         else
                        {
                                echo "Error: " . $connect->error;
                        }
                        
                        // close database connection
                        $connect->close();

                    		?>
                    		<a href="records.php">Add New Record</a>
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
