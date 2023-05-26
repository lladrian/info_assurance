<!DOCTYPE html>
<html lang="en">

<?php

include('../action/connection.php');
if(!isset($_SESSION['username'])) {
    header("Location: ../index.php");
    session_destroy();
}
?>

<head>
    <script type="text/javascript">
        $(document).ready(function() {
            window.history.pushState(null, "", window.location.href);
            window.onpopstate = function() {
                window.history.pushState(null, "", window.location.href);
            };
        });
    </script>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>QR SYSTEM</title>

    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="dist/css/adminlte.min.css">

    <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="plugins/datatables-buttons/css/buttons.bootstrap4.min.css">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css">

    <!-- endinject -->
    <link rel="shortcut icon" href="../images/evsu.png" />
    <style type="text/css">
         .dropdown {
            position: relative;
            display: inline-block;
        }   
        .dropbtn {
            min-width: 160px;
            padding: 5px;
        }
        
        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #f9f9f9;
            min-width: 160px;
            box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
            padding: 12px 16px;
            z-index: 1;
        }
        .dropdown-content a {
            display: inline-block;
            width: 100%;
        }
     
        
        .dropdown:hover .dropdown-content {
            display: block;
        }

    </style>
</head>

<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed">

    <div class="wrapper">

        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="../images/evsu.png" alt="taskbinder-logo" height="60" width="60">

        </div>


        <!-- Navbar -->
        <nav style="display:flex; justify-content: space-between;" class="main-header navbar navbar-expand navbar-white navbar-light">

            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="index.php" class="nav-link">HOME</a>
                </li>
            </ul>

          <div class="dropdown">
                <button class="dropbtn"><?=$_SESSION['username'];?></button>
                <div class="dropdown-content">
                    <a href="../action/logout.php">Logout</a>
                     <?php
                      if (isset($_SESSION['qrID']) && $_SESSION['qrID']  != '') {
                       ?>
                    <a href="./../qrcodes-images/<?php echo $_SESSION['qrID']; ?>.png" download> Download QR CODE </a>
                    <?php
                       }
                    ?>
                </div>
          </div>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="index.php" class="brand-link">
                <img src="../images/evsu.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">EVSU QR CODE</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
                    </div>
                    <!-- Logout User -->
                    <div class="info">
                        <a href="#" class="d-block">
                            <!-- The current user logged in is the last ID in the table loggedin_history -->
                             <?=$_SESSION['username'];?>
                        </a>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                        <li class="nav-item menu-open">
                            <a href="#" class="nav-link active">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>
                                    Dashboard
                                </p>
                            </a>
                        </li>
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0"> Welcome  
                            </h1>
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Dashboard</li>
                            </ol>
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                

                    <div class="row">
                        <section class="col-lg-12 connectedSortable">
                            <div class="card">
                                <div class="card-header" style="display:flex; align-items: center;  justify-content:space-between;">
                                    <a type="button" class="btn btn-xs addbtn" style="margin-right: 4px; text-align:center; background:green; font-weight:700; color: white;  font-size:18px; padding:10px;" >INSERT DATA</a>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th style="width: 1%">
                                                    #
                                                </th>
                                                <th style="width: 1%">
                                                    First Name
                                                </th>
                                                <th style="width: 1%">
                                                    Last Name
                                                </th>
                                                <th style="width: 1%">
                                                    Username
                                                </th>
                                                <th style="width: 1%">
                                                    Email
                                                </th>
                                                <th style="width: 1%">
                                                    QR Code
                                                </th>
                                                <th style="width: 5%">
                                                    Actions
                                                </th>


                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            
                                            $query = 'SELECT * FROM users';
                                            $result = mysqli_query($conn, $query) or die(mysqli_error($conn));
                                            $count = 1;

                                            while ($row = mysqli_fetch_assoc($result)) {

                                                echo '<tr>';
                                                echo '<td id="user_id">'. $row['Userid'] . '</td>';
                                                echo '<td id="firstname">' . $row['Firstname'] . '</td>';
                                                echo '<td id="lastname">' . $row['Lastname'] . '</td>';
                                                echo '<td id="username">' . $row['Username'] . '</td>';
                                                echo '<td id="email">' . $row['Email'] . '</td>';

                                                echo '<td id="qr-code" style="text-align:center;">
                                                        <img class="card-img-top" style="width:100px;" src="../../qrcodes-images/' . $row['qrID'] . '.png  " alt="Card image cap">
                                                      </td>';
                                             
                                                echo '<td style="text-align:center;"> ';
                                                echo '
                                                    <button type="button" class="btn btn-xs editbtn" style="margin-right: 4px; background:#eded2a; font-weight:700; text-align:center; color:black;  font-size:18px; padding:10px;" > EDIT </button>

                                                ';
                                                echo '<a type="button" style="text-align:center; color:white;   font-weight:700; font-size:18px; padding:10px;" class="btn btn-xs btn-danger deletebtn">DELETE </a> </td>';

                                                echo '</tr> ';



                                                $count = $count + 1;
                                            }
                                            ?>


                                        </tbody>
                                    </table>
                                </div>
                                <!-- /.card-body -->
                            </div>
                        </section>
                    </div>
                </div>
                <!-- /.container-fluid -->
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
        <footer class="main-footer">
            <strong>Copyright &copy; 2023 <a href="#">EVSU QR CODE</a>.</strong> All rights reserved.
            <!-- <div class="float-right d-none d-sm-inline-block">
                <b></b> QR Code
            </div> -->
        </footer>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <!-- DELETE POP UP FORM (Bootstrap MODAL) -->
    <div class="modal fade" id="deletemodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"> Delete Student Data </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form id="delete_user_form" method="post">
                    <div class="modal-body" >
                        <input style="display:none;" type="text" name="delete_id" id="delete_id">
                        <h4> Do you want to Delete this Data ??</h4>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"> NO </button>
                        <button type="submit" name="deletedata" class="btn btn-primary"> Yes !! Delete it. </button>
                    </div>
                </form>

            </div>
        </div>
    </div>


    <!-- EDIT POP UP FORM (Bootstrap MODAL) -->
    <div class="modal fade" id="editmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        >
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"> Edit Student Data </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form id="update_user_form"  method="post">

                    <div class="modal-body">

                         <div class="form-group" style="display:none;">
                            <label> User ID </label>
                            <input type="text" name="userID" id="update_id" class="form-control">
                        </div>
 
                        <div class="form-group">
                            <label> Firstname </label>
                            <input type="text" name="fname" id="update_fname" class="form-control"
                                placeholder="Enter Firstname">
                        </div>

                        <div class="form-group">
                            <label> Lastname </label>
                            <input type="text" name="lname" id="update_lname" class="form-control"
                                placeholder="Enter Lastname">
                        </div>

                         <div class="form-group">
                            <label> Username </label>
                            <input type="text" name="uname" id="update_uname" class="form-control"
                                placeholder="Enter Username">
                        </div>

                        <div class="form-group">
                            <label> Email </label>
                            <input type="text" name="email" id="update_email_add" class="form-control"
                                placeholder="Enter Email">
                        </div>

                        <div class="form-group">
                            <label> Password </label>
                            <input type="text" name="password" id="update_password" class="form-control"
                                placeholder="Enter Password">
                        </div>

                        
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" name="updatedata" class="btn btn-primary">Update Data</button>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <!-- ADD POP UP FORM (Bootstrap MODAL) -->
    <div class="modal fade" id="addmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        >
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"> Add Student Data </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form id="add_user_form"  method="post">

                    <div class="modal-body">
                        <div class="form-group">
                            <label> Firstname </label>
                            <input type="text" name="fname" id="add_fname" class="form-control"
                                placeholder="Enter Firstname">
                        </div>

                        <div class="form-group">
                            <label> Lastname </label>
                            <input type="text" name="lname" id="add_lname" class="form-control"
                                placeholder="Enter Lastname">
                        </div>

                         <div class="form-group">
                            <label> Username </label>
                            <input type="text" name="uname" id="add_uname" class="form-control"
                                placeholder="Enter Username">
                        </div>

                        <div class="form-group">
                            <label> Email </label>
                            <input type="text" name="email" id="add_email_add" class="form-control"
                                placeholder="Enter Email">
                        </div>

                        <div class="form-group">
                            <label> Password </label>
                            <input type="password" name="password" id="add_password" class="form-control"
                                placeholder="Enter Password">
                        </div>

                        
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" name="updatedata" class="btn btn-primary add-btn">Insert Data</button>
                    </div>
                </form>

            </div>
        </div>
    </div>

 


        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>

    <script src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>
        <script src="dist/js/adminlte.js"></script>
        <script src="../resources/sweetalert/sweetalert.js"></script>

    <!-- DataTables  & Plugins -->
    <script src="plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <script src="plugins/jszip/jszip.min.js"></script>
    <script src="plugins/pdfmake/pdfmake.min.js"></script>
    <script src="plugins/pdfmake/vfs_fonts.js"></script>
    <script src="plugins/datatables-buttons/js/buttons.html5.min.js"></script>
    <script src="plugins/datatables-buttons/js/buttons.print.min.js"></script>
    <script src="plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
    <script>
        $(function() {
            $("#example1").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
        });
    </script>





     <script>
            $( ".editbtn" ).on( "click", function() {
                 $('#editmodal').modal('show');

                $tr = $(this).closest('tr');

                var data = $tr.children("td").map(function () {
                    return $(this).text();
                }).get();

               // console.log(data);

                $('#update_id').val(data[0]);
                $('#update_fname').val(data[1]);
                $('#update_lname').val(data[2]);
                $('#update_uname').val(data[3]);
                $('#update_email_add').val(data[4]);
            } );


            $( ".addbtn" ).on( "click", function() {
                 $('#addmodal').modal('show');
            } );

            $( ".deletebtn" ).on( "click", function() {
                 $('#deletemodal').modal('show');
                 $tr = $(this).closest('tr');

                var data = $tr.children("td").map(function () {
                    return $(this).text();
                }).get();

                 $('#delete_id').val(data[0]);
            } );
        
    </script>




<script type="text/javascript">

$("#add_user_form").submit(function(b){
  b.preventDefault();

   let fname = $('#add_fname').val();
   let lname = $('#add_lname').val();
   let uname = $('#add_uname').val();
   let email = $('#add_email_add').val();
   let pass = $('#add_password').val();

   /*let fname = document.getElementById('fname').value;
   let lname = document.getElementById('lname').value;
   let uname = document.getElementById('uname').value;
   let email = document.getElementById('email_add').value;
   let pass = document.getElementById('password').value;*/

    if(fname == '' || lname == '' || uname == '' || pass == '' || email == '') {
        Swal.fire({
                icon: 'error',
                title: '<strong>Please fill in the blank!</strong>',
            })
    } else {
         $.ajax({
            url:'../action/add-user.php',
            method:'POST',
            data:$(this).serialize(),
            cache: false,
            success: function(e){
              //alert('MESSAGE:'+ e);
              if (e==1) {
                   Swal.fire({
                      title: '<strong>User data added successfully!</strong>',
                      icon: 'success',
                  }).then(() =>{
                      window.location.reload();
                  })
              } if (e==2) {
                Swal.fire({
                      icon: 'error',
                      title: '<strong>Username already exist!!</strong>',
                  })
              }
          }
         });

    }

})

</script>


<script type="text/javascript">

$("#update_user_form").submit(function(b){
  b.preventDefault();

   let fname = $('#update_fname').val();
   let lname = $('#update_lname').val();
   let uname = $('#update_uname').val();
   let email = $('#update_email_add').val();
   let pass = $('#update_password').val();

    if (fname == '' || lname == '' || uname == '' || pass == '' || email == '') {
        Swal.fire({
                icon: 'error',
                title: '<strong>Please fill in the blank!</strong>',
            })
    } else {
         $.ajax({
            url:'../action/update-user.php',
            method:'POST',
            data:$(this).serialize(),
            cache: false,
            success: function(e){
             // alert('MESSAGE:'+ e);
              if (e==1) {
                  Swal.fire({
                      icon: 'success',
                      title: '<strong>User data updated successfully!</strong>',
                  }).then(() =>{
                      window.location.reload();
                  })
              } 
              if (e==2) {
                Swal.fire({
                      icon: 'error',
                      title: '<strong>Username already exist!!</strong>',
                  })
              } 
              
              if (e==3) {
                Swal.fire({
                      icon: 'error',
                      title: '<strong>ERROR! Failed to update!!</strong>',
                  })
              }
          }
         });

    }

})

</script>


<script type="text/javascript">

$("#delete_user_form").submit(function(b){
  b.preventDefault();

   let delete_id = $('#delete_id').val();


    if(delete_id == '') {
        Swal.fire({
                icon: 'error',
                title: '<strong>Please fill in the blank!</strong>',
            })
    } else {
         $.ajax({
            url:'../action/delete-user.php',
            method:'POST',
            data:$(this).serialize(),
            cache: false,
            success: function(e){
             // alert('MESSAGE:'+ e);
              if (e==1) {
                  Swal.fire({
                      icon: 'success',
                      title: '<strong>User data deleted successfully!</strong>',
                  }).then(() =>{
                      window.location.reload();
                  })
              } else if (e==2) {
                Swal.fire({
                      icon: 'error',
                      title: '<strong>ERROR! Failed to delete.!!</strong>',
                  })
              } 
              else  {
                Swal.fire({
                      icon: 'error',
                      title: '<strong>ERROR! Failed to delete.!!</strong>',
                      html: e,
                  })
              } 
          }
         });

    }

})

</script>




 

    
</body>

</html>