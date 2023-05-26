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
                                <h4 style="text-align:center;">Login </h4>
                            </div>
                                
                            <form id="qr_form"  method="post">
                                <div class="row"> 
                                    <div class="col-12">
                                        <div class="input-group mb-2">
                                            <a class="btn btn-primary btn-block" href="index.php" role="button"> Back</a>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="input-group mb-2">
                                            <!-- <video id="preview" width="100%"> </video> -->
                                            <div style="width:100%;" id="reader"></div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="input-group mb-2">
                                            <input type="text" class="input form-control" name="text" id="text" readonly placeholder="Place your QR code in the camera" />
                                        </div>
                                    </div>  
                                     <div class="col-12" style="display:none;">
                                        <div class="input-group mb-2">
                                            <input type="text" class="input form-control" name="qrID" id="qrID" />
                                        </div>
                                    </div> 
                                    <div class="col-12">
                                        <div class="input-group mb-2">
                                            <a style="background: #934444; font-weight: 600; color: white;" class="btn btn-block" href="upload_qr.php" role="button">Upload QR CODE</a>
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

  

  <script src="resources/scanner_html5/html5-qrcode.min.js"></script> 


<!-- 
    <script type="text/javascript">
        let scanner = new Instascan.Scanner({
            video: document.getElementById('preview')
        });
        scanner.addListener('scan', function(content) {
            console.log(content);
        });
        Instascan.Camera.getCameras().then(function(cameras) {
            if (cameras.length > 0) {
                scanner.start(cameras[0]);
            } else {
                console.error('No cameras found.');
            }
        }).catch(function(e) {
            console.error(e);
        });

        scanner.addListener('scan', function(c) {
            document.getElementById('text').value = c;
            document.forms[0].submit();
        });
    </script> -->
    <script src="resources/js/jquery.js"></script>
<script src="resources/sweetalert/sweetalert.js"></script>


    <script type="text/javascript">
       /* function onScanSuccess(c) {
            //document.getElementById('result').innerHTML = '<span class="result">'+qrCodeMessage+'</span>';
            //alert(c);
            document.getElementById('text').value = c;
            //document.forms[0].submit();
            document.getElementById("myForm").submit();
            scanner.stop();
        }

        function onScanError(errorMessage) {
          //handle scan error
            //setTimeout(greet, 5000);
            //setInterval(greet, 5000);
        }*/

        //var scanner = new Html5QrcodeScanner("reader", { fps: 10, qrbox: 250 });
        //scanner.render(onScanSuccess, onScanError);
       /*scanner.addListener('scan', function(c) {
            document.getElementById('text').value = c;
            document.forms[0].submit();
        });*/

     

        const qrCodeSuccessCallback = (decodedText, decodedResult)=>{
            if(decodedText){
               var text = document.getElementById('qrID').value = decodedText;
                //document.forms[0].submit();
                //alert(text);
                $( "#qr_form" ).trigger( "submit" );
                //document.getElementById("qr_form").submit();
                //document.forms[0].submit();
                scanner.stop();
            } 
        }
        const scanner = new Html5Qrcode('reader');
        const config = {fps:10, qrbox:{width:250, height:250}}
        scanner.start({facingMode:"environment"}, config, qrCodeSuccessCallback);

    </script>



<script type="text/javascript">

$("#qr_form").on( "submit", function(b) {
  b.preventDefault();

   let text = $('#qrID').val();

    if(text == '') {
        Swal.fire({
                icon: 'error',
                title: '<strong>QR CODE is empty!</strong>',
            })
    } else {
         $.ajax({
            url:'action/login-qr.php',
            method:'POST',
            data:$(this).serialize(),
            success: function(e){
             if (e==1) {
                   Swal.fire({
                      title: '<strong>Login Successfully!</strong>',
                      icon: 'success',
                  }).then(() =>{
                      window.location.href = "dashboard/index.php";
                  })
            } 
            if (e==2) {
                Swal.fire({
                      icon: 'error',
                      title: '<strong>QR Code doesn`t matched.</strong>',
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