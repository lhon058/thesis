<!DOCTYPE html>

<?php include_once("Session.php"); ?>

<html lang ="en">
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="login.css" type="text/css"/>
	<link rel="stylesheet" href="registration.css" type="text/css"/>
					<link href="css/bootstrap/css/font-awesome.css" rel="stylesheet" media="screen"/>

	
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Faculty Evaluation System</title>
  <script type="text/javascript">
  function redirect(page){
        window.location.assign(page)
    }
  </script>
</head>
<body>
<div class="indexpage">
 		<div class="header">
    <div class="navigation_bar"></div>
  		</div>
<div class="gitna">
<div class="student_center">
  
  <div class="copyright">
    Copyright © 2013 
    Sorsogon State College-Bulan Campus, All Rights Reserved .
</div>



     <div class="registration"></div>
      <div class="menu">
	
			<ul id="MenuBar2" class="MenuBarVertical">
			<li><a href="index.php">Home</a></li>
			<li><a href="?redir=student_login">Student</a></li>
			<li><a href="?redir=faculty_login">Faculty</a></li>
			<li><a href="?redir=admin_login">Admin</a></li>
			<li><a href="#">Developers</a></li>
			<li><a href="#">Contacts</a></li>
			</ul>
</div>
  
</div>
  </div>

</div>

<div class="student_login">
<div class="login_content">
  <form id="form1" name="form1" method="post" action="login.php">
<div class="login">
  <p>
<input class="text" type="text" name="username" id="username" placeholder="ID Number: 00-0000"/>
 <input class="text" type="password" name="password" id="password"  placeholder="Password"/>
    </p>
  <p>
    <input  type="submit" name="submit" id="submit" value="Log In" />
      <input  type="button" onclick="redirect('Register-Students.php')" name="register" id="submit" value="Register" />

  </p>
   <p>&nbsp;</p>
</div>
<br>
<span style ='color:white;'> <?php echo Session::flash("message");?></span>
</form></div>
</div>
</body>

</html>
		