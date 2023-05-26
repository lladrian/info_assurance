<!DOCTYPE html>
<html lang="en">
<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    session_destroy();
}
?>

<head>
   <script type="text/javascript">
        function preventBack() {
            window.history.forward()
        };
        setTimeout("preventBack()", 0);
        window.onunload - function() {
            null;
        }
    </script>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>QR SYSTEM</title>
    <meta charset="utf-8">


    <!-- Bootstrap -->
    <link href="resources/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Sweet Alert -->


    <style>
        
     * {
    margin: 0;
    padding: 0;
  box-sizing: border-box;
}
body {
    background: wheat;
}
.wrapper {
    width: 400px;
    background: white;
    position: absolute;
  top: 50%;
  left: 50%;
  padding: 40px;
  -ms-transform: translate(-50%, -50%);
  transform: translate(-50%, -50%);
}

    </style>



    <!-- endinject -->
    <link rel="shortcut icon" href="" />
</head>

<body>


                        <div class="wrapper">
                          

                            <div >
                                <h4 style="text-align:center;">Account Recovery</h4>
                            </div>
                                
                            <form id="recovery_form"  method="post">
                                <div class="row"> 
                                    <div class="col-12">
                                        <div class="input-group mb-2">
                                            <a class="btn btn-primary btn-block" href="recovery_account.php" role="button"> Back</a>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="input-group mb-2">
                                            <input type="password" class="input form-control" name="password" id="password"  placeholder="Enter Password" />
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="input-group mb-2">
                                            <input type="password" class="input form-control" name="password2" id="password2"  placeholder="Confirm Password" />
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="input-group mb-2">
                                            <input class="btn form-control" style="background:#bba644; font-weight: 600; color: white;" type="submit">
                                        </div>
                                    </div>    
                                    <div class="col-12">
                                        <div class="input-group mb-2">
                                            <a style="background: #454643; font-weight: 600; color: white;" class="btn btn-block" href="index.php" role="button">Create an account</a>
                                        </div>
                                    </div>
                                </div>
                              

                            </form>

                        </div>



  <!--   <script src="resources/jquery/jquery.slim.min.js"></script>
    <script src="resources/popper/popper.min.js"></script>
    <script src="resources/bootstrap/js/bootstrap.min.js"></script> -->
        <script src="resources/js/jquery.js"></script>

    <script src="resources/sweetalert/sweetalert.js"></script>

  




<script type="text/javascript">

$("#recovery_form").on( "submit", function(b) {
  b.preventDefault();

   let pass1 = $('#password').val();
   let pass2 = $('#password2').val();


    if(pass1 == '' || pass2 == '') {
        Swal.fire({
                icon: 'error',
                title: '<strong>Password is empty!</strong>',
            })
    } else {
        //alert(pass1);
        // alert(pass2);
         if (pass1===pass2) {
            $.ajax({
            url:'action/change_password.php',
            method:'POST',
            data:$(this).serialize(),
            success: function(e){
             if (e==1) {
                   Swal.fire({
                      title: '<strong>Password Successfully Changed!</strong>',
                      icon: 'success',
                  }).then(() =>{
                      window.location.href = "index.php";
                  })
            } 
            if (e==2) {
                Swal.fire({
                      icon: 'error',
                      title: '<strong>Failed to change password!.</strong>',
                  }).then(() =>{
                      window.location.reload();
                  })
            }
          }
         });
        } else {
             Swal.fire({
                icon: 'error',
                title: '<strong>Password doesn`t matched!</strong>',
            })
        }
         
    }


        

})

</script>


</body>

</html>