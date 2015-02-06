<!DOCTYPE html>

<?php

// reset function for student and faculty login

include_once("db_connect.php");

$query = "UPDATE `faclogin` SET `status` = 0 WHERE `status` = 1";

$res = $connect->query($query);

if($res)
{
	$query_nxt = "UPDATE `signup` SET `logged_in` = 0 WHERE `logged_in` = 1";
	$res = $connect->query($query);
	
	if($res)
		echo "";
	else
		die("Unexpected Error : Contact SysAdmin #123");
}
else
{
		die("Unexpected Error : Contact SysAdmin #123");
}

?>


<html lang ="en">
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="login.css" type="text/css"/>
	<link rel="stylesheet" href="registration.css" type="text/css"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Faculty Evaluation System</title>
</head>
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

</body>
<div class="student_login">
<div class="login_content">
  <form id="form1" name="form1" method="post" action="login.php">
<div class="login">
  <p>
  <input class="text" type="text" name="username" id="username" placeholder="ID Number: 00-0000"/>
   <input class="text" type="password" name="password" id="Password" placeholder="Password" />
    </p>
  <p>
    <input  type="submit" name="submit" id="submit" value="Log In" />
    <input  type="reset" name="button2" id="button2" value="Clear Entries" />
  </p>
   <p>&nbsp;</p>
</div>
<span style ='color:white;'> <?php echo Session::flash("message");?></span>
</form></div>
</div>
</html>
		