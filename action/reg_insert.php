<?php
//Add the config database connection code 
include_once 'connection.php';
require_once '../resources/phpqrcode/qrlib.php';

			//Create Variable to catch the data from the from
			$firstname = $_POST['fname'];
			$lastname = $_POST['lname'];
			$username = $_POST['uname'];
			$password = md5($_POST['password']);
			$email = $_POST['email'];

			$sql = "SELECT * FROM users WHERE username ='$username'";
    		$result = mysqli_query($conn, $sql);
    		$count = mysqli_num_rows($result);

    		if($count>0) {
    			echo 2;
    		} else {

    			//MAKE QR IMAGE
				$path = '../qrcodes-images/';
				$username_encrypt = md5($_POST['uname']).md5($_POST['email']);
			    $qrIDText = "$firstname" . "-" . "$username_encrypt";
			    $file = $path . $qrIDText . ".png";
			    $text  = "$qrIDText";


					//Insert the data to table
				$sql2 = "INSERT INTO users (Firstname, Lastname, Username,Password,Email,qrID)
				VALUES ('$firstname','$lastname','$username','$password','$email','$qrIDText')";


				//Check if insertion
				if (mysqli_query($conn, $sql2)) {
					echo 1;			
					QRcode::png($text, $file, 'L', 7, 2);
					$_SESSION['status'] = $qrIDText;
					$_SESSION['fname'] = ucfirst($firstname);

					$sql3 = "SELECT * FROM users WHERE Username ='$username' && Password='$password'";
				    $result = mysqli_query($conn, $sql3);
				    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
				    $UserID = $row['Userid'];

					//Insert the data to table
					$sql4 = "INSERT INTO loggedin_history (UserID, Username, OTP, login_type) VALUES ('$UserID','$username',0,0)";

					//Check if insertion
					mysqli_query($conn, $sql4);	
				} else {
					echo 3;
				}

    		}

	//close connection
	mysqli_close($conn);
	?>
