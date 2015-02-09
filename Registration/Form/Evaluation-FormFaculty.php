<!DOCTYPE html>
<html lang ="en">

	<head>
		<meta charset="UTF-8">
		<link rel="stylesheet" href="form.css" type="text/css"/>
		<title>Evaluation Form</title>
	</head>

	<body>
		<form method="post" action = "evaluation_process.php" >

			<h2 align="center">The QCE of the NBC NO.461<br>
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
				
				$query = "SELECT * FROM `instructor`";
				
				
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
					{

						$faculty_data = db_query($query);
						
					}
				}


				
				
				// get student data;
				
				$user_id =  $_SESSION['user_id'];



				$query = "SELECT * FROM `faclogin` as fl
						  JOIN `instructor` as i ON
						  `fl`.`instructorID` = `i`.`instructorID`
						   WHERE `fl`.`instructorID` = $user_id";
				
				
				$result = db_query($query);




				
				if($result)
				{
					$user_data = (object)$result[0];
				}
				else
				{
					header("location:../Login-Students.php");
				}
				
				
			?>
			<tr >
			  <td >
			  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			  Rating Period:&nbsp;</td>&nbsp;&nbsp;
			 <?php 

			$results = mysqli_query($connect,"SELECT * FROM schedule LIMIT 1");
			$row = mysqli_fetch_array($results);

			$query = "SELECT * FROM `evaluation_data` 
			          WHERE `user_id` = '$user_data->instructorID' 
					 
					  AND `scheduleID` = ".$row['scheduleID']
					  
			          ;


			$if_peer = "SELECT * FROM `evaluation_data` 
			          WHERE `user_id` = '$user_data->instructorID' 
					 
					  AND `scheduleID` = ".$row['scheduleID'] ."
					  AND `evaluators_type` = 'Peer' ";

			$if_self = "SELECT * FROM `evaluation_data` 
			          WHERE `user_id` = '$user_data->instructorID' 
					 
					  AND `scheduleID` = ".$row['scheduleID']."
					  AND `evaluators_type` = 'Self'";

			$if_peer = $connect->query($if_peer) or die($connect->error);
			$if_self = $connect->query($if_self) or die($connect->error);

			$if_peer = ($if_peer->num_rows > 0 ) ? true : false;
			$if_self = ($if_self->num_rows > 0 ) ? true : false;
			  
			 $result = $connect->query($query) or die($connect->error);
			 
			 if($result)
			 {

				if($result->num_rows > 0 )
				{
					echo "You have already evaluated ";
					//die();
				}
			 }
			  
			  
			  ?>
			  
			  
			  
			  
			<td>
			<input type = "hidden" name = "schedule_id" value = "<?php echo $row['scheduleID'];?>" />
			<input name="start" type="text" value="<?php echo $row['start']; ?>"> </input>
			</td>
			</td>
			    <!--End-->
			&nbsp;&nbsp;<td>
			  to:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			  <input name="end" type="text" value="<?php echo $row['end']; ?>"></input></td>
			<br><br><br>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<tr><td>Name of Faculty:</td>


			        <td>
			      

			        <select name="instructorID" required id = "instructorID">
			        	<option value="">Select an Instructor</option>
			        	<?php
			        		
			        		foreach ($faculty_data as $fd) 
			        		{
			        			$fd = (object)$fd;
			        			echo "<option value ='$fd->instructorID' >$fd->FName $fd->LName </option>";
			        		}

			        	?>
			        </select>
					
				   </td>
			        </td>

	        <?php
				$peer_disabled = "";
				if($if_peer)
					$peer_disabled = "disabled";

				$self_disabled = "";
				if($if_self)
					$self_disabled = "disabled";

			?>
			  
			&nbsp;&nbsp;
			<tr>Academic Rank:</tr>
			<tr><td><input name="#" type="text" ></input></td></tr>
			<br><br>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			&nbsp;&nbsp;&nbsp;&nbsp;


			<span> Evaluators: <b><i> <?php echo $user_data->FName . " ". $user_data->LName; ?></i>
			<input type = "hidden" name = "user_id" value =  "<?php echo $user_data->instructorID;?>" >
			</b> </span><br>

			<div class="cs">
			<input  class="checkbox" type="radio" <?php echo $self_disabled;?> name="evaluators" value="Self" >Self&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			&nbsp;&nbsp; 

			

			<input  class="checkbox" type="radio" name="evaluators" value="Peer"  <?php echo $peer_disabled;?> >Peer</input><br>
			<input  class="checkbox" name="evaluators" type="radio" name="d" value="Student" disabled
			
			>Student&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			&nbsp;

			<input  class="checkbox" name="evaluators" type="radio" name="evaluators" value="Supervisor" >Supervisor</input><br><br>
			</div>
			<center>
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

			<table  border="1" class="tablesize">





			<tr>

			<td class="left">A.Commitment</td>
			<td colspan="5" align="center"> Scale </td>

			</tr>
			<tr>

			<td class="left">1. Demonstrates sensitivity to students ability to attend and absorb content information.</td>
			<td class="tdsize">
			<input name="a" type="radio" value="5"  required>5&nbsp;</input>
			<input name="a" type="radio" value="4"  required>4&nbsp;</input>
			<input name="a" type="radio" value="3"  required>3&nbsp;</input>
			<input name="a"  type="radio" value="2" required>2&nbsp;</input>
			<input  name="a" type="radio" value="1" required>1</input>
			</td>

			</tr><tr>
			<td class="left">2. Integrates sensitivity his/her learning objectives with those of the students in a collaborative process.</td>
			<td class="tdsize" > 
			<input name="b" type="radio" value="5"  required>5&nbsp;</input>
			<input name="b" type="radio" value="4"  required>4&nbsp;</input>
			<input name="b" type="radio" value="3"  required>3&nbsp;</input>
			<input name="b" type="radio" value="2"  required>2&nbsp;</input>
			<input name="b" type="radio" value="1"  required>1</input> </td>

			</tr>
			<tr>
			<td class="left">3. Makes self available beyond official time.</td>
			<td class="tdsize">
			<input name="c" type="radio" value="5"  required>5&nbsp;</input>
			<input name="c" type="radio" value="4"  required>4&nbsp;</input>
			<input name="c" type="radio" value="3"  required>3&nbsp;</input>
			<input name="c" type="radio" value="2"  required>2&nbsp;</input>
			<input name="c" type="radio" value="1"  required>1</input> </td>

			</tr>
			<tr>
			<td class="left">4. Regularly comes to class on time, well-groomed and well-prepared to complete assigned responsibilities.</td>
			<td class="tdsize">
			<input name="d" type="radio" value="5"  required>5&nbsp;</input>
			<input name="d" type="radio" value="4"  required>4&nbsp;</input>
			<input name="d" type="radio" value="3"  required>3&nbsp;</input>
			<input name="d" type="radio" value="2"  required>2&nbsp;</input>
			<input name="d" type="radio" value="1"  required>1</input> </td>

			</tr><tr>

			<td class="left">5. Keeps accurate records of students performance and prompt submission of the same.</td>
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
			<td class="left">1. Demonstrates mastery of the subject matter (explain the subject matter without relying solely on the prescribed textbook).</td>
			<td class="tdsize">
			<input name="a2" type="radio"  value="5" required>5&nbsp;</input>
			<input name="a2" type="radio"  value="4" required>4&nbsp;</input>
			<input name="a2" type="radio"  value="3" required>3&nbsp;</input>
			<input name="a2" type="radio"  value="2" required>2&nbsp;</input>
			<input name="a2" type="radio"  value="1" required>1</input> </td>
			</tr><tr>
			<td class="left">2. Draws and share information on the state of the art of theory and practice in his/her discipline.</td>
			<td class="tdsize"
			><input name="b2" type="radio"   value="5" required>5&nbsp;</input>
			<input  name="b2" type="radio"   value="4" required>4&nbsp;</input>
			<input  name="b2" type="radio"   value="3" required>3&nbsp;</input>
			<input  name="b2" type="radio"   value="2" required>2&nbsp;</input>
			<input  name="b2" type="radio"   value="1" required>1</input> </td>
			</tr><tr>
			<td class="left">3. Integrates subject to practical circumstances and learning intents/purposes of students.</td>
			<td class="tdsize">
			<input  name="c2" type="radio"    value="5"  required>5&nbsp;</input>
			<input name="c2"  type="radio"    value="4"  required>4&nbsp;</input>
			<input name="c2"  type="radio"    value="3"  required>3&nbsp;</input>
			<input name="c2"  type="radio"    value="2"  required>2&nbsp;</input>
			<input name="c2"  type="radio"    value="1"  required>1</input> </td>
			</tr>
			<tr>
			<td class="left">4. Explains the relevance of present topics to the previous lessons and relates the subject matter to relevant current issues and/or daily life activities.</td>
			<td class="tdsize">
			<input name="d2"  type="radio"   value="5" required>5&nbsp;</input>
			<input name="d2"  type="radio"   value="4" required>4&nbsp;</input>
			<input name="d2"  type="radio"   value="3" required>3&nbsp;</input>
			<input name="d2"  type="radio"   value="2" required>2&nbsp;</input>
			<input name="d2"  type="radio"   value="1" required>1</input> </td>
			</tr>
			<tr>
			<td class="left">5. Demonstrates up-to-date knowledge and/or awareness on current trends and issues of the subject.</td>
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
			<td class="left">1. Creates teaching strategies that allow students to practice using concepts they need to understand (interactive discussion).</td>
			<td class="tdsize">
			<input name="a3" type="radio"   value="5"  required>5&nbsp;</input>
			<input name="a3" type="radio"   value="4" required>4&nbsp;</input>
			<input name="a3" type="radio"   value="3" required>3&nbsp;</input>
			<input name="a3" type="radio"   value="2" required>2&nbsp;</input>
			<input name="a3" type="radio"   value="1" required>1</input>
			 </td>
			</tr><tr>
			<td class="left">2. Enhances student self-esteem and/or gives due recognition to students performance/potentials.</td>
			<td class="tdsize">
			<input name="b3"  type="radio"   value="5" required>5&nbsp;</input>
			<input name="b3"  type="radio"   value="4" required>4&nbsp;</input>
			<input name="b3"  type="radio"   value="3" required>3&nbsp;</input>
			<input name="b3"  type="radio"   value="2" required>2&nbsp;</input>
			<input name="b3"  type="radio"   value="1" required>1</input> </td>
			</tr><tr>
			<td class="left">3. Allows students to create their own course with objectives and realistically defined student-professor rules and make them accountable for their performance.</td>
			<td class="tdsize">
			<input name="c3" type="radio"   value="5" required >5&nbsp;</input>
			<input name="c3" type="radio"   value="4" required>4&nbsp;</input>
			<input name="c3" type="radio"   value="3" required>3&nbsp;</input>
			<input name="c3" type="radio"   value="2" required>2&nbsp;</input>
			<input name="c3" type="radio"   value="1" required>1</input>

			 </td>
			</tr>
			<tr>
			<td class="left">4. Allows students to think independently and make their own decisions and holding them accountable for their perfomance based largely on thier success in executing decisions.</td>
			<td class="tdsize">
			<input name="d3" type="radio"   value="5"  required>5&nbsp;</input>
			<input name="d3" type="radio"   value="4" required>4&nbsp;</input>
			<input name="d3" type="radio"   value="3" required>3&nbsp;</input>
			<input name="d3" type="radio"   value="2" required>2&nbsp;</input>
			<input name="d3" type="radio"   value="1" required>1</input>
			</td>
			</tr>
			<tr>
			<td class="left">5. Encourages students to learn beyond what is required and help/guide the students how to apply the concepts learned.</td>
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
			<td class="left">1. Creates opportunities for intensive and/or extensive contribution of students in the class activities(e.g. breaks class into dyads ,triads , or buzz/task groups).</td>
			<td class="tdsize">
			<input name="a4"  type="radio"   value="5"  required>5&nbsp;</input>
			<input name="a4"  type="radio"   value="4"  required>4&nbsp;</input>
			<input name="a4"  type="radio"   value="3"  required>3&nbsp;</input>
			<input name="a4"  type="radio"   value="2"  required>2&nbsp;</input>
			<input name="a4"  type="radio"   value="1"  required>1</input>
			</td>
			</tr><tr>
			<td class="left">2. Assumes roles as facilitator , resource  person , coach , inquisitor , integrator , referee in drawing students to contribute to knowledge and understanding of the concepts at hands.</td>
			<td class="tdsize">
			<input name="b4" type="radio"   value="5"  required>5&nbsp;</input>
			<input name="b4" type="radio"   value="4"  required>4&nbsp;</input>
			<input name="b4" type="radio"   value="3"  required>3&nbsp;</input>
			<input name="b4" type="radio"   value="2"  required>2&nbsp;</input>
			<input name="b4" type="radio"   value="1"  required>1</input>
			 </td>
			</tr><tr>
			<td class="left">3. Designs and implements learning conditions and experience that promotes healthy exchange and/or confrontations.</td>
			<td>
			<input name="c4" type="radio"   value="5"  required>5&nbsp;</input>
			<input name="c4" type="radio"   value="4"  required>4&nbsp;</input>
			<input name="c4" type="radio"   value="3"  required>3&nbsp;</input>
			<input name="c4" type="radio"   value="2"  required>2&nbsp;</input>
			<input name="c4" type="radio"   value="1"  required>1</input>
			 </td>
			</tr>
			<tr>
			<td class="left">4. Stuctures / re-structures learning and teaching-learning context to enhance attainment of collective learning objectives.</td>
			<td  class="tdsize">
			<input name="d4" type="radio"   value="5" required>5&nbsp;</input>
			<input name="d4" type="radio"   value="4" required>4&nbsp;</input>
			<input name="d4" type="radio"   value="3" required>3&nbsp;</input>
			<input name="d4" type="radio"   value="2" required>2&nbsp;</input>
			<input name="d4" type="radio"   value="1" required>1</input>
			 </td>
			</tr>
			<tr>
			<td class="left">5. Use of Instructional Materials (audio/video materials , fieldtrips , film showing, computer aided instruction and etc.) to reinforces learning processes.</td>
			<td class="tdsize">
			<input name="e4" type="radio"    value="5"  required>5&nbsp;</input>
			<input name="e4"  type="radio"   value="4"  required>4&nbsp;</input>
			<input name="e4"  type="radio"   value="3"  required>3&nbsp;</input>
			<input name="e4"  type="radio"   value="2"  required>2&nbsp;</input>
			<input name="e4"  type="radio"   value="1" required>1</input>
			 </td>
			</tr>

			</table><BR><BR>
			<table border="1" class="tablesize">
			<tr>
			<td>
			<?php

			$date=date("Y-m-d");

			?>
			Name of evaluator&nbsp;&nbsp;
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;
			&nbsp;&nbsp;&nbsp;&nbsp;
			<input name="noe"  style=" width:18%" type="text" value="<?php  echo $user_data->FName . " ".$user_data->LName ;  ?>" ></input><br>
			</td>
			</tr>
			<tr>
			<td>
			Position of Evaluator&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<input name="poe" style=" width:18%"   type="text" value="<?php  echo $user_data->type; ?>" ></input><br>
			</td>
			</tr>
			<tr>
			<td>
			Date&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			&nbsp;&nbsp;&nbsp;&nbsp;
			:
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<input style=" width:18%" type="text" value="<?php  echo date("m-d-Y"); ?>" ></input>

			</td>
			</tr>

			</table><BR><BR>
			<input style="float:right" type="submit" name="submit" id="submit" value="Evaluate"></input>

		</form>



		 
		</fieldset>

		<fieldset class="mac" >
		  <a  name="print" href="../Faculty-Page/Faculty-Page.php" style="cursor:pointer;"><img style="margin-left:600px;margin-top:5px" src="images/back.png" title="Back" width="70px"></img></a>


		</fieldset>
	</body>
</html>
		