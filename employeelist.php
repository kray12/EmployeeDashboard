    <?php
    include "dbcon.php";
    session_start();
    ?>


    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="//cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">

        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js"></script>
        <script src="sweetalert.js "></script>
        <script src="//cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
        <title>employeelists</title>
        <style>
        label {
            font-size: 20px;
        }

        table {

            text-align: center;
        }

        #imgMOD {
            display: flex;
            justify-content: center;
            height: 100px;
            width: 100px;
        }
        </style>
    </head>

    <body>
        <?php include "header.php" ?>
        <div class="container">
            <h1>Employeess lists</h1> <br>
            <!-- <div class="row">
        <div class="col-3"><label for="Src" placeholder="enter name" ><strong>Search  d</strong></label> </div>
        <div class="col-9"><input type="text" class="form-control"> </div>
        </div> -->
            <div class="form-group row">
                <div class="col-3">
                    <label for="Search">Search</label>
                </div>
                <div class="col-9"><input type="text" class="form-control" id="search"
                        placeholder="Enter firstname, lastname, email"></div>
            </div>
            <br>
            <div class="row">
                <div class="col-6"><button type="submit" id="srchbtn" class="btn btn-success btn-lg btn-block">
                        Search</button></div>
                <div class="col-6"><a href="addEmployee.php" class="btn btn-primary btn-lg btn-block">Add new
                        Employee</a></div>
            </div>


            <div>
                <table class="empListTable">
                    <thead>
                        <tr>
                            <th>Sno.</th>
                            <th>first Name</th>
                            <th>last Name</th>
                            <th>Email </th>

                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="tbody">
                        <?php
                        $selectquery = "SELECT * FROM registration ";
                        
                        $resultquery = mysqli_query($con, $selectquery);
                        $serialcount = 0;
                        // $result = mysqli_fetch_array($resultquery);
                            foreach($resultquery as $res ){ 
                        ?>
                        <tr>
                            <td> <?= ++$serialcount; ?> </td>
                            <td> <?php echo $res["fname"] ?></td>
                            <td> <?= $res['lname'] ?></td>
                            <td> <?= $res['email'] ?> </td>

                            <td>
                                <button class="btn btn-success" data-toggle="modal" data-target="#ModelView"
                                    onclick="ViewRecord(<?= $res['id'] ?>)"> view </button>
                                <a href="addEmployee.php?id=<?= $res['id'] ?>" id="editbtn" class="btn-primary btn">
                                    edit</a>
                                <button onclick=" deleteRecord(<?= $res['id'] ?>) " class="btn btn-danger"> delete
                                </button>   
                            </td>
                        </tr>
                        <?php
                        }
                        ?>

                    </tbody>
                </table>

            </div>
        </div>
        <!-- Modal -->
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
                                <!-- <?php  //echo '<img src="data:images/jpeg;base64,'.base64_encode( $res['images'] ).'"/>'; 
                                        ?> -->
                            </tbody>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

        <script>
        $(document).ready(function() {
            $('.empListTable').DataTable();
            $(document).on('click', '#srchbtn', function(e) {
                e.preventDefault();
                var Searchname = $('#search').val();
                //    alert(Searchname);
                $.ajax({
                    method: 'GET',
                    url: 'searchLikeOptr.php',
                    data: {
                        'search': Searchname
                    },
                    dataType: 'json',
                    success: function(response) {
                        //  var  responseData=  $.parseJSON(response.data);
                        // console.log(response.status);
                        // console.log(response.data[0]);
                        // console.log(responseData);
                        // return false;
                        if (response.status === 1) {
                            $('.empListTable').DataTable().destroy();
                            $('#tbody').html("");
                            // alert("entering loop")
                            for (var index = 0; index < response.data.length; index++) {
                                // alert("entered loop")
                                // console.log(response.data[index]);
                                element = response.data[index];
                                // console.log(element);
                                // console.log(element.fname);
                                var sno = 1;
                                // return false;
                                $('#tbody').append('<tr>\
                                           <td></td>\
                                           <td>' + element.fname + '</td>\
                                           <td>' + element.lname + '</td>\
                                           <td>' + element.email + '</td>\
                                           <td>\
                                           <button  class="btn btn-success" data-toggle="modal" data-target="#ModelView" onclick="ViewRecord(' +
                                    element.id + ')"> view </button>\
                                           <a href="addEmployee.php?id=' + element.id + '" id="editbtn" class= "btn-primary btn"> edit</a> \
                                           <button onclick=" deleteRecord(' + element.id + ') " class= "btn btn-danger" > delete </button>\
                                           </td>\
                                           </tr>');


                            }
                            $('.empListTable').DataTable();
                            // '<tr><td>RESULT</td><td> '+ response.data+' </td></tr>'
                            // $('.empListTable').append(response);
                        }

                    }
                });
            })
        })

        function deleteRecord(id) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        method: 'GET',
                        data: {
                            'id': id
                        },
                        url: 'delete.php',
                        success: function(data) {
                            swal.fire({
                                icon: 'success',
                                text: "Employee record updated",
                                type: "success"
                            }).then(function() {
                                location.reload();
                            });
                        }
                    });
                } else {
                    swal.fire("Cancelled", "Your data is Safe", "error");
                }
            });
        }


        <?php if (isset($_GET["status"]) && $_GET["status"] == 'updated') { ?>
        Swal.fire('Employee record updated').then(function() {
            window.location.href = 'employeelist.php';
        });

        <?php } else if (isset($_GET["status"]) && $_GET["status"] == 'saved') { ?>
        Swal.fire('Employee record saved').then(function() {
            window.location.href = 'employeelist.php';
        });

        <?php } ?>

        function ViewRecord(id) {
            $.ajax({
                method: 'GET',
                data: {
                    'id': id
                },
                url: 'view.php',
                dataType: 'json',
                success: function(response) {

                    //    console.log(response);
                    //    console.log(response.id);

                    $('#emplistBody').html(
                        '<tr> <td class="col-span"></td> <td> <img id="imgMOD"src= "images/' +
                        response.empImgs + '"></td></tr>' +
                        '<tr><td>First Name</td><td>   ' + response.fname + '</td></tr>' +
                        '<tr> <td>Last Name </td>  <td>' + response.lname + '</td></tr>' +
                        '<tr> <td>Email ID </td>   <td>' + response.email + '</td></tr>' +
                        '<tr> <td>Mobile No. </td> <td>' + response.mobileno + '</td></tr>' +
                        '<tr><td>Date of Birth</td><td>' + response.dob + '</td></tr>' +
                        '<tr> <td >Gender </td>    <td>' + response.gender + '</td></tr>' +
                        '<tr> <td >Education</td>  <td>' + response.education + '</td></tr>'
                    );


                    $('#ModelView').show();
                }
            });
        }
        </script>


    </body>

    </html>