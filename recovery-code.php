
<?php 
    session_start();
    if(!isset($_SESSION['username'])) {
        header("Location: index.php");
        session_destroy();
    }


 ?>
<!DOCTYPE html>
<html lang="en">
 <script type="text/javascript">
        function preventBack() {
            window.history.forward()
        };
        setTimeout("preventBack()", 0);
        window.onunload - function() {
            null;
        }
    </script>
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Qr Code</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap -->
    <link href="resources/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- 
    Fontawesome 
    <link href="vendors/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet">
    -->
    <link rel="stylesheet" href="resources/fontawesome-free/css/all.min.css">


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
                                <form id="otp_form" method="post">

                                    <div class="col-md-12">
                                        <h4 class="card-title pb-1 fs-4 text-center">OTP Verification</h4>
                                    </div>

                                    <div class="col-12">
                                        <div class="input-group mb-3 mt-3">
                                            <input type="text" class="input form-control" name="code" id="code" placeholder="Please enter OTP Code" aria-label="password" aria-describedby="basic-addon1"/>
                                        </div>
                                    </div>

                                    <div class="col-12 mb-2">
                                        <button class="btn btn-success w-100" id="start_button" name="submit" type="submit">Submit</button>
                                    </div>
                                            <div class="col-12">
                                            <div class="input-group mb-2">
                                                <a class="btn btn-primary btn-block" href="index.php" role="button"> Back</a>
                                            </div>
                                        </div>
                                </form>
                            </div>
                        </div>


<script src="resources/js/jquery.js"></script>
    <script src="resources/bootstrap/js/bootstrap.bundle.min.js"></script>

<script src="resources/sweetalert/sweetalert.js"></script>
<script type="text/javascript">

$("#otp_form").submit(function(b){
  b.preventDefault();

   let code = $('#code').val();

    if(code == '') {
        Swal.fire({
                icon: 'error',
                title: '<strong>Please fill in the blank!</strong>',
            })
    } else {
         $.ajax({
            url:'action/verify-otp.php',
            method:'POST',
            data:$(this).serialize(),
            cache: false,
            success: function(e){
             // alert('MESSAGE:'+ e);
              if (e==1) {
                   Swal.fire({
                      title: '<strong>OTP Verification Success!</strong>',
                      icon: 'success',
                  }).then(() =>{
                      window.location.href = "change_password.php";
                  })
              } if (e==2) {
                Swal.fire({
                      icon: 'error',
                      title: '<strong>Incorrect OTP!!!</strong>',
                  })
              }
          }
         });

    }

})

</script>

</body>
</html>