<!DOCTYPE html>
<html lang ="en">
<head>
<meta charset="UTF-8">
<link rel="stylesheet" href="form.css" type="text/css"/>
<title>Evaluation Form</title>
</head>
<body>
<form method="post" action = "evaluation_process.php" >
<img class="logo"  src="../images/logo.png"></img>
<h2 class="brand">The QCE of the NBC NO.461<br>
Instrument for instruction/Teaching Effectiveness</h2>
<fieldset class="content" style="width:1000px;" ><br>

<!--Padi napaluwas kona an schedule dine sa form
..below is wat i have done..-->


<!-- 

 ** There are two criteria that must be met in order to use this form **
	1). Instructor must be logged in
	2). Student must be logged in
	
 -- an himuon ta sani padi dapat maidentify nato if an student tapos an faculty 
    dapat nakalogin na



-->
<?php
	include_once("../db_connect.php");
	include_once("../functions/database_functions.php");
	
	// get faculty data that is logged in
	/*
	
	$query = "SELECT * FROM `faclogin` as fl
	          JOIN `instructor` as ir 
			  ON `fl`.`instructorID` = `ir`.`instructorID`
			  WHERE `fl`.`status` = 1";
	
	
	$fc_result = $connect->query($query) or die($connect->error);
	


	if(!$fc_result)
	{
		
	}
	else
	{
		if($fc_result->num_rows == 0)
			die("
			<span style = 'text-align:center;	'>
			There is no logged in faculty : Contact your instructor for more info
			</span>");
		else
		$faculty_data = (object)$fc_result->fetch_assoc();
	}*/

	
	
	
	// get student data;


	if(isset($_SESSION['user_id']))
		$student_id =  $_SESSION['user_id'];




	$query = "SELECT * FROM `signup` as si
	          JOIN `student` as stud 
	          ON `si`.`studentRefID` = `stud`.`studentID` 

			   WHERE `si`.`studentID` = $student_id";
	
	
	
	$result = db_query($query);


	
	
	if($result)
	{
		$student_data = (object)$result[0];
	}
	else
	{
		header("location:../Login-Students.php");
	}
	
	
?>
  <a class="link"  href = '../logout.php?user_type=student' style = 'text-decoration:none; '> Logout </a>
  <table style="border:none;"> 
  <tr>
<td>
  Rating Period:
 <?php 

$results = mysqli_query($connect,"SELECT * FROM schedule LIMIT 1");
$row = mysqli_fetch_array($results);

/*
$query = "SELECT * FROM `evaluation_data` 
          WHERE `user_id` = '$student_data->studentID' 
		  
		  AND `scheduleID` = ".$row['scheduleID']."
		  AND `evaluators_type` = 'Student'"
          ;
  
 $result = $connect->query($query) or die($connect->error);
 
 if($result)
 {

	if($result->num_rows > 0 )
	{
		echo "You have already evaluated ";
		die();
	}
 }
 */



 $f_query = "SELECT * FROM `instructor` WHERE 
 		    `instructorID` NOT IN 
 		    (SELECT DISTINCT `instructorID` FROM `evaluation_data`
 		     WHERE `user_id` = $student_data->studentID AND `evaluators_type` = 'Student'
 		     AND `scheduleID` = ". $row['scheduleID'] .")
 		    ";



 $instructor = (object) db_query($f_query);


  
  
  ?>
  
  

<input type = "hidden" name = "schedule_id" value = "<?php echo $row['scheduleID'];?>" />
 <input name="start" type="text" value="<?php echo $row['start']; ?>"> </input> </td>

   <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
   &nbsp;&nbsp;TO:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
   &nbsp;
   <input name="end" type="text" value="<?php echo $row['end']; ?>"></input> </td>
  
  </tr>

<tr><td>Name of Faculty:


      	
		<?php
			echo "<select class='selectopt' name = 'instructorID' required>
				  <option value = ''> Select Instructor </option>";

			foreach ($instructor as $ins) 
			{
				$ins = (object)$ins;
				echo "<option value ='$ins->instructorID' > $ins->FName $ins->LName </opIDtion>";
			}

			echo "</select>";

		?>



		<!--<input type = "hidden" name = "instructorID" value = "<?php echo $faculty_data->instructorID;?>">;-->
	   </td>

<td>
Academic Rank:
<input name="#" type="text" ></input>


</td>  
</tr> 
<br>
<tr> 
<td> 
<br>
Evaluators: <b><i> <?php echo $student_data->FName . " ". $student_data->LName; ?></i>
<input type = "hidden" name = "studentID" value =  "<?php echo $student_data->studentID;?>" >
</b>
</td></tr> 

</table>  <br>

<div class="cs">
<input  class="checkbox" type="radio" name="evaluators" value="Self" disabled >Self&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp; 
<input  class="checkbox" type="radio" name="evaluators" value="Peer" disabled >Peer</input><br>
<input  class="checkbox" name="evaluators" type="radio" name="d" value="Student" 
<?php
	if($student_data->type = "Student")
		echo "checked";
?>
>Student&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;


<input  class="checkbox" name="evaluators" type="radio" name="evaluators"  disabled value="Supervisor" >Supervisor</input><br><br>
</div>
<center style = 'color:#b07219;text-decoration:none; '>
<b>Instructions:</b> Please evaluate using the scale below.Click the radio button for your rating.</center><br>

<table border="1" class="" width="60%">
<tr>
  <td>Scale</td>
  <td>Descriptive Rating</td>
  <td>Qualitative Description</td>
  </tr>
  
  <tr>
  <td>5</td>
  <td>Outstanding</td>
  <td>The performance almost always exceeds the job requirements</br>
  The faculty is an exceptional </td>
  </tr>
  <tr>
  <td>4</td>
  <td>Very Satisfactory</td>
  <td>The performance meets and often exceeds the job requirements</td>
  </tr>
  <tr>
  <td>3</td>
  <td>Satisfactory</td>
  <td>The performance meets job requirements</td>
  </tr>
  <tr>
  <td>2</td>
  <td>Fair</td>
  <td>The performance needs some development to meet job requirements</td>
  </tr>
  <tr>
  <td>1</td>
  <td>Poor</td>
  <td>The faculty fails to meet job requirements</td>
  </tr>
  </table>
<br>
<table  border="1" class="tablesize">





<tr>

<td class="left">A.Commitment</td>
<td colspan="5" align="center"> Scale </td>

</tr>
<tr>

<td class="left"><span class="badge">1.</span> Demonstrates sensitivity to students ability to attend and absorb content information.</td>
<td class="tdsize">
<input name="a" type="radio" value="5"  required>5&nbsp;</input>
<input name="a" type="radio" value="4"  required>4&nbsp;</input>
<input name="a" type="radio" value="3"  required>3&nbsp;</input>
<input name="a"  type="radio" value="2" required>2&nbsp;</input>
<input  name="a" type="radio" value="1" required>1</input>
</td>

</tr><tr>
<td class="left"><span class="badge">2.</span> Integrates sensitivity his/her learning objectives with those of the students in a collaborative process.</td>
<td class="tdsize" > 
<input name="b" type="radio" value="5"  required>5&nbsp;</input>
<input name="b" type="radio" value="4"  required>4&nbsp;</input>
<input name="b" type="radio" value="3"  required>3&nbsp;</input>
<input name="b" type="radio" value="2"  required>2&nbsp;</input>
<input name="b" type="radio" value="1"  required>1</input> </td>

</tr>
<tr>
<td class="left"><span class="badge">3.</span> Makes self available beyond official time.</td>
<td class="tdsize">
<input name="c" type="radio" value="5"  required>5&nbsp;</input>
<input name="c" type="radio" value="4"  required>4&nbsp;</input>
<input name="c" type="radio" value="3"  required>3&nbsp;</input>
<input name="c" type="radio" value="2"  required>2&nbsp;</input>
<input name="c" type="radio" value="1"  required>1</input> </td>

</tr>
<tr>
<td class="left"><span class="badge">4.</span> Regularly comes to class on time, well-groomed and well-prepared to complete assigned responsibilities.</td>
<td class="tdsize">
<input name="d" type="radio" value="5"  required>5&nbsp;</input>
<input name="d" type="radio" value="4"  required>4&nbsp;</input>
<input name="d" type="radio" value="3"  required>3&nbsp;</input>
<input name="d" type="radio" value="2"  required>2&nbsp;</input>
<input name="d" type="radio" value="1"  required>1</input> </td>

</tr><tr>

<td class="left"><span class="badge">5.</span> Keeps accurate records of students performance and prompt submission of the same.</td>
<td class="tdsize" >
<input name="e" type="radio" value="5"  required>5&nbsp;</input>
<input name="e" type="radio" value="4"  required>4&nbsp;</input>
<input name="e" type="radio" value="3"  required>3&nbsp;</input>
<input name="e" type="radio" value="2"  required>2&nbsp;</input>
<input name="e" type="radio" value="1"  required>1</input> </td>
</tr>


</table><BR><BR>

<!--NEXT TABLE-->

<table border="1" class="tablesize">
<tr>
<td class="left">B. Knowledge of Subject</td>
<td colspan="5" align="center"> Scale </td>
</tr>
<tr>
<td class="left"><span class="badgered">1.</span> Demonstrates mastery of the subject matter (explain the subject matter without relying solely on the prescribed textbook).</td>
<td class="tdsize">
<input name="a2" type="radio"  value="5" required>5&nbsp;</input>
<input name="a2" type="radio"  value="4" required>4&nbsp;</input>
<input name="a2" type="radio"  value="3" required>3&nbsp;</input>
<input name="a2" type="radio"  value="2" required>2&nbsp;</input>
<input name="a2" type="radio"  value="1" required>1</input> </td>
</tr><tr>
<td class="left"><span class="badgered">2.</span> Draws and share information on the state of the art of theory and practice in his/her discipline.</td>
<td class="tdsize"
><input name="b2" type="radio"   value="5" required>5&nbsp;</input>
<input  name="b2" type="radio"   value="4" required>4&nbsp;</input>
<input  name="b2" type="radio"   value="3" required>3&nbsp;</input>
<input  name="b2" type="radio"   value="2" required>2&nbsp;</input>
<input  name="b2" type="radio"   value="1" required>1</input> </td>
</tr><tr>
<td class="left"><span class="badgered">3.</span> Integrates subject to practical circumstances and learning intents/purposes of students.</td>
<td class="tdsize">
<input  name="c2" type="radio"    value="5"  required>5&nbsp;</input>
<input name="c2"  type="radio"    value="4"  required>4&nbsp;</input>
<input name="c2"  type="radio"    value="3"  required>3&nbsp;</input>
<input name="c2"  type="radio"    value="2"  required>2&nbsp;</input>
<input name="c2"  type="radio"    value="1"  required>1</input> </td>
</tr>
<tr>
<td class="left"><span class="badgered">4.</span> Explains the relevance of present topics to the previous lessons and relates the subject matter to relevant current issues and/or daily life activities.</td>
<td class="tdsize">
<input name="d2"  type="radio"   value="5" required>5&nbsp;</input>
<input name="d2"  type="radio"   value="4" required>4&nbsp;</input>
<input name="d2"  type="radio"   value="3" required>3&nbsp;</input>
<input name="d2"  type="radio"   value="2" required>2&nbsp;</input>
<input name="d2"  type="radio"   value="1" required>1</input> </td>
</tr>
<tr>
<td class="left"><span class="badgered">5.</span> Demonstrates up-to-date knowledge and/or awareness on current trends and issues of the subject.</td>
<td class="tdsize">
<input name="e2"  type="radio"  value="5" required>5&nbsp;</input>
<input name="e2"  type="radio"  value="4" required>4&nbsp;</input>
<input name="e2"  type="radio"  value="3" required>3&nbsp;</input>
<input name="e2"  type="radio"  value="2" required>2&nbsp;</input>
<input name="e2"  type="radio"  value="1" required>1</input></td>
</tr>

</table><BR><BR>

<!--NEXT TABLE-->

<table border="1" class="tablesize">
<tr>
<td class="left">C. Teaching for Independent Learning</td>
<td colspan="5" align="center"> Scale </td>
</tr>
<tr>
<td class="left"><span class="badgeyell">1.</span> Creates teaching strategies that allow students to practice using concepts they need to understand (interactive discussion).</td>
<td class="tdsize">
<input name="a3" type="radio"   value="5"  required>5&nbsp;</input>
<input name="a3" type="radio"   value="4" required>4&nbsp;</input>
<input name="a3" type="radio"   value="3" required>3&nbsp;</input>
<input name="a3" type="radio"   value="2" required>2&nbsp;</input>
<input name="a3" type="radio"   value="1" required>1</input>
 </td>
</tr><tr>
<td class="left"><span class="badgeyell">2.</span> Enhances student self-esteem and/or gives due recognition to students performance/potentials.</td>
<td class="tdsize">
<input name="b3"  type="radio"   value="5" required>5&nbsp;</input>
<input name="b3"  type="radio"   value="4" required>4&nbsp;</input>
<input name="b3"  type="radio"   value="3" required>3&nbsp;</input>
<input name="b3"  type="radio"   value="2" required>2&nbsp;</input>
<input name="b3"  type="radio"   value="1" required>1</input> </td>
</tr><tr>
<td class="left"><span class="badgeyell">3.</span> Allows students to create their own course with objectives and realistically defined student-professor rules and make them accountable for their performance.</td>
<td class="tdsize">
<input name="c3" type="radio"   value="5" required >5&nbsp;</input>
<input name="c3" type="radio"   value="4" required>4&nbsp;</input>
<input name="c3" type="radio"   value="3" required>3&nbsp;</input>
<input name="c3" type="radio"   value="2" required>2&nbsp;</input>
<input name="c3" type="radio"   value="1" required>1</input>

 </td>
</tr>
<tr>
<td class="left"><span class="badgeyell">4.</span> Allows students to think independently and make their own decisions and holding them accountable for their perfomance based largely on thier success in executing decisions.</td>
<td class="tdsize">
<input name="d3" type="radio"   value="5"  required>5&nbsp;</input>
<input name="d3" type="radio"   value="4" required>4&nbsp;</input>
<input name="d3" type="radio"   value="3" required>3&nbsp;</input>
<input name="d3" type="radio"   value="2" required>2&nbsp;</input>
<input name="d3" type="radio"   value="1" required>1</input>
</td>
</tr>
<tr>
<td class="left"><span class="badgeyell">5.</span> Encourages students to learn beyond what is required and help/guide the students how to apply the concepts learned.</td>
<td class="tdsize">
<input name="e3" type="radio"   value="5" required >5&nbsp;</input>
<input name="e3" type="radio"   value="4" required>4&nbsp;</input>
<input name="e3" type="radio"   value="3" required>3&nbsp;</input>
<input name="e3" type="radio"   value="2" required>2&nbsp;</input>
<input name="e3" type="radio"   value="1" required>1</input>
 </td>
</tr>

</table><BR><BR>
<!--NEXT TABLE-->

<table border="1" class="tablesize">
<tr>
<td class="left">D. Management of Learning</td>
<td colspan="5" align="center"> Scale </td>
</tr>
<tr>
<td class="left"><span class="badgeblue">1.</span> Creates opportunities for intensive and/or extensive contribution of students in the class activities(e.g. breaks class into dyads ,triads , or buzz/task groups).</td>
<td class="tdsize">
<input name="a4"  type="radio"   value="5"  required>5&nbsp;</input>
<input name="a4"  type="radio"   value="4"  required>4&nbsp;</input>
<input name="a4"  type="radio"   value="3"  required>3&nbsp;</input>
<input name="a4"  type="radio"   value="2"  required>2&nbsp;</input>
<input name="a4"  type="radio"   value="1"  required>1</input>
</td>
</tr><tr>
<td class="left"><span class="badgeblue">2.</span> Assumes roles as facilitator , resource  person , coach , inquisitor , integrator , referee in drawing students to contribute to knowledge and understanding of the concepts at hands.</td>
<td class="tdsize">
<input name="b4" type="radio"   value="5"  required>5&nbsp;</input>
<input name="b4" type="radio"   value="4"  required>4&nbsp;</input>
<input name="b4" type="radio"   value="3"  required>3&nbsp;</input>
<input name="b4" type="radio"   value="2"  required>2&nbsp;</input>
<input name="b4" type="radio"   value="1"  required>1</input>
 </td>
</tr><tr>
<td class="left"><span class="badgeblue">3.</span> Designs and implements learning conditions and experience that promotes healthy exchange and/or confrontations.</td>
<td>
<input name="c4" type="radio"   value="5"  required>5&nbsp;</input>
<input name="c4" type="radio"   value="4"  required>4&nbsp;</input>
<input name="c4" type="radio"   value="3"  required>3&nbsp;</input>
<input name="c4" type="radio"   value="2"  required>2&nbsp;</input>
<input name="c4" type="radio"   value="1"  required>1</input>
 </td>
</tr>
<tr>
<td class="left"><span class="badgeblue">4.</span> Stuctures / re-structures learning and teaching-learning context to enhance attainment of collective learning objectives.</td>
<td  class="tdsize">
<input name="d4" type="radio"   value="5" required>5&nbsp;</input>
<input name="d4" type="radio"   value="4" required>4&nbsp;</input>
<input name="d4" type="radio"   value="3" required>3&nbsp;</input>
<input name="d4" type="radio"   value="2" required>2&nbsp;</input>
<input name="d4" type="radio"   value="1" required>1</input>
 </td>
</tr>
<tr>
<td class="left"><span class="badgeblue">5.</span> Use of Instructional Materials (audio/video materials , fieldtrips , film showing, computer aided instruction and etc.) to reinforces learning processes.</td>
<td class="tdsize">
<input name="e4" type="radio"    value="5"  required>5&nbsp;</input>
<input name="e4"  type="radio"   value="4"  required>4&nbsp;</input>
<input name="e4"  type="radio"   value="3"  required>3&nbsp;</input>
<input name="e4"  type="radio"   value="2"  required>2&nbsp;</input>
<input name="e4"  type="radio"   value="1" required>1</input>
 </td>
</tr>

</table><BR><BR>
<table style="border:none;" class="tablesize">
<tr>
<td>
<?php

$date=date("Y-m-d");

?>
Name of evaluator&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input name="noe"  style=" width:18%" type="text" value="<?php  echo $student_data->FName . " ". $student_data->LName ;  ?>" ></input><br>
</td>
</tr>
<tr>
<td>
Position of Evaluator&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input name="poe" style=" width:18%"   type="text" value="<?php  echo $student_data->type; ?>" ></input><br>
</td>
</tr>
<tr>
<td>
Date&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;
:
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input style=" width:18%" type="text" value="<?php  echo date("m-d-Y"); ?>" ></input>

</td>
</tr>

</table><BR><BR>
<input class="link"  style="float:right" type="submit" name="submit" id="submit" value="Evaluate"></input>

</form>



 
</fieldset>

</body>
</html>
		