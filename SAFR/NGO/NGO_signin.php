<?php
    include('../dbconnect.php');
    session_start();

    if(isset($_POST['ID']) && isset($_POST['pass'])){
	$u = $_POST['ID'];
	$p = $_POST['pass'];

    
    
	$sql = "SELECT * FROM ngo_credential WHERE NGO_name  = '$u' AND Password = '$p'";
	
	//Execute the query 
	$result = mysqli_query($conn, $sql);
	
	//check if it returns an empty set
	if(mysqli_num_rows($result) !=0 ){
		$_SESSION['NGO_name']=$u;
		header("Location: NGO_Dashboard.php");
	}
	else{
		header("Location: NGOsign.php");
	}
	
}
?>
