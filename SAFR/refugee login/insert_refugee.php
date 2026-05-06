<?php
// first of all, we need to connect to the database
require_once('../dbconnect.php');

// we need to check if the input in the form textfields are not empty
if(isset($_POST['ref_name']) && isset($_POST['ref_dob']) && isset($_POST['ref_bg']) && isset($_POST['ref_country']) && isset($_POST['ref_city'])&& isset($_POST['ref_date'])){
	// write the query to check if this username and password exists in our database
	

	$a = $_POST['ref_name'];
	$b= $_POST['ref_dob'];
	$c = $_POST['ref_bg'];
	$d = $_POST['ref_country'];
	$e = $_POST['ref_city'];
	$f = $_POST['ref_date'];
	
	//safr_id generator code
	if(!empty($a) && !empty($b) && !empty($c) && !empty($d) && !empty($e) && !empty($f) ){
	 	$cquery  = "SELECT Camp_id FROM camp WHERE Location LIKE '%$e%'";
    	$camp_result = mysqli_query($conn, $cquery);
   		$camp_row    = mysqli_fetch_assoc($camp_result); //assoc- asocciative array. SO, Camp_id=>camp_location.

		$camp_id = $camp_row['Camp_id']; //get camp id from the selected Camp_id in db
		$camp_num = str_replace('CAMP', '', $camp_id);   
		$datefor = str_replace('-', '', $f);

		//count refugees  registered in this camp this date
		$count_query  = "SELECT COUNT(*) as total FROM refugee WHERE Safr_id LIKE 'SAFR-C$camp_num%'";
		$count_result = mysqli_query($conn, $count_query);
		$count_row    = mysqli_fetch_assoc($count_result);
		$count        = $count_row['total'];
		$next_num = $count + 1;

		$safr_id = "SAFR-C" . $camp_num . "-" . $datefor . "-" . $next_num;
		//echo "SAFR ID generated: " . $safr_id . "<br>";





	$sql = " INSERT INTO refugee (Safr_id,Full_name, Date_of_Birth, Blood_group, Country, City, reg_date)
											VALUES( '$safr_id','$a', '$b', '$c', '$d', '$e', '$f') ";
	
	
	$result = mysqli_query($conn, $sql);
	
	//check if this insertion is happening in the database
	if(mysqli_affected_rows($conn)){
	
		//echo "Inserted Successfully";
		$stay="INSERT INTO  refugee_stay_in_camp (Safr_id,Camp_id,Arrival_date) 
													VALUES ('$safr_id','$camp_id','$f')";
		mysqli_query($conn,$stay);
		header("Location: add_pass.php?safr_id=$safr_id");
	}
	else{
		echo "Insertion Failed";
	}
	}

	else{
		header("location:add_refugee.php");
	}
}


?>