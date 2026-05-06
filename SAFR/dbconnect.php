<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "safr_project_final";
$conn ="";
//creating connection

$conn = new mysqli($servername, $username, $password);

//check connection 
if($conn->connect_error){
	die("Connection failed: " . $conn->connect_error);
	}
else{
	mysqli_select_db($conn, $dbname);
	//echo "Connection successful";
	}


?>