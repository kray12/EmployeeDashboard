<?php


include 'dbcon.php';
session_start();
// print_r($_SESSION['login_email']);
// print_r($_SESSION['empRole']);
// die;
if(!isset($_SESSION['empRole'])  && $_SESSION['empRole']!=1){
    header("Location:login.php.php");    
}  

$isEditPage = false;
$ids = "";

if (isset($_GET['id'])) {
    // print_r( $_GET);
    $isEditPage = true;
    $ids = $_GET['id'];
    $showq = "SELECT * FROM registration WHERE id='$ids'";
    $showresult = mysqli_query($con, $showq);
    $arrdata = mysqli_fetch_array($showresult);


    if (count($arrdata) > 0) {
        // print_r( $arrdata['Role']);
        // die;

        $fn = $arrdata['fname'];
        $ln = $arrdata['lname'];
        $em = $arrdata['email'];
        $mob = $arrdata['mobileno'];
        $passwd = $arrdata['password'];
        $confpasswd = $arrdata['confpassword'];
        $date  = date('d-m-Y', strtotime($arrdata['dob']));
        $gen = $arrdata['gender'];
        $edu = $arrdata['education'];
        $photo = $arrdata['empImgs'];
        $adminCheck=$arrdata['Role'];
        $TnCchkbx=$arrdata['TnCcheckbox'];
    }
} else {
    $fn = null;
    $ln = null;
    $em = null;
    $mob = null;
    $passwd = null;
    $confpasswd = null;
    $date = null;
    $gen = "";
    $edu = null;
    $photo = null;
    $adminCheck="";
    $TnCchkbx="";
}
// echo $isEditPage;


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="//cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">




    <title>Student registration</title>
    <style>
    label {
        font-size: 20px;
    }

    #gg {
        font-size: 20px;
    }

    span {
        color: red;

    }

    .error {
        color: red;
        font-size: 14px;
    }

    #edtbtn {

        color: white;
        padding-right: 15px;
        padding-left: 15px;
    }

    #edtbtn>a {
        text-decoration: none;

    }
    </style>

</head>

<body>
    <?php include "header.php" ?>
    <div class="container">

        <div class="row">
            <h1> <?php if ($isEditPage) { ?> Edit Employee <?php } else { ?> Add Employee <?php } ?> </h1>
        </div>
        <form action="crud.php" method="post" id="formVal" enctype='multipart/form-data'>
            <input type="hidden" name="empID" value="<?= $ids ?>">
            <!-- onsubmit="return checkInput()" // onsubmit="return validateinput()" -->
            <div class="from-group row ">
                <div class="col-sm-3">
                    <label for=" first name">First name </label>
                </div>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="fname" name="fname" value="<?= $fn ?>"
                        placeholder="Enter first name"> <span id="fnameErr"></span>
                </div>

            </div><br>
            <div class="from-group row">
                <div class="col-3">
                    <label for=" last name">Last name </label>
                </div>
                <div class="col-9">
                    <input type="text" class="form-control" id="lname" name="lname" value="<?= $ln ?>"
                        placeholder="Enter Last name"> <span id="lnameErr"></span>
                </div>

            </div><br>
            <div class="form-group row">
                <div class="col-3"><label for="email1">Email address</label></div>
                <div class="col-9"><input type="text" class="form-control" name="email" id="email" value="<?= $em ?>"
                        placeholder="Enter email"><span id="emailErr"></span>

                </div>

            </div>
            <div class="form-group row">
                <div class="col-3"><label for="mobile">Mobile no.</label></div>
                <div class="col-9"><input type="text" class="form-control" name="mobileno" id="mobileno"
                        value="<?= $mob ?>" placeholder="enter mobile no."><span id="mobileErr"></span>

                </div>
            </div>
            <div class="form-group row">
                <div class="col-3"><label for="password">Password</label> </div>
                <div class="col-9"><input type="password" class="form-control" id="pass" name="pass"
                        value="<?= $passwd ?>" placeholder="Enter your Password"> <span id="passErr"></span></div>
            </div>

            <div class="form-group row">
                <div class="col-3"><label for="confirmpassword">Confirm Password</label> </div>
                <div class="col-9"><input type="password" class="form-control" id="confpass" name="confpass"
                        value="<?= $confpasswd ?>" placeholder="Rewrite your confirm password"> <span
                        id="confpassErr"></span></div>
            </div>

            <div class="form-group row">
                <div class="col-3"><label for="dob" class="control-label">Date of Birth</label></div>
                <div class="col-9"><input type="text" class="form-control" id="datepicker" name="datepicker"
                        placeholder="Enter your Date OF Birth" value="<?= $date ?>"> <span id="dobErr"></span></div>
            </div>
            <div class="form-group row">
                <div class="col-3"> <label for="gender">Gender</label><br></div>

                <div class="col-9">
                    <input type="radio" id="male" name="gender" <?php if ($gen === "male") {
                                                                    echo ("checked");
                                                                } ?> value="male">
                    <label for="male">Male</label>
                    <input type="radio" id="female" name="gender" <?php if ($gen === "female") {
                                                                        echo ("checked");
                                                                    } ?> value="female">
                    <label for="female">Female</label><br>
                    <span id="genderErr"></span>
                </div>
            </div>

            <div class="from-group row">
                <div class="col-3"><label for="Education"> Education</label> </div>
                <div class="col-9">
                    <select class="form-control" name="education" id="education">
                        <option value=""></option>
                        <option <?php if ($edu === "Graduation") {
                                    echo ("selected");
                                } ?> value="Graduation">Graduation</option>
                        <option <?php if ($edu === "HSC") {
                                    echo ("selected");
                                } ?> value="HSC">Higher Secondary </option>
                        <option <?php if ($edu === "SSC") {
                                    echo ("selected");
                                } ?> value="SSC">Senior Secondarry</option>
                    </select>
                    <span id="educationErr"></span>
                </div>
            </div>
            <br>
            <div class="from-group row">
                <input type="hidden" name="oldImg" value=<?= $photo ?>>
                <div class="col-3">
                    <label for="File"> Photo</label>
                </div>
                <div class="col-9">
                    <input type="file" class="form-control" id="img" name="img"> <span id="imgErr"></span><br>
                    <?php if (isset($_GET['id'])) { ?>
                    <img id="output" height="100" width="100" src='images/<?=$photo?>'>
                    <?php } else { ?><img id="output"> <?php } ?>
                    <span id="imgErr"></span>
                </div>

            </div><br>
            <?php if (!$isEditPage) { ?>
            <div class="form-group row">
                <div class="col-3"></div>
                <div class="col-9">
                    <label><input type="checkbox" class="form-check-input" name="AdminCheck" id="AdminCheck" value="1" <?php if ($adminCheck === "1") {
                                                                    echo ("checked");
                                                                } ?>>
                        Is Admin</label><br>
                    <input type="checkbox" class="form-check-input" name="checkbox" id="checkbox" value="1"
                        <?php if ($TnCchkbx === "1") { echo ("checked"); } ?>>
                    <label class="form-check-label " for="checkbox">I agree to the terms and conditions</label><br>
                    <span id="checkboxErr"></span>

                </div>
                <?php }?>

            </div>
            <div class="row">
                <div class="col" id="edtbtn">
                    <?php if($_SESSION['empRole']==1) {?>
                    <a href="employeelist.php"><button type="button" class="btn btn-danger btn-lg btn-block" id="btn1">
                            Back to list </button></a>
                    <?php } else{ ?>
                    <a href="dashboard.php" class="btn btn-danger btn-lg btn-block">Dashboard</a>
                    <?php } ?>
                </div>

                <div class="col">
                    <?php if ($isEditPage) { ?>
                    <button type="submit" class="btn btn-success btn-lg btn-block" id="saveBtn" name="update"> UPDATE
                    </button>
                    <?php } else { ?>
                    <button type="submit" class="btn btn-success btn-lg btn-block" id="saveBtn" name="submit"> SUBMIT
                    </button>
                    <?php } ?>
                </div>

            </div>

        </form>

    </div>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script> -->
    <!-- <script src="https://code.jquery.com/jquery-3.6.0.slim.min.js"></script> -->
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="sweetalert.js "></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>

    <script src="//cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"> </script>
    <!-- <script src="rawJquery.js"></script> -->
    <script src="form.js"></script>

    <script>
    //< input type = "file" accept = "images/*" onchange = "loadFile(event)" >
    $(document).on('change', '#img', function(event) {

        console.log(event);
        // console.log(event.target.files[0].size);
        var tmppath = URL.createObjectURL(event.target.files[0]);
        if (tmppath != "") {
            var imgSizeVal = event.target.files[0].size;
            // console.log(event.target.files[0]);
            if (imgSizeVal > 20000) {
                $('#output').hide();
                $("#imgErr").html("**image size must be less than 2kb");
                $("#imgErr").show();
                return false;
            } else {
                $("#imgErr").html("**image size must be less than 2kb");
                $("#imgErr").hide();
                $('#output').attr('src', tmppath);
                $('#output').attr('height', "100px");
                $('#output').attr('width', "100px");
                $('#output').show();
            }
        } else {
            $('#output').hide();
            $("#imgErr").hide();

        }

    })

    // $(function userDetailsEventHandlers() {
        $("#datepicker").datepicker({
            changeMonth: true,
            changeYear: true,
            dateFormat: 'dd-mm-yy',
            yearRange: '1905:2050',
            //  console.log(datepicker());


        })
    // });
    </script> 




</body>

</html>