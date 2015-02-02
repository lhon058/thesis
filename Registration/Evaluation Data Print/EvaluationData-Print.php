<!DOCTYPE html>
<html lang ="en">
<head>
<meta charset="UTF-8">
<link rel="stylesheet" href="form.css" type="text/css"/>
<title>Evaluation Form</title>
<script>
        function printDiv(divID) {
            //Get the HTML of div
            var divElements = document.getElementById(divID).innerHTML;
            //Get the HTML of whole page
            var oldPage = document.body.innerHTML;

            //Reset the page's HTML with div's HTML only
            document.body.innerHTML = 
              "<nav>" + 
              divElements + "</nav>";

            //Print Page
            window.print();

            //Restore orignal HTML
            document.body.innerHTML = oldPage;
        }
    </script>

</head>
<body>
<div id="printablediv" style="margin-left:50px">
<form method="post" action = "evaluation_process.php" >
<h2 align="center">The QCE of the NBC NO.461<br>
Instrument for instruction/Teaching Effectiveness</h2>
<fieldset class="content" style="width:1000px;" ><br>


<tr >
  <td >
  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  Rating Period:&nbsp;</td>&nbsp;&nbsp;
 
  
  
  
  
<td>
<input type = "hidden" name = "schedule_id" value = "" />
<input name="start" type="text" readonly="readonly" value=""> </input>
</td>
</td>
    <!--End-->
&nbsp;&nbsp;<td>
  to:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  <input name="end" type="text" readonly="readonly" value=""></input></td>
<br><br><br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<tr><td>Name of Faculty:</td>


    <td>
        <input name="end" readonly="readonly" type="text" disabled value = ""> 
	   </td>
        </td>
  
&nbsp;&nbsp;
<tr>Academic Rank:</tr>
<tr><td><input name="end" readonly="readonly" type="text" disabled value = ""></td></tr>
<br><br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;


<span> Evaluators: <b><i> </i>
<input name="end" readonly="readonly" type="text" disabled value = "">  

</b> </span><br>

<div class="cs">
<br><br>
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
<input class="text" readonly="readonly" type="text"   value=""></input>
</td>

</tr><tr>
<td class="left">2. Integrates sensitivity his/her learning objectives with those of the students in a collaborative process.</td>
<td class="tdsize" > 
<input class="text" readonly="readonly" type="text"   value=""></input> </td>

</tr>
<tr>
<td class="left">3. Makes self available beyond official time.</td>
<td class="tdsize">
<input class="text" readonly="readonly" type="text"   value=""></input></td>

</tr>
<tr>
<td class="left">4. Regularly comes to class on time, well-groomed and well-prepared to complete assigned responsibilities.</td>
<td class="tdsize">
<input class="text" readonly="readonly" type="text"   value=""></input></td>

</tr><tr>

<td class="left">5. Keeps accurate records of students performance and prompt submission of the same.</td>
<td class="tdsize" >
<input class="text" readonly="readonly" type="text"   value=""></input> </td>
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
<input class="text" readonly="readonly" type="text"   value=""></input> </td>
</tr><tr>
<td class="left">2. Draws and share information on the state of the art of theory and practice in his/her discipline.</td>
<td class="tdsize">
<input class="text" readonly="readonly" type="text"   value=""></input> </td>
</tr><tr>
<td class="left">3. Integrates subject to practical circumstances and learning intents/purposes of students.</td>
<td class="tdsize">
<input class="text" readonly="readonly" type="text"   value=""></input> </td>
</tr>
<tr>
<td class="left">4. Explains the relevance of present topics to the previous lessons and relates the subject matter to relevant current issues and/or daily life activities.</td>
<td class="tdsize">
<input class="text" readonly="readonly" type="text"   value=""></input> </td>
</tr>
<tr>
<td class="left">5. Demonstrates up-to-date knowledge and/or awareness on current trends and issues of the subject.</td>
<td class="tdsize">
<input class="text" readonly="readonly" type="text"   value=""></input></td>
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
<input class="text" readonly="readonly" type="text"   value=""></input>
 </td>
</tr><tr>
<td class="left">2. Enhances student self-esteem and/or gives due recognition to students performance/potentials.</td>
<td class="tdsize">
<input class="text" readonly="readonly" type="text"   value=""></input> </td>
</tr><tr>
<td class="left">3. Allows students to create their own course with objectives and realistically defined student-professor rules and make them accountable for their performance.</td>
<td class="tdsize">
<input class="text" readonly="readonly" type="text"   value=""></input>

 </td>
</tr>
<tr>
<td class="left">4. Allows students to think independently and make their own decisions and holding them accountable for their perfomance based largely on thier success in executing decisions.</td>
<td class="tdsize">
<input class="text" readonly="readonly" type="text"   value=""></input>
</td>
</tr>
<tr>
<td class="left">5. Encourages students to learn beyond what is required and help/guide the students how to apply the concepts learned.</td>
<td class="tdsize">
<input class="text" readonly="readonly" type="text"   value=""></input>
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
<input class="text" readonly="readonly" type="text"   value=""></input>
</td>
</tr><tr>
<td class="left">2. Assumes roles as facilitator , resource  person , coach , inquisitor , integrator , referee in drawing students to contribute to knowledge and understanding of the concepts at hands.</td>
<td class="tdsize">
<input class="text" readonly="readonly" type="text"   value=""></input>
 </td>
</tr><tr>
<td class="left">3. Designs and implements learning conditions and experience that promotes healthy exchange and/or confrontations.</td>
<td>
<input class="text" readonly="readonly" type="text"   value=""></input>
 </td>
</tr>
<tr>
<td class="left">4. Stuctures / re-structures learning and teaching-learning context to enhance attainment of collective learning objectives.</td>
<td  class="tdsize">
<input class="text" readonly="readonly" type="text"   value=""></input>
 </td>
</tr>
<tr>
<td class="left">5. Use of Instructional Materials (audio/video materials , fieldtrips , film showing, computer aided instruction and etc.) to reinforces learning processes.</td>
<td class="tdsize">
<input class="text" readonly="readonly" type="text"   value=""></input>
 </td>
</tr>

</table><BR><BR>
<table border="1" class="tablesize">
<tr>
<td>

Name of evaluator&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input class="text" readonly="readonly" type="text"   value=""></input><br>
</td>
</tr>
<tr>
<td>
Position of Evaluator&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input class="text" readonly="readonly" type="text"   value=""></input></input><br>
</td>
</tr>
<tr>
<td>
Date&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;
:
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input class="text" readonly="readonly" type="text"   value=""></input></input>

</td>
</tr>

</table><BR><BR>
<input style="float:right" type="submit"  name="submit" id="submit" value="Evaluate"></input>

</form>
</div>


 
</fieldset>

<fieldset class="mac" >
  <a  name="print" href="home.php" style="cursor:pointer;"><img style="margin-left:600px;margin-top:5px" src="images/back.png" title="Back" width="70px"></img></a>
  <a  name="print" style="cursor:pointer;" onClick="javascript:printDiv('printablediv')"><img style="margin-left:700px;margin-top:-65px"  src="images/print.png" title="Print Evaluation Form" width="70px"></img></a>


</fieldset>
</body>
</html>
		