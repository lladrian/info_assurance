<!DOCTYPE html>
<html lang="en">

<?php
session_start();

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
                                            <a class="btn btn-primary btn-block" href="index.php" role="button"> Back</a>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="input-group mb-2">
                                            <input type="email" class="input form-control" name="email" id="email"  placeholder="Enter Email Address" />
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

   let text = $('#email').val();

    if(text == '') {
        Swal.fire({
                icon: 'error',
                title: '<strong>Email address is empty!</strong>',
            })
    } else {
         $.ajax({
            url:'action/email_recovery.php',
            method:'POST',
            data:$(this).serialize(),
            success: function(e){
             if (e==1) {
                   Swal.fire({
                      title: '<strong>Email Verifation Success!</strong>',
                      icon: 'success',
                  }).then(() =>{
                      window.location.href = "recovery-code.php";
                  })
            } 
            if (e==2) {
                Swal.fire({
                      icon: 'error',
                      title: '<strong>Email address doesn`t exist.</strong>',
                  }).then(() =>{
                      window.location.reload();
                  })
            }
            if (e==3) {
                Swal.fire({
                      icon: 'error',
                      title: '<strong>ERROR! Failed to send OTP!</strong>',
                  }).then(() =>{
                      window.location.reload();
                  })
            }
          }
         });

    }

})

</script>


</body>

</html>