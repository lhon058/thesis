<!DOCTYPE html>
<html lang ="en">
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="style.css" type="text/css"/>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Admin</title>
    <script src = "../javascript/jquery-2.1.1.min.js" ></script>
    <script src = "../javascript/jquery.print.js"></script>

    <script>

    $(document).on("click",".print_b",function(e)
    {   
    
        var parent = $(".print_home");

        parent.print();

    });


</script>

    <style>
.hide_for_print
{
    display: none;
}
@media print {
*{
    background: transparent;
    color: black !important;
    text-shadow: none !important;
    filter:none !important;
    -ms-filter: none !important;
}
.hide_for_print
{
    display: block !important;
}
a, a:visited {
    text-decoration: underline;
}

a[href]:after {
    content: " " !important;
}
abbr[title]:after {
    content: " (" attr(title) ")";
}
 .ir a:after, a[href^="javascript:"]:after, a[href^="#"]:after {
content: "";
}
pre, blockquote {
    border: 1px solid #999;
    page-break-inside: avoid;
}
thead {
    display: table-header-group;
}
tr, img {
    page-break-inside: avoid;
}
img {
    max-width: 100% !important;
}
 @page 
 {
   margin:1.5cm;
   size:8.5in 11in;
   orphans:4; 
   widows:2;

 } 

.no_print
{
    display: none !important;
}


</style>




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
		<div class="pagecontent" >
        <fieldset class="content print_home" style="width:90%; border:none;" ">
        <form >
        <a href = '#' class ='print_b no_print' style = 'float:right;' > Print </a>
			<h1 style='text-align:center;'>Rating</h1>
				
							<?php 
								// connect to the database
                        include('connect.php');

  							   if ($result = $connect->query("
                                SELECT * FROM total_rating 
                                JOIN `instructor` ON
                                `total_rating`.`instructorID` = 
                                `instructor`.`instructorID`                          
                               "))
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
                                                <th>Students</th>
                                                <th>Self</th>
                                                <th>Peer</th>
                                                <th>Supervisor</th>
                                                <th>Final Rating</th>
                                                </tr>
                                            <thead>";
                                        
                                        while ($row = $result->fetch_object())
                                        {
                                                // set up a row for each record
                                                echo "<tr>";
                                                echo "<td>" . $row->FName ." ". $row->LName . "</td>";
                                                echo "<td>" . $row->averageRatingStudent . "</td>";
                                                echo "<td>" . $row->averageRatingSelf . "</td>";
                                                echo "<td>" . $row->averageRatingPeer . "</td>";
                                                echo "<td>" . $row->averageRatingSupervisor. "</td>";

                                                if(empty($row->averageRatingStudent) || 
                                                   empty($row->averageRatingSelf) ||
                                                   empty($row->averageRatingPeer) ||
                                                   empty($row->averageRatingSupervisor) )
                                                {
                                                    echo "<td>Cannot be determined yet</td>";
                                                }
                                                else
                                                {
                                                       echo "<td>" . 

                                                        (round(
                                                            ($row->averageRatingStudent * 0.3)+
                                                            ($row->averageRatingSelf * 0.2) +
                                                            ($row->averageRatingPeer * 0.2) +
                                                            ($row->averageRatingSupervisor * 0.3),1)   

                                                         
                                                        )

                                                              ."</td>";
                                                }

                                             
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
  					</form>
                                    </fieldset>
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
