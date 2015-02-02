<!DOCTYPE html>
<html lang ="en">
	<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="registration.css" type="text/css"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Faculty Evaluation System</title>
	</head>
  <script type="text/javascript">
    function myFunction() {
        var pass1 = document.getElementById("pass1").value;
        var pass2 = document.getElementById("pass2").value;
        if (pass1 != pass2) {
            alert("Passwords Do not match");
            
        }
        else {
            alert("Passwords Match!!!");
            document.getElementById("regForm").submit();
        }
    }
</script>
	<body>
	<div class="indexpage">
 		<div class="header">
    <div class="navigation_bar"></div>
  		</div>
 <div class="body"></div>
<div class="gitna">
<div class="student_center">
  
  <div class="copyright">
    Copyright © 2013 
    Sorsogon State College-Bulan Campus, All Rights Reserved .
</div>



     <div class="registration"></div>
    <div class="announcement_header"><img src="images/ssc.jpg" width="732" height="572" /></div>
      <div class="menu">
	
			<ul id="MenuBar2" class="MenuBarVertical">
			<li><a href="#">Home</a></li>
      <li><a href="Login-Students.php">Student</a></li>
      <li><a href="Login-Faculty.php">Faculty</a></li>
      <li><a href="Login-Admin.php">Admin</a></li>
      <li><a href="#">Developers</a></li>
      <li><a href="#">Contacts</a></li>
			</ul>
  
    
</div>
  
</div>
  </div>

</div>

	</body>
	<div class="activation">
<div class="signup_form">
<form id="form1" name="form1" method="post" action="add-Faculty.php">
<table width="678" height="386" border="0">
<tr>
    <td height="10">Name:
    <input type="text" name="FName" required id="stud_id" placeholder="First Name" />
    <input type="text" name="MInit" size = "7" required id="stud_id" placeholder="Middle Initial" />
    <input type="text" name="LName" required id="stud_id" placeholder="Last Name" />
    </td> 
</tr>
<tr>
    <td height="10">User Name:
    <input type="text" name="username" required id="username" placeholder="Username" /></td>
</tr>
<tr>
    <td height="10">Age:
    <input type="text" name="age" required id="age" placeholder="Age" /></td> 
</tr>  
<tr>
    <td height="10">Password:
      <input required  type="password" name="password" id="pass1" placeholder="Password" >
  	</td>
</tr>
<tr>
    <td height="10">Confirm Password:
    <input required type="password" name="cpassword" id="pass2" placeholder="Confirm Password" onblur="myFunction()"></td>
</tr>
<tr>
    <td height="10">Type:
      <select name="type">
        <option >Select</option>
        <option value="Student">Student</option>
        <option value="Faculty" selected>Faculty</option>
      </select>
    </td>
</tr>
<tr>
    <td height="26">&nbsp;</td>
    <td>
    <input type="submit" name="submit"  value="Register" >
   
    <input type="reset" name="reset" id="" value="Clear Entries"></td>
</tr>
</table>
</form></div></div>

</html>











