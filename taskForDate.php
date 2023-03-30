<?php
include "dbcon.php";
session_start();

$date=$_GET['date'];
// echo $date; 
// die;
$empID=$_SESSION['empID'];

$taskdateQ = "SELECT * FROM todolist WHERE emp_id='$empID' AND date_created LIKE '$date%'";
$taskdatefire = mysqli_query($con,$taskdateQ );
// echo mysqli_error($con);
// die;
//SELECT * FROM todolist WHERE emp_id='$empID' AND date_created LIKE '' 2022-08-25 '%'
 
 $taskdatedata = mysqli_fetch_array($taskdatefire);

echo json_encode($taskdatedata);
?>

