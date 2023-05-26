<?php
    include_once 'connection.php';

    $username = $_POST['username'];
    $password = md5($_POST['password']);

    $sql = "SELECT * FROM users WHERE Username ='$username' && Password='$password'";
    $result = mysqli_query($conn, $sql);
    $count = mysqli_num_rows($result);


    if ($count == 1) {
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
        $email = $row['Email'];
        $qrID = $row['qrID'];
        //$_SESSION['login_user'] = $username;

        $OTP_code = rand(111111, 999999);

        
        $sql = "UPDATE loggedin_history set OTP= '$OTP_code' WHERE Username ='$username'";

        //Check if insertion
        if (mysqli_query($conn, $sql)) {
            echo 1;
            $_SESSION['username'] = $username;
            $_SESSION['qrID'] = $qrID;
            include_once '../send_otp.php';
        } else {
            echo 3;
        }
    } else {
       echo 2;
    }


   mysqli_free_result($result);
   mysqli_close($conn);

