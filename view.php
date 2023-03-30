<?php
include "dbcon.php";


$ids = $_GET['id'];
$showq = "SELECT * FROM registration WHERE id='$ids'";
$showresult = mysqli_query($con, $showq);
$arrdata = mysqli_fetch_array($showresult);
// print_r($arrdata); 
echo json_encode($arrdata);
?>