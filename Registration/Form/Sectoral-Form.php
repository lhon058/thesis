<!DOCTYPE html>
<html lang ="en">
<head>
<meta charset="UTF-8">
<link rel="stylesheet" href="secoral.css" type="text/css"/>
<title>Sectorial Form</title>


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
p, h2, h3 {
	orphans: 3;
	widows: 3;
}
h2, h3 {
	page-break-after: avoid;
}
table:before 
{ 
	/*content: url("../image_core/ssc-a.png");*/
	position: fixed;left:100%;top:100%;opacity:0.1; 
	margin-left:100px;
}
table:nth-child(odd)
{
	margin-top: 3%;
	margin-bottom: 5% !important;
}

table:nth-child(even)
{
	margin-bottom: 3% !important;
}
table tr td,table th
{
	font-size: 14px !important;
	white-space: pre;
	padding:0px !important;
}
fieldset
{
	border:none !important;

}
table
{
	margin: 0% !important;
	
	border:none !important;
}
table:last-child
{
	margin-bottom: 0% !important;
}
table { page-break-inside : avoid }

}

</style>

</head>
<body>
<form>

<?php
	$average_data = array
					(
						'Student','Self','Peer','Supervisor'
					);
	
	if(isset($_GET) && !empty($_GET))
	{



		include_once("../db_connect.php");
		$instructor_id = $_GET['instructor'];

		$query = "SELECT * FROM `instructor` WHERE `instructorID` = $instructor_id";

		$instructor_data = (object) db_query($query)[0];
		
		$loop = 1;
		$done = false;
		$average = "";
		$update = "";
		$text = "";
		$fields = array();


		if($_GET['evaluator_type'] == 'All')
		{

			$loop = 4;
		}


		 $schedule = "SELECT * FROM `schedule` ORDER BY `scheduleID` DESC LIMIT 1 ";

		 $schedule = (object) db_query($schedule)[0];

		for($dcount=0; $dcount < $loop; $dcount++) 
		{ 

			$total_eval = "";


			if(trim($_GET['evaluator_type']) == 'All')
			{
				$evaluator_type = $average_data[$dcount];
			}
			else
				$evaluator_type = $_GET['evaluator_type'];
			

			$query = "SELECT * FROM `evaluation_data` 
			          WHERE `instructorID` = '$instructor_id'
					  AND `evaluators_type` = '$evaluator_type'
					  AND `scheduleID` = $schedule->scheduleID";


			
					  
			$result = $connect->query($query) or die($connect->error);

			$data = "";
			if($result)
			{

				while($row = $result->fetch_assoc())
				{

					$data[] = $row;
				}
			}
			


			$no_of_eval = count($data);	

			$total_eval[] = array();

				
			if(isset($data) && !empty($data))
			{

					$fA = "";$fB="";$fC="";$fD="";
					foreach($data as $dt)
					{
						$count = "1";
						$dt = (object)$dt;
						$a = ""; $b = ""; $c = ""; $d ="";
						for($i = 1; $i <= 5; $i++)
						{
							$Avar = "a{$i}";
							$Bvar = "b{$i}";
							$Cvar = "c{$i}";
							$Dvar = "d{$i}";
						
							$a[] = $dt->$Avar;
							$b[] = $dt->$Bvar;
							$c[] = $dt->$Cvar;
							$d[] = $dt->$Dvar;
							
							$count++;
						}
					
						$fA[] = $a;
						$fB[] = $b;
						$fC[] = $c;
						$fD[] = $d;
					
					}

					
					/*echo "<pre>".print_r($fA,true);
					echo "<pre>".print_r($fB,true);
					echo "<pre>".print_r($fC,true);
					echo "<pre>".print_r($fD,true);*/

					$total_varA = 0;$total_varB = 0;
					$total_varC = 0;$total_varD = 0;

					$final_resultA = 0;$final_resultB = 0;
					$final_resultC = 0;$final_resultD = 0;
					$seg_resultA = 0; $seg_resultB = 0;
					$seg_resultC = 0; $seg_resultD = 0;



					
					$seg_resultA = seg_result($fA);
					$final_resultA = analyze_result($seg_resultA);
					
					$seg_resultB = seg_result($fB);
					$final_resultB = analyze_result($seg_resultB);
					
					$seg_resultC = seg_result($fC);
					$final_resultC = analyze_result($seg_resultC);
					
					$seg_resultD = seg_result($fD);
					$final_resultD = analyze_result($seg_resultD);




				
					 $varA = compute_result($final_resultA[0],$no_of_eval);
					 $varA1 = compute_result($final_resultA[1],$no_of_eval);
					 $varA2 = compute_result($final_resultA[2],$no_of_eval);
					 $varA3 = compute_result($final_resultA[3],$no_of_eval);
					 $varA4 = compute_result($final_resultA[4],$no_of_eval);
					 $total_varA = ($varA+$varA1+$varA2+$varA3+$varA4)/5;



					 $varB = compute_result($final_resultB[0],$no_of_eval);
					 $varB1 = compute_result($final_resultB[1],$no_of_eval);
					 $varB2 = compute_result($final_resultB[2],$no_of_eval);
					 $varB3 = compute_result($final_resultB[3],$no_of_eval);
					 $varB4 = compute_result($final_resultB[4],$no_of_eval);
					 $total_varB = ($varB+$varB1+$varB2+$varB3+$varB4)/5;
					 
					 $varC = compute_result($final_resultC[0],$no_of_eval);
					 $varC1 = compute_result($final_resultC[1],$no_of_eval);
					 $varC2 = compute_result($final_resultC[2],$no_of_eval);
					 $varC3 = compute_result($final_resultC[3],$no_of_eval);
					 $varC4 = compute_result($final_resultC[4],$no_of_eval);
					 $total_varC = ($varC+$varC1+$varC2+$varC3+$varC4)/5;
					
					 $varD = compute_result($final_resultD[0],$no_of_eval);
					 $varD1 = compute_result($final_resultD[1],$no_of_eval);
					 $varD2 = compute_result($final_resultD[2],$no_of_eval);
					 $varD3 = compute_result($final_resultD[3],$no_of_eval); 
					 $varD4 = compute_result($final_resultD[4],$no_of_eval); 
					 $total_varD = ($varD+$varD1+$varD2+$varD3+$varD4)/5; 

				

					 $total_varA = $total_varA * 0.25;
					 $total_varB = $total_varB * 0.25;
					 $total_varC = $total_varC * 0.25;
					 $total_varD = $total_varD * 0.25;

					 $total_all = $total_varA + $total_varB + $total_varC + $total_varD;

			 		$final_query = "";
			 	
			 		if(empty($total_all)) $total_all = 0;
			 		

			 	
			 		$average[] = $total_all;
			 		$text .= "`averageRating".$evaluator_type."`=".$total_all.",";
			 		$fields[] = $evaluator_type;

			 		
			 		$update= $text;

					 		
			 		 $query = "SELECT * FROM `total_rating` WHERE `scheduleID` = $schedule->scheduleID 
					 		   AND `instructorID` = $instructor_id";


					 if($result = mysqli_query($connect,$query) or die(mysqli_error()))
					 {	

					 		if($result->num_rows  == 0 && $dcount == $loop-1)
					 		{

					 			$average = implode(",", $average);
					 			
					 			
					 			
					 			$final_query = "INSERT INTO `total_rating` 
					 					  (`scheduleID`,`instructorID`,`averageRatingStudent`,`averageRatingSelf`,
					 					  	`averageRatingPeer`,`averageRatingSupervisor`)
										   VALUES ($schedule->scheduleID,$instructor_id,$average)";
								//echo $final_query;
								if($result = mysqli_query($connect,$final_query) or die(mysqli_error($connect)))
						 		{
						 			
						 		}
					 			//echo $query;
					 		}
					 		else if($result->num_rows > 0 && $dcount == $loop-1)
					 		{
					 			
					 			$pos = strripos($update,",");
					 			$update = substr($update,0, $pos);
					 		
					 			

					 			$final_query = "UPDATE `total_rating` SET  
					 					  $update WHERE `scheduleID` = $schedule->scheduleID 
					 					  AND `instructorID` = $instructor_id";

					 			if($result = mysqli_query($connect,$final_query))
						 		{
						 			
						 		}
					 		}

					 	
					 		

					 }
					 

		}
		else
		{

			 $query = "SELECT * FROM `total_rating` WHERE `scheduleID` = $schedule->scheduleID 
					 		   AND `instructorID` = $instructor_id";


			 if($result = mysqli_query($connect,$query) or die(mysqli_error()))
			 {	

			 		if($result->num_rows  == 0 && is_array($average))
			 		{

			 			$average = implode(",", $average);
			 			$fields = "`averageRating".implode("`,`averageRating",$fields)."`";

			 			
			 			$final_query = "INSERT INTO `total_rating` 
			 					  (`scheduleID`,`instructorID`,$fields)
								   VALUES ($schedule->scheduleID,$instructor_id,$average)";

						//echo $final_query;
			 			if($result = mysqli_query($connect,$final_query) or die(mysql_error()))
				 		{


				 			//continue;
				 		}
				 		
			 		}
			 		else if($result->num_rows > 0 && is_array($average))
			 		{
			 			$pos = strripos($update,",");
			 			$update = substr($update,0, $pos);


			 			
			 			

			 			$final_query = "UPDATE `total_rating` SET  
			 					  $update WHERE `scheduleID` = $schedule->scheduleID 
			 					  AND `instructorID` = $instructor_id";
			 			
				 		if($result = mysqli_query($connect,$final_query) or die(mysql_error()))
				 		{
				 			//continue;
				 		}
			 		}
			 	
			 		

			 }
			
		}
			
		
			
		
			
			
		}
	}
	else
	{
		die("No records Found");
	}

function seg_result($result = array())
{
	$f_result = (object)array
				(
					"question1" => array(),
					"question2" =>  array(),
					"question3" =>  array(),
					"question4" =>  array(),
					"question5" =>  array()
				);
	foreach($result as $res)
	{
		$f_result->question1[] = $res[0];
		$f_result->question2[] = $res[1];
		$f_result->question3[] = $res[2];
		$f_result->question4[] = $res[3];
		$f_result->question5[] = $res[4];
	}
	
	return $f_result;
}
function compute_result($result = array(),$no_of_eval)
{
	$answer = ( $result->count5 * 5  )+
			  ( $result->count4 * 4  )+
			  ( $result->count3 * 3  )+
			  ( $result->count2 * 2  )+
			  ( $result->count1 * 1  );
			  
	
	$answer = $answer / $no_of_eval;
	
	
	return $answer;

}
function analyze_result($result = array())
{
	$f_result = array();
	
				
	
				
	foreach($result as $res)
	{
		$s_result = (object)array
				(
					"count5" => 0,
					"count4" => 0,
					"count3" => 0,
					"count2" => 0,
					"count1" => 0
				);
		
		//echo "<pre>".print_r($res,true);
		foreach($res as $r)
		{
			switch($r)
			{
				case "5":
				{
					$s_result->count5++;
					break;
				}
				case "4":
				{
					$s_result->count4++;
					break;
				}
				
				case "3":
				{
					$s_result->count3++;
					break;
				}
				case "2":
				{
					$s_result->count2++;
					break;
				}
				
				case "1":
				{
					$s_result->count1++;
					break;
				}
				default:
				{
				
				}
			};
		}
		
		$f_result[] = $s_result;
		
		
	}
	
	return $f_result;
}
	
?>


<header>
	<h5 >SECTORAL FREQUENCY OF RATING AREA<br>

					   FOR INSTRUCTORS,ASSISTANT PROFESSOR<br>
					   AND ASSOCIATE PROFESSORS AND FULL PROFESSORS<br>
					   SECTORAL EVALUATOR: <input disabled name="#" type="text" value = "<?php echo $evaluator_type; ?>">
					   <!--Padi dine sa sectoral evaluator an apat ini an 
					   student,supervisor,peer,self-->
</h5>
</header><br>
<fieldset class="content print_home" style="width:100%;" >
<div class = 'hide_for_print'>
	
	<span> Evaluator Type  : <?php echo $_GET['evaluator_type']; ?></span><br>
	<span> Instructor Name  : <?php echo $instructor_data->FullName; ?></span>

</div>

<table class="bordered ">
		<thead> 
				<h5 >I. COMMITMENT <a href = '#' class ='print_b no_print' style = 'float:right;' > Print </a></h5>
		</thead>
		<tr>
			
			<td rowspan="2">CRITERIA NUMBER</td>
			<td colspan="5">RATING SCALE (1=lowest,5=highest)</td>
			<td rowspan="2">AVERAGE RATING</td>

		</tr>
		<tr>
			<td>5</td>
			<td>4</td>
			<td>3</td>
			<td>2</td>
			<td>1</td>
			
		</tr>
		
		<!--  Start -->
		<tr>
			<td>1</td>
			
			<td><?php echo $final_resultA[0]->count5;?></td>
			<td><?php echo $final_resultA[0]->count4;?></td>
			<td><?php echo $final_resultA[0]->count3;?></td>
			<td><?php echo $final_resultA[0]->count2;?></td>
			<td><?php echo $final_resultA[0]->count1;?></td>
			
			
			<!-- Average Rating -->
			<td><?php echo $varA = compute_result($final_resultA[0],$no_of_eval); ?></td>
			
		</tr>
		<tr>
			<td>2</td>
			<td><?php echo $final_resultA[1]->count5;?></td>
			<td><?php echo $final_resultA[1]->count4;?></td>
			<td><?php echo $final_resultA[1]->count3;?></td>
			<td><?php echo $final_resultA[1]->count2;?></td>
			<td><?php echo $final_resultA[1]->count1;?></td>
			
			<td><?php echo $varA1 = compute_result($final_resultA[1],$no_of_eval); ?></td>
			
		</tr>
		<tr>
			<td>3</td>
			<td><?php echo $final_resultA[2]->count5;?></td>
			<td><?php echo $final_resultA[2]->count4;?></td>
			<td><?php echo $final_resultA[2]->count3;?></td>
			<td><?php echo $final_resultA[2]->count2;?></td>
			<td><?php echo $final_resultA[2]->count1;?></td>
			<td><?php echo $varA2 = compute_result($final_resultA[2],$no_of_eval); ?></td>
			
		</tr>
		<tr>
			<td>4</td>
			<td><?php echo $final_resultA[3]->count5;?></td>
			<td><?php echo $final_resultA[3]->count4;?></td>
			<td><?php echo $final_resultA[3]->count3;?></td>
			<td><?php echo $final_resultA[3]->count2;?></td>
			<td><?php echo $final_resultA[3]->count1;?></td>
			<td><?php echo $varA3 = compute_result($final_resultA[3],$no_of_eval); ?></td>
			
		</tr>
		<tr>
			<td>5</td>
			<td><?php echo $final_resultA[4]->count5;?></td>
			<td><?php echo $final_resultA[4]->count4;?></td>
			<td><?php echo $final_resultA[4]->count3;?></td>
			<td><?php echo $final_resultA[4]->count2;?></td>
			<td><?php echo $final_resultA[4]->count1;?></td>
			<td><?php echo $varA4 = compute_result($final_resultA[4],$no_of_eval); ?></td>
			
		</tr>
		<tr>
			<td colspan="6">TOTAL AREA RATING</td>
			<td><?php echo  ($varA+$varA1+$varA2+$varA3+$varA4)/5; ?></td>
			
		</tr>

</table>
<!--Knowledge-->
<table class="bordered">
		<thead> 
				<h5>II. KNOWLEDGE OF SUBJECT</h5>
		</thead>
		<tr>
			
			<td rowspan="2">CRITERIA NUMBER</td>
			<td colspan="5">RATING SCALE (1=lowest,5=highest)</td>
			<td rowspan="2">AVERAGE RATING</td>

		</tr>
		<tr>
			<td>5</td>
			<td>4</td>
			<td>3</td>
			<td>2</td>
			<td>1</td>
			
		</tr>
		<tr>
			<td>1</td>
			<td><?php echo $final_resultB[0]->count5;?></td>
			<td><?php echo $final_resultB[0]->count4;?></td>
			<td><?php echo $final_resultB[0]->count3;?></td>
			<td><?php echo $final_resultB[0]->count2;?></td>
			<td><?php echo $final_resultB[0]->count1;?></td>
			<td><?php echo $varB = compute_result($final_resultB[0],$no_of_eval); ?></td>
			
		</tr>
		<tr>
			<td>2</td>
			<td><?php echo $final_resultB[1]->count5;?></td>
			<td><?php echo $final_resultB[1]->count4;?></td>
			<td><?php echo $final_resultB[1]->count3;?></td>
			<td><?php echo $final_resultB[1]->count2;?></td>
			<td><?php echo $final_resultB[1]->count1;?></td>
			<td><?php echo $varB1 = compute_result($final_resultB[1],$no_of_eval); ?></td>
			
		</tr>
		<tr>
			<td>3</td>
			<td><?php echo $final_resultB[2]->count5;?></td>
			<td><?php echo $final_resultB[2]->count4;?></td>
			<td><?php echo $final_resultB[2]->count3;?></td>
			<td><?php echo $final_resultB[2]->count2;?></td>
			<td><?php echo $final_resultB[2]->count1;?></td>
			<td><?php echo $varB2 = compute_result($final_resultB[2],$no_of_eval); ?></td>
			
		</tr>
		<tr>
			<td>4</td>
			<td><?php echo $final_resultB[3]->count5;?></td>
			<td><?php echo $final_resultB[3]->count4;?></td>
			<td><?php echo $final_resultB[3]->count3;?></td>
			<td><?php echo $final_resultB[3]->count2;?></td>
			<td><?php echo $final_resultB[3]->count1;?></td>
			<td><?php echo $varB3 = compute_result($final_resultB[3],$no_of_eval); ?></td>
			
		</tr>
		<tr>
			<td>5</td>
			<td><?php echo $final_resultB[4]->count5;?></td>
			<td><?php echo $final_resultB[4]->count4;?></td>
			<td><?php echo $final_resultB[4]->count3;?></td>
			<td><?php echo $final_resultB[4]->count2;?></td>
			<td><?php echo $final_resultB[4]->count1;?></td>
			<td><?php echo $varB4 = compute_result($final_resultB[4],$no_of_eval); ?></td>
			
		</tr>
		<tr>
			<td colspan="6">TOTAL AREA RATING</td>
			<td><?php  echo 	 ($varB+$varB1+$varB2+$varB3+$varB4)/5 ?></td>
			
		</tr>

</table>
<!--Teaching-->
<table class="bordered">
		<thead> 
				<h5>III. TEACHING FOR INDEPENDENT LEARNING</h5>
		</thead>
		<tr class="style">
			
			<td rowspan="2">CRITERIA NUMBER</td>
			<td colspan="5">RATING SCALE (1=lowest,5=highest)</td>
			<td rowspan="2">AVERAGE RATING</td>

		</tr>
		<tr>
			<td>5</td>
			<td>4</td>
			<td>3</td>
			<td>2</td>
			<td>1</td>
			
		</tr>
		<tr>
			<td>1</td>
			<td><?php echo $final_resultC[0]->count5;?></td>
			<td><?php echo $final_resultC[0]->count4;?></td>
			<td><?php echo $final_resultC[0]->count3;?></td>
			<td><?php echo $final_resultC[0]->count2;?></td>
			<td><?php echo $final_resultC[0]->count1;?></td>
			<td><?php echo $varC = compute_result($final_resultC[0],$no_of_eval); ?></td>
			
		</tr>
		<tr>
			<td>2</td>
			<td><?php echo $final_resultC[1]->count5;?></td>
			<td><?php echo $final_resultC[1]->count4;?></td>
			<td><?php echo $final_resultC[1]->count3;?></td>
			<td><?php echo $final_resultC[1]->count2;?></td>
			<td><?php echo $final_resultC[1]->count1;?></td>
			<td><?php echo $varC1 = compute_result($final_resultC[1],$no_of_eval); ?></td>
			
		</tr>
		<tr>
			<td>3</td>
			<td><?php echo $final_resultC[2]->count5;?></td>
			<td><?php echo $final_resultC[2]->count4;?></td>
			<td><?php echo $final_resultC[2]->count3;?></td>
			<td><?php echo $final_resultC[2]->count2;?></td>
			<td><?php echo $final_resultC[2]->count1;?></td>
			<td><?php echo $varC2 = compute_result($final_resultC[2],$no_of_eval); ?></td>
			
		</tr>
		<tr>
			<td>4</td>
			<td><?php echo $final_resultC[3]->count5;?></td>
			<td><?php echo $final_resultC[3]->count4;?></td>
			<td><?php echo $final_resultC[3]->count3;?></td>
			<td><?php echo $final_resultC[3]->count2;?></td>
			<td><?php echo $final_resultC[3]->count1;?></td>
			<td><?php echo $varC3 = compute_result($final_resultC[3],$no_of_eval); ?></td>
			
		</tr>
		<tr>
			<td>5</td>
			<td><?php echo $final_resultC[4]->count5;?></td>
			<td><?php echo $final_resultC[4]->count4;?></td>
			<td><?php echo $final_resultC[4]->count3;?></td>
			<td><?php echo $final_resultC[4]->count2;?></td>
			<td><?php echo $final_resultC[4]->count1;?></td>
			<td><?php echo $varC4 = compute_result($final_resultC[4],$no_of_eval); ?></td>
			
		</tr>
		<tr>
			<td colspan="6">TOTAL AREA RATING</td>
			<td><?php  echo 	  ($varC+$varC1+$varC2+$varC3+$varC4)/5 ?></td>
			
		</tr>

</table>
<!--management-->
<table class="bordered">
		<thead> 
				<h5>IV. MANAGEMENT OF LEARNIGN</h5>
		</thead>
		<tr>
			
			<td rowspan="2">CRITERIA NUMBER</td>
			<td colspan="5">RATING SCALE (1=lowest,5=highest)</td>
			<td rowspan="2">AVERAGE RATING</td>

		</tr>
		<tr>
			<td>5</td>
			<td>4</td>
			<td>3</td>
			<td>2</td>
			<td>1</td>
			
		</tr>
		<tr>
			<td>1</td>
			<td><?php echo $final_resultD[0]->count5;?></td>
			<td><?php echo $final_resultD[0]->count4;?></td>
			<td><?php echo $final_resultD[0]->count3;?></td>
			<td><?php echo $final_resultD[0]->count2;?></td>
			<td><?php echo $final_resultD[0]->count1;?></td>
			<td><?php echo $varD = compute_result($final_resultD[0],$no_of_eval); ?></td>
			
		</tr>
		<tr>
			<td>2</td>
			<td><?php echo $final_resultD[1]->count5;?></td>
			<td><?php echo $final_resultD[1]->count4;?></td>
			<td><?php echo $final_resultD[1]->count3;?></td>
			<td><?php echo $final_resultD[1]->count2;?></td>
			<td><?php echo $final_resultD[1]->count1;?></td>
			<td><?php echo $varD1 = compute_result($final_resultD[1],$no_of_eval); ?></td>
			
		</tr>
		<tr>
			<td>3</td>
			<td><?php echo $final_resultD[2]->count5;?></td>
			<td><?php echo $final_resultD[2]->count4;?></td>
			<td><?php echo $final_resultD[2]->count3;?></td>
			<td><?php echo $final_resultD[2]->count2;?></td>
			<td><?php echo $final_resultD[2]->count1;?></td>
			<td><?php echo $varD2 = compute_result($final_resultD[2],$no_of_eval); ?></td>
			
		</tr>
		<tr>
			<td>4</td>
			<td><?php echo $final_resultD[3]->count5;?></td>
			<td><?php echo $final_resultD[3]->count4;?></td>
			<td><?php echo $final_resultD[3]->count3;?></td>
			<td><?php echo $final_resultD[3]->count2;?></td>
			<td><?php echo $final_resultD[3]->count1;?></td>
			<td><?php echo $varD3 = compute_result($final_resultD[3],$no_of_eval); ?></td>
			
		</tr>
		<tr>
			<td>5</td>
			<td><?php echo $final_resultD[4]->count5;?></td>
			<td><?php echo $final_resultD[4]->count4;?></td>
			<td><?php echo $final_resultD[4]->count3;?></td>
			<td><?php echo $final_resultD[4]->count2;?></td>
			<td><?php echo $final_resultD[4]->count1;?></td>
			<td><?php echo $varD4 = compute_result($final_resultD[4],$no_of_eval); ?></td>
			
		</tr>
		<tr>
			<td colspan="6">TOTAL AREA RATING</td>
			<td><?php  echo 	  ($varD+$varD1+$varD2+$varD3+$varD4)/5 ?></td>
			
		</tr>

</table>

<?php

	$query = "INSERT INTO `total_rating` "
	

?>

<footer class = "no_print">
	<tr>
	<td>Rater:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input class = "no_print" name="Rater" type="text" ></input></td><br>
	<td>Position:&nbsp;&nbsp;&nbsp;<input name="position" type="text" ></input></td><br>
	</td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<td>
	Dean/Director:<input name="sem" type="text" ></input></td>
	</tr>
</footer>


</fieldset>
<FORM><INPUT class = "no_print" Type="button" VALUE="Back" onClick="history.go(-1);return true;"></FORM>
</form>		
</body>
</html>
		