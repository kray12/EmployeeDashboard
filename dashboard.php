<?php 
include 'dbcon.php';
session_start();
echo $_SESSION['empID'];
// $_SESSION['empRole']=false;
if(!isset($_SESSION['login_email']))
{   
    header("Location: login.php");
}



?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js"></script>
    <!-- <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script> -->


    <!-- CSS only -->
    <style>
    #empImgggg {
        border-radius: 50%;
    }

    #btnsCSS {
        /* margin-top: %; */
        padding: 2%;
    }

    #Modimg {
        /* align-items: center; */
        display: flex;
        justify-content: center;
        height: 100px;
        width: 100px;
    }

    #TDLcontainer {
        margin-top: 5%;
        margin-right: 3%;
        padding: 1%;
        background: #6699CC;
        color: white;
    }

    h3 {
        text-align: center;
    }

    #BTNStdl {
        padding: 3%;
    }

    #tdlOL {
        padding: 2%;

    }
    .taskCmpltCss{
        text-decoration:line-through;
        color:red;
    }
    </style>
</head>

<body>

    <?php include "header.php" ?>
    <div class="row">

        <?php if($_SESSION['empRole']==1) {?>

        <div class="col" id="btnsCSS">
            <a href="addEmployee.php" class="btn btn-danger btn-block ">Add Employee</a>
        </div>
        <div class="col" id="btnsCSS">
            <a href="employeelist.php" class="btn-primary btn btn-block ">Employee List</a>
        </div>
        <?php } else{ ?>
        <div class="col" id="btnsCSS">
            <button class="btn btn-success btn-block " data-toggle="modal" data-target="#ModelView"
                onclick="ViewMod(<?= $_SESSION['empID'] ?>)"> View Profile </button>
        </div>
        <div class="col" id="btnsCSS">
            <a href="addEmployee.php?id=<?=$_SESSION['empID']?>" class="btn-primary btn btn-block ">Edit Profile</a>
        </div>
        <?php } ?>
<!-- to do list codes -->
        <div class="col">
                 <div id="TDLcontainer">
                    <form action="tdldb.php" method="POST">
                    <h3> To Do List</h3>
                    <div class="row">
                        <div class="col">
                            <input type="text" class="form-control" value="" name="date" id="datepicker" placeholder="Search By Date">
                            <input type="hidden" value="<?php if(isset($_GET['date'])){ echo $_GET['date']; } ?>" name="selectedDate" >
                        </div>
                        <!-- <div class="col-3"> 
                            <button class="btn btn-Info" type="button" id="searchBtn" name="searchBtn"> Search</button>
                        </div> -->
                    </div>
                    
                    <div class="row" id=BTNStdl>
                        <lable id="searchedDate"> Your Selected Date : <?php 
                            if(isset($_GET['date']) && $_GET['date'] != ""){
                                echo date('d-m-Y',strtotime($_GET['date']));
                            }else{
                                echo date('d-m-Y');
                            } ?>
                        </lable>
                        <!-- <div class="col"> <a href="dashboard.php?date=<?= date('Y-m-d', strtotime('now - 1day')) ?>"
                                name="PrevDate" class="btn btn-danger btn-sm btn-block ">
                                Previous List </a></div> -->
                        <!-- <div class="col"> <a href="dashboard.php?date=<?= date('Y-m-d')?>" name="TodayDate"
                                class="btn btn-primary btn-sm btn-block ">Today </a></div> -->
                        <!-- <div class="col"> <a href="dashboard.php?date=<?= date('Y-m-d', strtotime('now + 1day')) ?>"
                                name="NxtDate" class="btn btn-success btn-sm btn-block ">Next Day </a>
                        </div> -->
                    </div>
                    <div class="row" id="TDLdivInput">
                        <div class="col-9">
                            <input type="text" class="form-control" value="" name="tdlinput" id="TDLInput" placeholder="Your Task Here">
                        </div>
                        <div class="col-3"> 
                            <button class="btn btn-secondary TDLaddBtn" type="submit" name="TDLBTN"><i class="fa fa-plus-circle" aria-hidden="true"></i> ADD</button>
                        </div>
                    </div>
                    <div id="tdlOL">
                        <?php
                        if(isset($_GET['date'])&& $_GET['date']!="" ) {

                            $date=$_GET['date'];
                        }else {
                            $date=date('Y-m-d');
                        }
                         if(isset($_SESSION['empID'])){
                            $tdlid=$_SESSION['empID'];
                            $tdlselt= "SELECT * FROM todolist WHERE emp_id=$tdlid AND DATE(date_created) LIKE '$date%'  " ;
                            
                            $tdlfire=mysqli_query($con, $tdlselt);
                            $sno=0;
                          while( $tdlres = mysqli_fetch_array($tdlfire))
                          {?>
                          <?= ++$sno ?>
                          <span class="ptext <?php if($tdlres['completed']==1){
                                                    echo "taskCmpltCss";
                                                    } ?>"text-id="<?= $tdlres['id'] ?>"> 
                                                    <?= $tdlres['task'] ?>
                           </span><br>
                        <?php }} ?>
                    </div>
                  </div>
            </form>

        </div>

        <!-- Modal for view -->
        <div class="modal fade" id="ModelView" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Employee Details</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <table class="table">
                            <tbody id='emplistBody'>

                            </tbody>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- all CDN links -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.bundle.min.js"></script>
<!-- write JS codes here below -->

<!--  datepiker -->
        <script>
          $( "#datepicker" ).datepicker({
            dateFormat: "yy-mm-dd",
           
        });
   
        $(document).on('change','#datepicker' ,function() {
         var selectedDate =  $('#datepicker').val();
         console.log(selectedDate);
         window.location.href="dashboard.php?date=" + selectedDate ;
        //  $('#searchedDate').text(selectedDate);
          
});
  </script>
  <!-- tdl button and create new span tag  -->
        <script>
        
        $(document).on('click', '.ptext', function() {

           var textId = $(this).attr('text-id');
            // console.log(textId);
            $.ajax({
                url:'tdldb.php',
                method:'GET',
                data:{
                    'textId':textId
                },
                // dataType:'json',
                success: function(response){
                    // console.log(typeof response);
                    // console.log(JSON.parse(response));
                    var response = JSON.parse(response);
                    if(response.isTaskCompleted==1){
                        $('span[text-id="'+textId+'"]').addClass("taskCmpltCss");
                        // console.log($());
                    }else{
                        $('span[text-id="'+textId+'"]').removeClass("taskCmpltCss");
                    }
                }
            })
        });
        $(document).on('click', '.ptext', function() {
            
        })
        
        function ViewMod(id) {
            $.ajax({
                method: 'GET',
                data: {
                    'id': id
                },
                url: 'view.php',
                dataType: 'json',
                success: function(response) {
                    // console.log(response);
                    // console.log(response.id);
                     $('#emplistBody').html(
                        '<tr> <td class="col-span"></td> <td id="tdMOD"> <img id="Modimg"src="images/' +
                        response.empImgs + '"></td></tr>' +
                        '<tr> <td> First Name </td><td> ' + response.fname + ' </td> </tr>' +
                        '<tr> <td> Last Name </td><td> ' + response.lname + ' </td> </tr>' +
                        '<tr> <td> Email ID </td><td> ' + response.email + ' </td> </tr>' +
                        '<tr> <td> Mobile No. </td> <td> ' + response.mobileno + ' </td> </tr>' +
                        '<tr> <td> Date of Birth </td> <td> ' + (response.dob) + ' </td> </tr>' +
                        '<tr> <td> Gender </td> <td> ' + response.gender + ' </td> </tr>' +
                        '<tr> <td> Education </td> <td> ' + response.education + '</td> </tr>'
                    );
                    $('#ModelView').show();
                }
            });
        }
        </script>
        <!-- JavaScript Bundle with Popper -->
        <!-- <script src='https://kit.fontawesome.com/a076d05399.js'></script> -->
</body>

</html>