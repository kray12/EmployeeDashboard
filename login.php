<?php
include "dbcon.php";
session_start();

  if(isset($_POST["loginBtn"])){
    $loginInput = $_POST["emailLogin"];
    $loginPass = $_POST["passswd"];
    $loginMatch = "SELECT id,fname, lname ,empImgs,Role FROM registration WHERE email='$loginInput' AND confpassword ='$loginPass'";
    $loginMatchRes = mysqli_query($con, $loginMatch);
    $count = mysqli_num_rows($loginMatchRes);
    $fetchlogin= mysqli_fetch_array($loginMatchRes);
    // print_r($fetchlogin["Role"]);
    // die;
    $fnameLogin=$fetchlogin['fname'] ;
    $lnameLogin=$fetchlogin['lname'] ;
    $EmpimgLogin=$fetchlogin['empImgs'] ;
    $EmploginID=$fetchlogin['id'];
    $EmploginRole=$fetchlogin['Role'];
    
    // if($fetchlogin["Role"]=="1"){
    //     $EmploginRole=$fetchlogin['Role'];
    //     $_SESSION['AdminRole']= $EmploginRole;
    //     // header("Location: dashboard.php");
    //     $_SESSION['username']=$fnameLogin." ".$lnameLogin; 
    //     $_SESSION['empImges']= $EmpimgLogin;
    //     $_SESSION['empID']= $EmploginID;
    // }
    // }else{
    //     $_SESSION['login_email']=$loginInput;
      
    
  if($count>0){
      $_SESSION['login_email']=$loginInput;
      $_SESSION['username']=$fnameLogin." ".$lnameLogin; 
      $_SESSION['empImges']= $EmpimgLogin;
      $_SESSION['empID']= $EmploginID;
      $_SESSION['empRole']= $EmploginRole;
      header('location:dashboard.php');
  }
      
    }
  
   
  ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">

    <!-- bootsrap CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Login Page</title>
    <style>
    span {
        color: red;
    }
    </style>
</head>

<body>
    <div class="container">
        <h1> LOGIN PAGE</h1>
        <form action="" method="POST" id='logiForm' name="login" onsubmit="return checklogin()">
            <div class="row mb-3">
                <label for="login" class="col-sm-2 col-form-label">Login ID </label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="emailLogin" id="emailLogin">
                    <span id=loginErr></span>
                </div>
            </div>
            <div class="row mb-3">
                <label for="pass" class="col-sm-2 col-form-label">Password</label>
                <div class="col-sm-10">
                    <input type="password" class="form-control" name="passswd" id="passID">
                    <span id=pasErr></span>
                </div>
            </div>

            <button type="submit" class="btn btn-primary" name='loginBtn' form="logiForm" id="loginBtn">Sign in</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- // <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"> </script>

    <script>
    function undoErr() {
        $('#loginErr').hide();
        $('#pasErr').hide();
    }

    function checklogin() {
        undoErr();

        var loginIdVal = $("#emailLogin").val();
        var passVAl = $('#passID').val();
        errorCount = 0;

        if (loginIdVal == "") {
            $("#loginErr").html("**This Email id is not register");
            $('#loginErr').show();
            errorCount++;
        }
        if (passVAl == "") {
            $("#pasErr").html("**enter correct password");
            $('#pasErr').show();
            errorCount++;
        }
        // alert(1);
        if (errorCount > 0) {
            return false;
        } else {

            // $("#logiForm").submit();
            return true;
        }
    }
    $(document).ready(function() {



        // $(document).on('click', '#loginBtn', function(e) {

        //     e.preventDefault;
        //     checklogin();
        //     undoErr();

        // })

    })
    </script>

</body>





<!-- bootstrap link JavaScript Bundle with Popper -->

</html>