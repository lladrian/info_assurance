<?php


include_once 'connection.php';

   
if(isset($_POST['code']) && isset($_SESSION['username'])) {


    $code = $_POST['code'];
    $username =  $_SESSION['username'];

    //validate if loggedId and OTP match
    $sql = "SELECT *FROM loggedin_history WHERE Username ='$username' && OTP ='$code'";
    $result = mysqli_query($conn, $sql);

    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    $count = mysqli_num_rows($result);

    if ($count == 1) {
        echo 1;
    } else {
        echo 2;
    }
} else {
    header("Location: ../index.php");
    //session_destroy();
}