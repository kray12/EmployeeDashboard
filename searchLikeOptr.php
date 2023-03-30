<?php
include "dbcon.php";
$searchValue= $_GET["search"];
// $lname = $_GET["search"];
// $email = $_GET["search"];
if($searchValue){
$srcQ = "SELECT * FROM registration WHERE fname  LIKE '%$searchValue%' OR  email  LIKE '%$searchValue%' OR lname  LIKE '%$searchValue%'  ";}

$srcRes = mysqli_query($con, $srcQ);
// print_r(mysqli_num_rows($srcRes));
$totalRows = mysqli_num_rows($srcRes);
$data = [];
if (mysqli_num_rows($srcRes) > 0) {

    $data['status'] = 1;

    $i = 0;
    while ($rows = mysqli_fetch_array($srcRes)) {

        $data['data'][$i] = $rows;
        $i++;
    }
} else {
    $data['status'] = 0;
    $data['data'] = [];
}
echo json_encode($data);
?>