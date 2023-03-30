<?php 
include "dbcon.php";
session_start();
// print_r(($_POST));
// die;

if(isset($_GET["textId"])){
    $textId=$_GET['textId'];
    $empID=$_SESSION['empID'];
$isTaskCompleted = 0;
$completed = mysqli_query($con,"SELECT completed FROM todolist WHERE id= '$textId'"  );
$completedres = mysqli_fetch_array($completed);
// print_r($completedres['completed']);
// die;
if($completedres['completed']==0){
    $isTaskCompleted = 1;
}

$tdlquery = "UPDATE  todolist SET completed='$isTaskCompleted' WHERE id= '$textId' ";
mysqli_query($con,$tdlquery);
// header("Location: dashboard.php");
$isCompleted = new stdClass();
 $isCompleted->isTaskCompleted = $isTaskCompleted;
echo json_encode($isCompleted) ;
// echo json($isCompleted) ;

}

if(isset($_POST["TDLBTN"])){
     $daTe=date('Y-m-d');
    if(isset($_POST['selectedDate']) && $_POST['selectedDate'] != ""){
        $daTe=$_POST['selectedDate'];
    }

     $todolistinput=$_POST['tdlinput'];
     $empID=$_SESSION['empID'];

$tdlquery = "INSERT INTO  todolist ( `emp_id`,`task`,`date_created`) VALUES ('$empID','$todolistinput','$daTe') ";
mysqli_query($con,$tdlquery);
header("Location: dashboard.php?date=".$daTe);

}
?>