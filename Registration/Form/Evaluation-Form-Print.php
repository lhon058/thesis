<!DOCTYPE html>
<html lang ="en">
<head>
<meta charset="UTF-8">
<link rel="stylesheet" href="form.css" type="text/css"/>
<title>Evaluation Form</title>

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
   margin:1cm;
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
	margin-top: 1%;
	margin-bottom: 1% !important;
}

table:nth-child(even)
{
	margin-bottom: 1% !important;
}
table tr td,table th
{
	font-size: 10px !important;
	white-space: none !important;
	padding:0px !important;
}
fieldset
{
	border:none !important;
	box-shadow:none !important;
}
table
{
	margin: 0% !important;
	
	border:none !important;
}
input[type='text']{padding:0px !important;background: transparent !important;border:none !important;}

span{text-align: left !important;}
br {display: none !important;}
table:last-child
{
	margin-bottom: 0% !important;
}
table { page-break-inside : avoid;width:100% !important;}


}

table tr td:nth-child(2){text-align: center !important;}

</style>
</head>
<body>
<form method="post" action = "evaluation_process.php" >

<h2 align="center">The QCE of the NBC NO.461<br>
Instrument for instruction/Teaching Effectiveness</h2>
<fieldset class="content print_home" style="width:80%;" ><br>
 <a href = '#' class ='print_b no_print' style = 'float:right;' > Print </a>

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



	
	
?>
<tr >
  <td >
 
  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  Rating Period:&nbsp;</td>&nbsp;&nbsp;
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


 $instructorID = $_GET['instructor'];
 $f_query = "SELECT * FROM `instructor` WHERE `instructorID` = $instructorID LIMIT 1
 		    ";



 $instructor = (object) db_query($f_query)[0];
 $user_id = $_GET['user_id'];

 if(trim($_GET['evaluator_type']) == "Student")
 {
 	$query = "SELECT * FROM `evaluation_data` as ed 
		  JOIN `student` as st
		  ON `ed`.`user_id` = `st`.`studentID`
		  WHERE 
 		  `ed`.`user_id` = $user_id AND `instructorID` = $instructorID";
 }
 else
 {
 		$query = "SELECT * FROM `evaluation_data` as ed 
		  JOIN `instructor` as i
		  ON `ed`.`user_id` = `i`.`instructorID`
		  WHERE 
 		  `ed`.`user_id` = $user_id AND `ed`.`instructorID` = $instructorID";
 }



 $eval_data = (object) db_query($query)[0];

  ?>
  
  
  
  
<td>
<input type = "hidden" name = "schedule_id" value = "<?php echo $row['scheduleID'];?>" />
<span style = "font-weight:bold;"> <?php echo $row['start']; ?> </span>
</td>
</td>
    <!--End-->
&nbsp;&nbsp;<td>
  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;to:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
 <span style = "font-weight:bold;"> <?php echo $row['end']; ?></span></td>
<br><br><br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<tr><td>Name of Faculty:</td>


        <td>
      	
		<?php
			
			echo "<span> $instructor->FName $instructor->LName </span>";
		?>



		<!--<input type = "hidden" name = "instructorID" value = "<?php echo $faculty_data->instructorID;?>">;-->
	   </td>
        </td>
  
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<tr>Academic Rank:</tr>
<tr><td><span> <?php echo $instructor->academic_rank ;?></span></td></tr>
<br><br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;

<span> Evaluator: <b> <?php echo $_GET['evaluator_type'];$evaluator_type = trim($_GET['evaluator_type']); ?>
</div> 
<center><br><br>
<b>Instructions:</b> Please evaluate using the scale below.Click the radio button for your rating.</center><br>

<table border="1" class="" width="100%">
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

<table  border="1" class="tablesize">





<tr>

<td class="left">A.Commitment</td>
<td colspan="5" align="center"> Scale </td>

</tr>
<tr>

<td class="left">1. Demonstrates sensitivity to students ability to attend and absorb content information.</td>
<td class="tdsize">
	<?php echo $eval_data->a1; ?>
</td>

</tr><tr>
<td class="left">2. Integrates sensitivity his/her learning objectives with those of the students in a collaborative process.</td>
<td class="tdsize" > 
<?php echo $eval_data->a2; ?>

</tr>
<tr>
<td class="left">3. Makes self available beyond official time.</td>
<td class="tdsize">
<?php echo $eval_data->a3; ?>

</tr>
<tr>
<td class="left">4. Regularly comes to class on time, well-groomed and well-prepared to complete assigned responsibilities.</td>
<td class="tdsize">
<?php echo $eval_data->a4; ?>

</tr><tr>

<td class="left">5. Keeps accurate records of students performance and prompt submission of the same.</td>
<td class="tdsize" >
<?php echo $eval_data->a5; ?>
</tr>


</table><BR><BR>

<!--NEXT TABLE-->

<table border="1" class="tablesize">
<tr>
<td class="left">B. Knowledge of Subject</td>
<td colspan="5" align="center"> Scale </td>
</tr>
<tr>
<td class="left">1. Demonstrates mastery of the subject matter (explain the subject matter without relying solely on the prescribed textbook).</td>
<td class="tdsize">
<?php echo $eval_data->b1; ?>
</tr><tr>
<td class="left">2. Draws and share information on the state of the art of theory and practice in his/her discipline.</td>
<td class="tdsize"
><?php echo $eval_data->b2; ?>
</tr><tr>
<td class="left">3. Integrates subject to practical circumstances and learning intents/purposes of students.</td>
<td class="tdsize">
<?php echo $eval_data->b3; ?>
</tr>
<tr>
<td class="left">4. Explains the relevance of present topics to the previous lessons and relates the subject matter to relevant current issues and/or daily life activities.</td>
<td class="tdsize">
<?php echo $eval_data->b4; ?>
</tr>
<tr>
<td class="left">5. Demonstrates up-to-date knowledge and/or awareness on current trends and issues of the subject.</td>
<td class="tdsize">
<?php echo $eval_data->b5; ?>
</tr>

</table><BR><BR>

<!--NEXT TABLE-->

<table border="1" class="tablesize">
<tr>
<td class="left">C. Teaching for Independent Learning</td>
<td colspan="5" align="center"> Scale </td>
</tr>
<tr>
<td class="left">1. Creates teaching strategies that allow students to practice using concepts they need to understand (interactive discussion).</td>
<td class="tdsize">
<?php echo $eval_data->c1; ?>
 </td>
</tr><tr>
<td class="left">2. Enhances student self-esteem and/or gives due recognition to students performance/potentials.</td>
<td class="tdsize">
<?php echo $eval_data->c2; ?>
</tr><tr>
<td class="left">3. Allows students to create their own course with objectives and realistically defined student-professor rules and make them accountable for their performance.</td>
<td class="tdsize">
<?php echo $eval_data->c3; ?>

 </td>
</tr>
<tr>
<td class="left">4. Allows students to think independently and make their own decisions and holding them accountable for their perfomance based largely on thier success in executing decisions.</td>
<td class="tdsize">
<?php echo $eval_data->c4; ?>
</td>
</tr>
<tr>
<td class="left">5. Encourages students to learn beyond what is required and help/guide the students how to apply the concepts learned.</td>
<td class="tdsize">
<?php echo $eval_data->c5; ?>
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
<td class="left">1. Creates opportunities for intensive and/or extensive contribution of students in the class activities(e.g. breaks class into dyads ,triads , or buzz/task groups).</td>
<td class="tdsize">
<?php echo $eval_data->d1; ?>
</td>
</tr><tr>
<td class="left">2. Assumes roles as facilitator , resource  person , coach , inquisitor , integrator , referee in drawing students to contribute to knowledge and understanding of the concepts at hands.</td>
<td class="tdsize">
<?php echo $eval_data->d2; ?>
 </td>
</tr><tr>
<td class="left">3. Designs and implements learning conditions and experience that promotes healthy exchange and/or confrontations.</td>
<td>
<?php echo $eval_data->d3; ?>
 </td>
</tr>
<tr>
<td class="left">4. Stuctures / re-structures learning and teaching-learning context to enhance attainment of collective learning objectives.</td>
<td  class="tdsize">
<?php echo $eval_data->d4; ?>
 </td>
</tr>
<tr>
<td class="left">5. Use of Instructional Materials (audio/video materials , fieldtrips , film showing, computer aided instruction and etc.) to reinforces learning processes.</td>
<td class="tdsize">
<?php echo $eval_data->d5; ?>
 </td>
</tr>

</table><BR><BR>
<table border="1" class="tablesize">
<tr>
<td>
<?php

$date=date("Y-m-d");

?>
Name of evaluator&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input name="noe"  style=" width:18%" type="text" value="<?php  echo $eval_data->FName . " ". $eval_data->LName ;  ?>" ></input><br>
</td>
</tr>
<tr>
<td>
Position of Evaluator&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input name="poe" style=" width:18%"   type="text" value="<?php  echo $eval_data->Position_of_evaluator; ?>" ></input><br>
</td>
</tr>
<tr>
<td>
Date&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;
:
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input style=" width:18%" type="text" value="<?php  echo date("m-d-Y"); ?>" ></input>

</td>
</tr>

</table><BR><BR>
<input class = 'no_print'style="float:right" type="submit" name="submit" id="submit" value="Evaluate"></input>

</form>



 
</fieldset>

<fieldset class="mac no_print" >
  <a  name="print"
   href="../Admin-Page/results-list.php?instructor=<?php echo $instructorID; ?>&evaluator_type=<?php echo $evaluator_type; ?>&submit_ins=OK" style="cursor:pointer;"><img style="margin-left:600px;margin-top:5px" src="images/back.png" title="Back" width="70px"></img></a>


</fieldset>
</body>
</html>
		