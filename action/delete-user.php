<?php
include_once 'connection.php';


		$id = $_POST['delete_id'];


		$sql = "SELECT * FROM users WHERE Userid ='$id'";
		$result = mysqli_query($conn, $sql);
		$row = mysqli_fetch_array($result, MYSQLI_ASSOC);

		//$count_deleted = 0;
		//echo $id;
		//Check if insertion
		
			$sql2 = "DELETE FROM users WHERE Userid = '$id'";
			if (mysqli_query($conn, $sql2)) {
				$qrID = $row['qrID'];
				$path = '../qrcodes-images/'.$qrID.'.png';
				if(file_exists($path)) {
					echo 1;
					unlink($path);
				}
			} else {
			    echo 2;
		    }
		

   		 	
   		 	
   		 	
		



	//close connection
	mysqli_close($conn);

