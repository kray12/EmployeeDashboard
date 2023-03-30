<?php
include "dbcon.php";
// die;

if(isset($_GET['id'])){
   $ids = $_GET['id'];
   
   $delete = "DELETE FROM registration WHERE id= $ids" ;
   $delq = mysqli_query($con,$delete);

// if (mysqli_query($con, $delq)) {
//    echo "Record deleted successfully";
// } else {
//    echo "Error deleting record: " . mysqli_error($con);
// }
}
   
header("Location: employeelist.php?");

?>