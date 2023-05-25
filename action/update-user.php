<?php
	include_once 'connection.php';

	$user_id = $_POST['userID'];
	$fname = $_POST['fname'];
	$lname = $_POST['lname'];
	$uname = $_POST['uname'];
	$email = $_POST['email'];
	$password = md5($_POST['password']);


	$sql = "SELECT * FROM users WHERE Username ='$uname'";
    $result = mysqli_query($conn, $sql);
    $count = mysqli_num_rows($result);

    if($count>0) {
    	echo 2;
    } else {
		$sql2 = "UPDATE users SET Firstname='$fname', Lastname='$lname', Username='$uname', Email='$email', Password='$password' WHERE Userid='$user_id'";

		if (mysqli_query($conn, $sql2)) {
			$sql3 = "UPDATE users SET Username='$uname', OTP='0', login_type='0' WHERE Userid='$user_id'";
			if (mysqli_query($conn, $sql3)) {
				echo 1;
			}
		} else {
			echo 3;
		}
	}

	//close connection
	mysqli_close($conn);

