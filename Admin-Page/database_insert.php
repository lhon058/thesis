<?php 
$server = 'localhost';
$username = 'root';
$password = '';
$db = 'evaluation_db';

$connect = new mysqli($server,$username,$password,$db);

$insert="INSERT INTO evaluation_db.instructor (
   instructorID,
   FName,
   LName,
   MName,
   FullName
)
SELECT InstructorID,FName,LName,MidInit,FullName
FROM ssc_enrollment.instructor
");
 
$insert2="INSERT INTO evaluation_db.instructor (
   studentID,
   StudentNo,
   FName,
   MName,
   LName,
   FullName
)
SELECT studentID,StudentNo,LName,FName,MName,FullName
FROM ssc_enrollment.student
");
$connect->close();
 ?>
