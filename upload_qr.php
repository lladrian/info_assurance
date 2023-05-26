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

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

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


.wrapper  .qr_code_upload .row .container{
  display: flex;
  cursor: pointer;
  user-select: none;
  text-align: center;
  border-radius: 7px;
  background: #fff;
  align-items: center;
  justify-content: center;
  transition: height 0.2s ease;
}

.wrapper .active{
  pointer-events: none;
}
 .qr_code_upload .row .col-12 > .img{
  display: none;
  max-width: 148px;
}
.active .qr_code_upload div .col-12 img{
  display: block;
}
.active .qr_code_upload div .col-12 .content{
  display: none;
}
.qr_code_upload div .col-12  .content i{
  color: #0B85FF;
  font-size: 55px;
  text-align: center;
}
.qr_code_upload div .col-12  .content p{
  color: #0B85FF;
  margin-top: 15px;
  font-size: 16px;
}

    </style>



    <!-- endinject -->
    <link rel="shortcut icon" href="" />
</head>

<body>


                        <div class="wrapper" id="wrapper">
                          

                            <div >
                                <h4 style="text-align:center;">Login </h4>
                            </div>
                                
                            <form method="post" class="qr_code_upload" id="qr_code_upload">
                                <div class="row"> 
                                    <div class="col-12">
                                        <div class="input-group mb-2">
                                            <a class="btn btn-primary btn-block" href="index.php" role="button"> Back</a>
                                        </div>
                                    </div>
                                    <div class="col-12 container">
                                            <input type="file" hidden class="upload_file" id="upload_file" >
                                            <img src="#" class="img" id="img" alt="qr-code">
                                             <div class="content">
                                              <i class="fas fa-cloud-upload"></i>
                                              <p id="p_scan">Upload QR Code to Read</p>
                                            </div>
                                    </div>
                                    <div class="col-12"  style="display:none;">
                                        <div class="input-group mb-2">
                                            <!-- <video id="preview" width="100%"> </video> -->
                                            <div style="width:100%;" id="reader"></div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="input-group mb-2">
                                                <a style="background: #384a14d9; font-weight: 600; color: white;" class="btn btn-block" href="scan_qr.php" role="button">Scan QR CODE</a>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="input-group mb-2">
                                            <a style="background: #454643; font-weight: 600; color: white;" class="btn btn-block" href="index.php" role="button">Create an account</a>
                                        </div>
                                    </div>
                                </div>
                              

                            </form>

                            <form id="qr_upload_form" method="post">
                                    <div class="col-12" style="display:none;">
                                    <div class="input-group mb-2">
                                        <input type="text" class="input form-control" name="qrID" id="qrID" />
                                    </div>
                            </form>


                        </div>

                     



    <script src="resources/sweetalert/sweetalert.js"></script>

  

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

<!-- 
    <script type="text/javascript">
            function onScanSuccess(decodedText, decodedResult) {
              // handle the scanned code as you like, for example:
              //alert(`Code matched = ${decodedText}`, decodedResult);
                var text = document.getElementById('qrID').value = decodedText;
                //$( "#qr_upload_form" ).trigger( "submit" );
            }

            let config = {
              fps: 10,
              qrbox: {width: 100, height: 100},
              // Only support file scan type.
              supportedScanTypes: [Html5QrcodeScanType.SCAN_TYPE_FILE]
            };

            let scanner = new Html5QrcodeScanner(
              "reader", config, /* verbose= */ false);
            scanner.render(onScanSuccess);

    </script> -->


     <script type="text/javascript">
         
        const wrapper = document.getElementById('wrapper');
          form = document.getElementById('qr_code_upload');
          fileInp = document.getElementById('upload_file');
          infoText = document.getElementById('p_scan');
          text = document.getElementById('qrID');

          function fetchRequest(file, formData) {
         
              infoText.innerText = "Scanning QR Code...";
              fetch("https://api.qrserver.com/v1/read-qr-code/", {
                  method: 'POST', body: formData
              }).then(res => res.json()).then(result => {
                  result = result[0].symbol[0].data;
                  infoText.innerText = result ? "Upload QR Code to Scan" : "Couldn't scan QR Code";
                  text.value = result;
                  $("#qr_upload_form").trigger("submit");
                  if(!result) return;
                  wrapper.classList.add("active");
                  wrapper.classList.remove("active")
              }).catch(() => {
                  infoText.innerText = "Couldn't scan QR Code";
              });
          }

          fileInp.addEventListener("change", async e => {
              let file = e.target.files[0];
              if(!file) return;
              let formData = new FormData();
              formData.append('file', file);
              fetchRequest(file, formData);
          });

          form.addEventListener("click", () => fileInp.click());
    </script>
 


<script type="text/javascript">

$("#qr_upload_form").on("submit", function(b) {
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
                 alert(e);   
          }
         });

    }

})

</script>


</body>

</html>