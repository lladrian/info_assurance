<?php
session_start();

?>
<!DOCTYPE html>
<html>
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
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
body {
  font-family: Arial, Helvetica, sans-serif;
  
}

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
      padding: 20px;
  top: 50%;
  left: 50%;
  -ms-transform: translate(-50%, -50%);
  transform: translate(-50%, -50%);
}

/* Add padding to containers */
.container {
    height: 100%;
    width: 100%;

  background-color: white;
   display: flex;
    justify-content: center;
    align-items: center;
}

form {
  width: 100%;
}

/* Full-width input fields */
input[type=text], input[type=password] , input[type=email]{
  width: 100%;
  padding: 15px;
  margin: 5px 0 22px 0;
  display: inline-block;
  border: none;
  background: #f1f1f1;
}

input[type=text]:focus, input[type=password]:focus, input[type=email]:focus {
  background-color: #ddd;
  outline: none;
}

/* Overwrite default styles of hr */
hr {
  border: 1px solid #f1f1f1;
  margin-bottom: 25px;
}

/* Set a style for the submit button */
.registerbtn {
  background-color: #04AA6D;
  color: white;
  padding: 16px 20px;
  margin: 8px 0;
  border: none;
  cursor: pointer;
  width: 100%;
  opacity: 0.9;
}

.registerbtn:hover {
  opacity: 1;
}

/* Add a blue text color to links */
a {
  color: dodgerblue;
}

/* Set a grey background color and center the text of the "sign in" section */
.signin {
  background-color: #f1f1f1;
  text-align: center;
}
</style>
</head>
<body>

    <div class="wrapper">
                  <div class="container">
        <form id="reg_form" method="post">


            <div style="padding: 20px;">
                    <h1 style="text-align:center;">Register</h1>
            </div>
 
            <div>
               <label for="fname"><b>Firstname</b></label>
              <input type="text" placeholder="Enter Firstname" name="fname" id="fname">
            </div>
 
           <div>
             <label for="lname"><b>Lastname</b></label>
            <input type="text" placeholder="Enter Lastname" name="lname" id="lname">
           </div>

            <div>
                      <label for="uname"><b>Username</b></label>
            <input type="text" placeholder="Enter Username" name="uname" id="uname">
            </div>

    <div>
      
            <label for="email"><b>Email</b></label>
            <input type="email" placeholder="Enter Email" name="email" id="email">
    </div>

<div>
    <label for="password"><b>Password</b></label>
            <input type="password" placeholder="Enter Password" name="password" id="password">
</div>
          
          <div>
             <button type="submit" name="submit" class="registerbtn">Register</button>
          </div>

           
          
          <div class="container signin">
            <p>Already have an account? <a href="index.php">Sign in</a>.</p>
          </div>
        </form>
          </div>

    </div>
    

<script src="resources/js/jquery.js"></script>
<script src="resources/sweetalert/sweetalert.js"></script>

<script type="text/javascript">

$("#reg_form").submit(function(b){
  b.preventDefault();

   let fname = $('#fname').val();
   let lname = $('#lname').val();
   let uname = $('#uname').val();
   let email = $('#email').val();
   let pass = $('#password').val();

    if(fname == '' || lname == '' || uname == '' || pass == '' || email == '') {
        Swal.fire({
                icon: 'error',
                title: '<strong>Please fill in the blank!</strong>',
            })
    } else {
         $.ajax({
            url:'action/reg_insert.php',
            method:'POST',
            data:$(this).serialize(),
            cache: false,
            success: function(e){
              //alert('MESSAGE:'+ e);
              if (e==1) {
                   Swal.fire({
                      title: '<strong>Registration Success!</strong>',
                      icon: 'success',
                  }).then(() =>{
                      window.location.href = "index.php";
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

</body>
</html>