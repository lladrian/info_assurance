<!DOCTYPE html>
<html lang="en">

<?php
    session_start();
    //session_destroy();

    //include_once 'send_otp.php';
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
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap -->
    <link href="resources/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- 
    Fontawesome 
    <link href="vendors/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet">
    -->
    <link rel="stylesheet" href="resources/fontawesome-free/css/all.min.css">

    <!-- Sweet Alert -->

    <!-- Custome CSS -->

    <style type="text/css">
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
    display: flex;
    justify-content: center;
    align-items: center;
  top: 50%;
  left: 50%;
  padding: 20px;
  -ms-transform: translate(-50%, -50%);
  transform: translate(-50%, -50%);
}


    </style>

</head>

<body>


                    <div class="wrapper">
                        <div class="container">
                            <div>
                                <h4 style="text-align: center;">Login</h4>
                            </div>
                              <form id="login_form" method="post">
                                <div class="col-12 ">
                                    <div class="input-group mb-2">
                                        <a class="btn btn-danger btn-block" href="scan_qr.php" width="100%" role="button"> Scan QR</a>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-5">
                                            <hr>
                                        </div>
                                        <div class="col-2">
                                            <p class="text-center">or</p>
                                        </div>
                                        <div class="col-5">
                                            <hr>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1"><i class="fa fa-user"></i></span>
                                        </div>
                                        <input name="username" type="text" class="input form-control" id="username" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1"  />
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1"><i class="fa fa-lock"></i></span>
                                        </div>
                                        <input name="password" type="password" class="input form-control" id="password" placeholder="Password" aria-label="password" aria-describedby="basic-addon1"  />
                                    </div>
                                </div>
                                <div class="col-12">
                                    <button class="btn btn-primary w-100" type="submit" name="submit">Login</button>
                                </div>
                                <div class="col-12 mt-3">
                                    <p>Don't have account?<a href="register.php">Create Account?</a></p>
                                </div>
                                <div class="col-12">
                                    <a class="btn btn-primary w-100" href="recovery_account.php" style="background:#4a4b4c; font-weight: 700;">Forgot Password</a>
                                </div>
                            </form>                                 
                        </div>
                    </div>


<script src="resources/js/jquery.js"></script>
<script src="resources/sweetalert/sweetalert.js"></script>
<script type="text/javascript">

$("#login_form").submit(function(b){
  b.preventDefault();

   let uname = $('#username').val();
   let pass = $('#password').val();

    if(pass == '' || uname == '') {
        Swal.fire({
                icon: 'error',
                title: '<strong>Please fill in the blank!</strong>',
            })
    } else {
         $.ajax({
            url:'action/login.php',
            method:'POST',
            data:$(this).serialize(),
            success: function(e){
             //alert('MESSAGE:'+ e);
             if (e==1) {
                   Swal.fire({
                      title: '<strong>Login Successfully!</strong>',
                      icon: 'success',
                  }).then(() =>{
                     window.location.href = "login-code.php";
                  })

            } 
            if (e==2) {
                Swal.fire({
                      icon: 'error',
                      title: '<strong>Wrong Password or Username!</strong>',
                  })
            }
            if (e==3) {
                Swal.fire({
                      icon: 'error',
                      title: '<strong>ERROR! Database Failed to insert.!</strong>',
                  })
            }
          }
         });

    }

})

</script>

<?php 
    if (isset($_SESSION['status']) && $_SESSION['status'] != '' && isset($_SESSION['fname']) && $_SESSION['fname'] != '') {
?>
<script type="text/javascript">
   
                   Swal.fire({
                      title: '<strong>Registration Success!</strong>',
                      icon: 'success',
                      html: 'Hey! <b><?php echo $_SESSION['fname']; ?></b> click'+ '<a href="qrcodes-images/<?php echo $_SESSION['status']; ?>.png" download> here </a>'+'to download your <b>QR CODE</b> '  +
                        'or you can also download it on your dashboard.',
                      imageUrl: 'qrcodes-images/<?php echo $_SESSION['status']; ?>.png',
                      imageHeight: 200,
                      imageAlt: '<?php echo $_SESSION['status']; ?>',

                  })
            
</script>
<?php
    }
    unset($_SESSION['status']);
?>
</body>
</html>