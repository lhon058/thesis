<!DOCTYPE html>
<html lang ="en">
<head>
<meta charset="UTF-8">
<link rel="stylesheet" href="secoral.css" type="text/css"/>
<title>Sectorial Form</title>
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
		
		$loop = 1;

		if($_GET['evaluator_type'] == 'All')
		{

			$loop = 4;
		}

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
					  AND `scheduleID` = 1";

			
					  
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
					 echo $total_all . "<br>";

		}
		else
			continue;
			
		
			
		
			
			
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
<fieldset class="content" style="width:100%;" >


<table class="bordered">
		<thead> 
				<h5 >I. COMMITMENT</h5>
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

<footer>
	<tr>
	<td>Rater:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input name="Rater" type="text" ></input></td><br>
	<td>Position:&nbsp;&nbsp;&nbsp;<input name="position" type="text" ></input></td><br>
	</td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<td>
	Dean/Director:<input name="sem" type="text" ></input></td>
	</tr>
</footer>


</fieldset>
<FORM><INPUT Type="button" VALUE="Back" onClick="history.go(-1);return true;"></FORM>
</form>		
</body>
</html>
		