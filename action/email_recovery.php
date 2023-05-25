<?php
    include_once 'connection.php';

    $email = $_POST['email'];
    $sql = "SELECT * FROM users WHERE Email ='$email'";
    $result = mysqli_query($conn, $sql);

    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    $count = mysqli_num_rows($result);

    if ($count == 1) {
         $_SESSION['user_id']= $row['Userid'];
        echo 1;
    } else {
        echo 2;
    }
?>