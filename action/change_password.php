<?php
	include_once 'connection.php';

	$user_id = $_SESSION['user_id'];
	$password = md5($_POST['password']);

	$sql2 = "UPDATE users SET Password='$password' WHERE Userid='$user_id'";

	if (mysqli_query($conn, $sql2)) {
		echo 1;
		session_destroy();
	} else {
		echo 2;
	}
	

	//close connection
	mysqli_close($conn);

