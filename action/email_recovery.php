<?php
    include_once 'connection.php';

    $email = $_POST['email'];
    $sql = "SELECT * FROM users WHERE Email ='$email'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    $count = mysqli_num_rows($result);

    if ($count == 1) {
         //$email = $row['Email'];
         $username = $row['Username'];

    /*     echo '<script type="text/javascript">';
echo ' alert('.$username.')';  //not showing an alert box.
echo '</script>';
*/
         $_SESSION['user_id']= $row['Userid'];

        //$_SESSION['login_user'] = $username;
        $OTP_code = rand(111111, 999999);

        $sql2 = "UPDATE loggedin_history set OTP= '$OTP_code' WHERE Username ='$username'";

        //Check if insertion
        if (mysqli_query($conn, $sql2)) {
            echo 1;
            $_SESSION['username'] = $username;
            include_once '../send_otp.php';
        } else {
            echo 3;
        }
    } else {
        echo 2;
    }
?>