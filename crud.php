<?php 
    include 'dbcon.php';
    // $_POST['name attribute']
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    // die;
    $email = $_POST['email'];
    $mobileno = $_POST['mobileno'];
    $pass= $_POST['pass'];
    $confpass=$_POST['confpass'];
    $dob = date('Y-m-d',strtotime($_POST['datepicker']));
     $gender = $_POST['gender'];
    $education = $_POST['education'];
    $oldImg = $_POST['oldImg'];
    $newimages = $_FILES['img']['name']; 
    $TnCchckbx=$_POST['checkbox'];
    $AdminCheck=$_POST['AdminCheck'];
    $ext_arr = array("jpg","jpeg","png");
    
    
                 // print_r($imageFileType);
                 // die;
                if($newimages != ""){
                    $imgName=$newimages;
                    $imageFileType = strtolower(pathinfo($newimages,PATHINFO_EXTENSION));
                    if(in_array($imageFileType,$ext_arr)){
                        move_uploaded_file($_FILES["img"]["tmp_name"],'images/'.$newimages);
                    }
                }else{
                    $imgName=$oldImg;
                }
        if(isset($_POST['empID']) && $_POST['empID']!=""){
                    $id =$_POST['empID'];
                    // if(isset($_POST['saveBtn']))            
        $updatequery= "UPDATE registration SET `fname`='$fname',`lname`='$lname',`email`='$email',`mobileno`='$mobileno',`password`='$pass',`confpassword`='$confpass',`dob`='$dob',`gender`='$gender',`education`='$education' , `empImgs`='$imgName' ,`Role`='$AdminCheck' ,`TnCcheckbox`='$TnCchckbx' WHERE id=$id";
        $update = mysqli_query($con,$updatequery);
       
        header("Location: employeelist.php?status=updated");

    
    }
    else { 
        // echo "insert" ;die;
        $insertquery= "INSERT INTO registration (`fname`,`lname`,`email`,`mobileno`,`password`,`confpassword`,`dob`,`gender`,`education`,`empImgs`,`Role`,`TnCcheckbox`) VALUES ('$fname','$lname','$email','$mobileno','$pass','$confpass','$dob','$gender','$education','$imgName','$AdminCheck',$TnCchckbx)";
        $iquery = mysqli_query($con,$insertquery);
        // echo mysqli_error($con);
        // die;
        
        header("Location: employeelist.php?status=saved");
    }

    ?>