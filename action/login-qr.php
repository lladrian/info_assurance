<?php
    include_once 'connection.php';

    $qrID = $_POST['qrID'];
    $sql = "SELECT * FROM users WHERE qrID ='$qrID'";
    $result = mysqli_query($conn, $sql);

    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    $count = mysqli_num_rows($result);

    if ($count == 1) {
        $_SESSION['username'] = $row['Username'];
        $_SESSION['qrID'] = $row['qrID'];
        echo 1;
    } else {
        echo 2;
    }
?>