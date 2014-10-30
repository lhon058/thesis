<!DOCTYPE html>
<html lang ="en">
<head>
<meta charset="UTF-8">
<link rel="stylesheet" href="form.css" type="text/css"/>
<title>Evaluation Form</title>
<!--<?/*php
include('connect.php');

  $get="select * from evaluation_data";

$result2=mysql_query($get) or die(mysql_error());
 
   $get1="select * from signup where studentno='".$_GET['studentno']."'";

$result3=mysql_query($get1) or die(mysql_error());
 $rs=mysql_fetch_array($result3);

 
 */?>-->


</head>
<body>
<form method="post">
<h2 align="center">The QCE of the NBC NO.461<br>
Instrument for instruction/Teaching Effectiveness</h2>
<fieldset class="content" style="width:1000px;" ><br>

<tr >
  <td >
  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  Rating Period:&nbsp;</td>&nbsp;&nbsp;<td><input name="#" type="text" ></input></td></tr>
 <!-- <?/*php
include ('connect.php');
				
						echo "<tr><td>";
						// select course
						
						
                       
    $query = "SELECT SemesterName from semester";
    $result1 = mysql_query($query);
	echo "<select name = 'rate' style=width:150px  >";
    while($row=mysql_fetch_array($result1)){ 
	
       echo "<option value='".$row['SemesterName']."'>".$row["SemesterName"]."</option>";
    }

						
				
				
			
						echo "</select>";
						echo "</tr></td>";
						*/?>-->&nbsp;&nbsp;<td>
  to:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  <input name="#" type="text" ></input></td>
<br><br><br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<tr><td>Name of Faculty:</td>
<td><input name="#" type="text" ></input></td>
</tr>

<!-- <?/*php
include ('connect.php');
				
						echo "<tr><td>";
						// select course
						
						
                       
    $query = "SELECT faculty from faculty";
    $result1 = mysql_query($query);
	echo "<select name = 'faculty' style=width:150px required >";
    while($row=mysql_fetch_array($result1)){ 
	
       echo "<option value='".$row['faculty']."'>".$row["faculty"]."</option>";
    }

						
				
				
			
						echo "</select>";
						echo "</tr></td>";
						*/?>-->




&nbsp;&nbsp;
<tr>Academic Rank:</tr>
<tr><td><input name="#" type="text" ></input></td></tr>
<!-- <?/*php
include ('connect.php');
				
						echo "<tr><td>";
						// select course
						
						
                       
    $query = "SELECT subject from subject ";
    $result1 = mysql_query($query);
	echo "<select name = 'sa' style=width:150px required >";
    while($row=mysql_fetch_array($result1)){ 
	
       echo "<option value='".$row['subject']."'>".$row["subject"]."</option>";
    }

						
				
				
			
						echo "</select>";
						echo "</tr></td>";
						*/?>--><br><br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;
Evaluators:<br>
<div class="cs">
<input class="checkbox" type="checkbox" name="evaluators" value="Self" >Self&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp; </input><input class="checkbox" type="checkbox" name="evaluators" value="Peer" >Peer</input><br>
<input class="checkbox" name="evaluators" type="checkbox" name="d" value="Student" >Student&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</input>&nbsp;<input class="checkbox" name="evaluators" type="checkbox" name="evaluators" value="Supervisor" >Supervisor</input><br><br>
</div>
<center>
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
<input name="a" type="radio" value="5" onclick="ADD('sec1',this.value)" required>5&nbsp;</input>
<input name="a" type="radio" value="4" onclick="ADD('sec1',this.value)" required>4&nbsp;</input>
<input name="a" type="radio" value="3"onclick="ADD('sec1',this.value)" required>3&nbsp;</input>
<input name="a"  type="radio" value="2"onclick="ADD('sec1',this.value)" required>2&nbsp;</input>
<input  name="a" type="radio" value="1"onclick="ADD('sec1',this.value)" required>1</input>
</td>

</tr><tr>
<td class="left">2. Integrates sensitivity his/her learning objectives with those of the students in a collaborative process.</td>
<td class="tdsize" > 
<input name="b" type="radio" value="5" onclick="ADD('sec1',this.value)" required>5&nbsp;</input>
<input name="b" type="radio" value="4" onclick="ADD('sec1',this.value)" required>4&nbsp;</input>
<input name="b" type="radio" value="3"onclick="ADD('sec1',this.value)" required>3&nbsp;</input>
<input name="b" type="radio" value="2"onclick="ADD('sec1',this.value)" required>2&nbsp;</input>
<input name="b" type="radio" value="1"onclick="ADD('sec1',this.value)" required>1</input> </td>

</tr>
<tr>
<td class="left">3. Makes self available beyond official time.</td>
<td class="tdsize">
<input name="c" type="radio" value="5" onclick="ADD('sec1',this.value)" required>5&nbsp;</input>
<input name="c" type="radio" value="4" onclick="ADD('sec1',this.value)" required>4&nbsp;</input>
<input name="c" type="radio" value="3" onclick="ADD('sec1',this.value)" required>3&nbsp;</input>
<input name="c" type="radio" value="2" onclick="ADD('sec1',this.value)" required>2&nbsp;</input>
<input name="c" type="radio" value="1" onclick="ADD('sec1',this.value)" required>1</input> </td>

</tr>
<tr>
<td class="left">4. Regularly comes to class on time, well-groomed and well-prepared to complete assigned responsibilities.</td>
<td class="tdsize">
<input name="d" type="radio" value="5" onclick="ADD('sec1',this.value)" required>5&nbsp;</input>
<input name="d" type="radio" value="4" onclick="ADD('sec1',this.value)" required>4&nbsp;</input>
<input name="d" type="radio" value="3" onclick="ADD('sec1',this.value)" required>3&nbsp;</input>
<input name="d" type="radio" value="2" onclick="ADD('sec1',this.value)" required>2&nbsp;</input>
<input name="d" type="radio" value="1" onclick="ADD('sec1',this.value)" required>1</input> </td>

</tr><tr>

<td class="left">5. Keeps accurate records of students performance and prompt submission of the same.</td>
<td class="tdsize" >
<input name="e" type="radio" value="5" onclick="ADD('sec1',this.value)" required>5&nbsp;</input>
<input name="e" type="radio" value="4" onclick="ADD('sec1',this.value)" required>4&nbsp;</input>
<input name="e" type="radio" value="3" onclick="ADD('sec1',this.value)" required>3&nbsp;</input>
<input name="e" type="radio" value="2" onclick="ADD('sec1',this.value)" required>2&nbsp;</input>
<input name="e" type="radio" value="1" onclick="ADD('sec1',this.value)" required>1</input> </td>
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
<input name="a2" type="radio" onclick="ADD1('sec2',this.value)" value="5" required>5&nbsp;</input>
<input name="a2" type="radio" onclick="ADD1('sec2',this.value)" value="4"  required>4&nbsp;</input>
<input name="a2" type="radio" onclick="ADD1('sec2',this.value)" value="3" required>3&nbsp;</input>
<input name="a2" type="radio" onclick="ADD1('sec2',this.value)" value="2" required>2&nbsp;</input>
<input name="a2" type="radio" onclick="ADD1('sec2',this.value)" value="1" required>1</input> </td>
</tr><tr>
<td class="left">2. Draws and share information on the state of the art of theory and practice in his/her discipline.</td>
<td class="tdsize"
><input name="b2" type="radio"  onclick="ADD1('sec2',this.value)" value="5" required>5&nbsp;</input>
<input  name="b2" type="radio"  onclick="ADD1('sec2',this.value)" value="4" required>4&nbsp;</input>
<input  name="b2" type="radio"  onclick="ADD1('sec2',this.value)" value="3" required>3&nbsp;</input>
<input  name="b2" type="radio"  onclick="ADD1('sec2',this.value)" value="2" required>2&nbsp;</input>
<input  name="b2" type="radio"  onclick="ADD1('sec2',this.value)" value="1" required>1</input> </td>
</tr><tr>
<td class="left">3. Integrates subject to practical circumstances and learning intents/purposes of students.</td>
<td class="tdsize">
<input  name="c2" type="radio"  onclick="ADD1('sec2',this.value)"  value="5"  required>5&nbsp;</input>
<input name="c2"  type="radio"  onclick="ADD1('sec2',this.value)"  value="4" required>4&nbsp;</input>
<input name="c2"  type="radio"  onclick="ADD1('sec2',this.value)"  value="3"  required>3&nbsp;</input>
<input name="c2"  type="radio"  onclick="ADD1('sec2',this.value)"  value="2"  required>2&nbsp;</input>
<input name="c2"  type="radio"  onclick="ADD1('sec2',this.value)"  value="1"  required>1</input> </td>
</tr>
<tr>
<td class="left">4. Explains the relevance of present topics to the previous lessons and relates the subject matter to relevant current issues and/or daily life activities.</td>
<td class="tdsize">
<input name="d2"  type="radio"  onclick="ADD1('sec2',this.value)" value="5" required>5&nbsp;</input>
<input name="d2"  type="radio"  onclick="ADD1('sec2',this.value)" value="4" required>4&nbsp;</input>
<input name="d2"  type="radio"  onclick="ADD1('sec2',this.value)" value="3" required>3&nbsp;</input>
<input name="d2"  type="radio"  onclick="ADD1('sec2',this.value)" value="2" required>2&nbsp;</input>
<input name="d2"  type="radio"  onclick="ADD1('sec2',this.value)" value="1" required>1</input> </td>
</tr>
<tr>
<td class="left">5. Demonstrates up-to-date knowledge and/or awareness on current trends and issues of the subject.</td>
<td class="tdsize">
<input name="e2"  type="radio" onclick="ADD1('sec2',this.value)" value="5" required>5&nbsp;</input>
<input name="e2"  type="radio" onclick="ADD1('sec2',this.value)" value="4" required>4&nbsp;</input>
<input name="e2"  type="radio" onclick="ADD1('sec2',this.value)" value="3" required>3&nbsp;</input>
<input name="e2"  type="radio" onclick="ADD1('sec2',this.value)" value="2" required>2&nbsp;</input>
<input name="e2"  type="radio" onclick="ADD1('sec2',this.value)" value="1" required>1</input></td>
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
<input name="a3" type="radio"  onclick="ADD2('sec3',this.value)" value="5"  required>5&nbsp;</input>
<input name="a3" type="radio"  onclick="ADD2('sec3',this.value)" value="4" required>4&nbsp;</input>
<input name="a3" type="radio"  onclick="ADD2('sec3',this.value)" value="3" required>3&nbsp;</input>
<input name="a3" type="radio"  onclick="ADD2('sec3',this.value)" value="2" required>2&nbsp;</input>
<input name="a3" type="radio"  onclick="ADD2('sec3',this.value)" value="1" required>1</input>
 </td>
</tr><tr>
<td class="left">2. Enhances student self-esteem and/or gives due recognition to students performance/potentials.</td>
<td class="tdsize">
<input name="b3"  type="radio"  onclick="ADD2('sec3',this.value)" value="5" required>5&nbsp;</input>
<input name="b3"  type="radio"  onclick="ADD2('sec3',this.value)" value="4" required>4&nbsp;</input>
<input name="b3"  type="radio"  onclick="ADD2('sec3',this.value)" value="3" required>3&nbsp;</input>
<input name="b3"  type="radio"  onclick="ADD2('sec3',this.value)" value="2" required>2&nbsp;</input>
<input name="b3"  type="radio"  onclick="ADD2('sec3',this.value)" value="1" required>1</input> </td>
</tr><tr>
<td class="left">3. Allows students to create their own course with objectives and realistically defined student-professor rules and make them accountable for their performance.</td>
<td class="tdsize">
<input name="c3" type="radio"  onclick="ADD2('sec3',this.value)" value="5" required >5&nbsp;</input>
<input name="c3" type="radio"  onclick="ADD2('sec3',this.value)" value="4" required>4&nbsp;</input>
<input name="c3" type="radio"  onclick="ADD2('sec3',this.value)" value="3" required>3&nbsp;</input>
<input name="c3" type="radio"  onclick="ADD2('sec3',this.value)" value="2" required>2&nbsp;</input>
<input name="c3" type="radio"  onclick="ADD2('sec3',this.value)" value="1" required>1</input>

 </td>
</tr>
<tr>
<td class="left">4. Allows students to think independently and make their own decisions and holding them accountable for their perfomance based largely on thier success in executing decisions.</td>
<td class="tdsize">
<input name="d3" type="radio"  onclick="ADD2('sec3',this.value)" value="5"  required>5&nbsp;</input>
<input name="d3" type="radio"  onclick="ADD2('sec3',this.value)" value="4" required>4&nbsp;</input>
<input name="d3" type="radio"  onclick="ADD2('sec3',this.value)" value="3" required>3&nbsp;</input>
<input name="d3" type="radio"  onclick="ADD2('sec3',this.value)" value="2" required>2&nbsp;</input>
<input name="d3" type="radio"  onclick="ADD2('sec3',this.value)" value="1" required>1</input>
</td>
</tr>
<tr>
<td class="left">5. Encourages students to learn beyond what is required and help/guide the students how to apply the concepts learned.</td>
<td class="tdsize">
<input name="e3" type="radio"  onclick="ADD2('sec3',this.value)" value="6" required >6&nbsp;</input>
<input name="e3" type="radio"  onclick="ADD2('sec3',this.value)" value="7" required>7&nbsp;</input>
<input name="e3" type="radio"  onclick="ADD2('sec3',this.value)" value="8" required>8&nbsp;</input>
<input name="e3" type="radio"  onclick="ADD2('sec3',this.value)" value="9" required>9&nbsp;</input>
<input name="e3" type="radio"  onclick="ADD2('sec3',this.value)" value="10" required>10</input>
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
<input name="a4"  type="radio"  onclick="ADD3('sec4',this.value)" value="5"  required>5&nbsp;</input>
<input name="a4"  type="radio"  onclick="ADD3('sec4',this.value)" value="4"  required>4&nbsp;</input>
<input name="a4"  type="radio"  onclick="ADD3('sec4',this.value)" value="3"  required>3&nbsp;</input>
<input name="a4"  type="radio"  onclick="ADD3('sec4',this.value)" value="2"  required>2&nbsp;</input>
<input name="a4"  type="radio"  onclick="ADD3('sec4',this.value)" value="1"  required>1</input>
</td>
</tr><tr>
<td class="left">2. Assumes roles as facilitator , resource  person , coach , inquisitor , integrator , referee in drawing students to contribute to knowledge and understanding of the concepts at hands.</td>
<td class="tdsize">
<input name="b4" type="radio"  onclick="ADD3('sec4',this.value)" value="5"  required>5&nbsp;</input>
<input name="b4" type="radio"  onclick="ADD3('sec4',this.value)" value="4"  required>4&nbsp;</input>
<input name="b4" type="radio"  onclick="ADD3('sec4',this.value)" value="3"  required>3&nbsp;</input>
<input name="b4" type="radio"  onclick="ADD3('sec4',this.value)" value="2"  required>2&nbsp;</input>
<input name="b4" type="radio"  onclick="ADD3('sec4',this.value)" value="1" required>1</input>
 </td>
</tr><tr>
<td class="left">3. Designs and implements learning conditions and experience that promotes healthy exchange and/or confrontations.</td>
<td>
<input name="c4" type="radio"  onclick="ADD3('sec4',this.value)" value="5"  required>5&nbsp;</input>
<input name="c4" type="radio"  onclick="ADD3('sec4',this.value)" value="4"  required>4&nbsp;</input>
<input name="c4" type="radio"  onclick="ADD3('sec4',this.value)" value="3"  required>3&nbsp;</input>
<input name="c4" type="radio"  onclick="ADD3('sec4',this.value)" value="2"  required>2&nbsp;</input>
<input name="c4" type="radio"  onclick="ADD3('sec4',this.value)" value="1" required>1</input>
 </td>
</tr>
<tr>
<td class="left">4. Stuctures / re-structures learning and teaching-learning context to enhance attainment of collective learning objectives.</td>
<td  class="tdsize">
<input name="d4" type="radio"  onclick="ADD3('sec4',this.value)" value="5"  required>5&nbsp;</input>
<input name="d4" type="radio"  onclick="ADD3('sec4',this.value)" value="4" required>4&nbsp;</input>
<input name="d4" type="radio"  onclick="ADD3('sec4',this.value)" value="3" required>3&nbsp;</input>
<input name="d4" type="radio"  onclick="ADD3('sec4',this.value)" value="2" required>2&nbsp;</input>
<input name="d4" type="radio"  onclick="ADD3('sec4',this.value)" value="1" required>1</input>
 </td>
</tr>
<tr>
<td class="left">5. Use of Instructional Materials (audio/video materials , fieldtrips , film showing, computer aided instruction and etc.) to reinforces learning processes.</td>
<td class="tdsize">
<input name="e4" type="radio"  onclick="ADD3('sec4',this.value)" value="6"  required>6&nbsp;</input>
<input name="e4"  type="radio"  onclick="ADD3('sec4',this.value)" value="7" required>7&nbsp;</input>
<input name="e4"  type="radio"  onclick="ADD3('sec4',this.value)" value="8" required>8&nbsp;</input>
<input name="e4"  type="radio"  onclick="ADD3('sec4',this.value)" value="9" required>9&nbsp;</input>
<input name="e4"  type="radio"  onclick="ADD3('sec4',this.value)" value="10" required>10</input>
 </td>
</tr>

</table><BR><BR>
<table border="1" class="tablesize">
<tr>
<td>
<?php

$date=date("Y-m-d");

?>
Name of evaluator&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input name="noe"  style=" width:18%" type="text" value="<?/*php  echo $rs['firstname'] .'&nbsp;&nbsp;'.$rs['middlename'].'&nbsp;&nbsp;'.$rs['lastname'] ;  */?>" ></input><br>
</td>
</tr>
<tr>
<td>
Position of Evaluator&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input name="poe" style=" width:18%"   type="text" value="<?/*php  echo $rs['type']; */?>" ></input><br>
</td>
</tr>
<tr>
<td>
Date&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;
:
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input style=" width:18%" type="text" value="<?/*php  echo $date; */?>" ></input>

</td>
</tr>

</table><BR><BR>
<input style="float:right" type="submit" name="submit" id="submit" value="Evaluate"></input>


<?/*php


if(isset($_POST['submit']))
{
include ('connect.php');
$date=date("Y-m-d");



mysql_query("INSERT INTO evaluation_data(student_no,Rating_Period,Semester_SY,sub_thought,name_of_faculty,evaluators_type,a1,a2,a3,a4,a5,b1,b2,b3,b4,b5,c1,c2,c3,c4,c5,d1,d2,d3,d4,d5,Name_of_evaluator,Position_of_evaluator,date)
  
   
VALUES ('$_GET[studentno]','$_POST[rate]','$_POST[sem]','$_POST[sa]','$_POST[faculty]','$_POST[evaluators]','$_POST[a]','$_POST[b]','$_POST[c]','$_POST[d]','$_POST[e]','$_POST[a2]','$_POST[b2]','$_POST[c2]','$_POST[d2]','$_POST[e2]','$_POST[a3]','$_POST[b3]','$_POST[c3]','$_POST[d3]','$_POST[e3]','$_POST[a4]','$_POST[b4]','$_POST[c4]','$_POST[d4]','$_POST[e4]','$_POST[noe]','$_POST[poe]','$date')") or die(mysql_error()); 

mysql_query("UPDATE evaluation_data SET totala=a1+a2+a3+a4+a5");
mysql_query("UPDATE evaluation_data SET totalb=b1+b2+b3+b4+b5");
mysql_query("UPDATE evaluation_data SET totalc=c1+c2+c3+c4+c5");
mysql_query("UPDATE evaluation_data SET totald=c1+c2+c3+c4+c5");

}
*/?>
</form>



 
</fieldset>

<fieldset class="mac" >
  <a  name="print" href="home.php" style="cursor:pointer;"><img style="margin-left:600px;margin-top:5px" src="images/back.png" title="Back" width="70px"></img></a>


</fieldset>
</body>
</html>
		