<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "evsu_qrcode";

$conn = new mysqli($servername, $username, $password, $dbname);
 
//Check connection
if (!$conn) {
	die("ERROR: Could not connect. " . mysqli_connect_error());
}


?>