<?php
	$host = "localhost";
	$user = "root";
	$pass = "";
	$db = "attendance1";
	
	$conn = new mysqli($host, $user, $pass, $db);
	if($conn->connect_error){
		echo "Seems like you have not configured the database. Failed To Connect to database:" . $conn->connect_error;
	}
?>