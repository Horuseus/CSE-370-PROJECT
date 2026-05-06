<?php
session_start();
include("../dbconnect.php");

if(!isset($_SESSION['safr_id'])){
    header("Location: ../refugee login/login.php");
    exit;
}
?>


<html lang="en">
  <head>
      <meta charset="utf-8"/>
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
      <meta name="description" content="About the site"/>
      <meta name="author" content="Author name"/>
      <title> MY PROFILE </title>
    
      <!-- core CSS -->
      <link href="css/bootstrap.min.css" rel="stylesheet"/>
      <link href="css/font-awesome.min.css" rel="stylesheet"/>
      <link href="css/animate.min.css" rel="stylesheet"/>
      <link href="css/main.css" rel="stylesheet"/> 
  </head>

  <body> 
    <!-- following section is used for creating the menubar in the webpage -->
	<section id="header">
		<div class="row">  
			<div class="col-md-2" style="font-size: 30px;color:#F2674A;"> SAFR </div>
			<div class="col-md-10" style="text-align: right"> 
				<a href="#"> Home </a> 
				<a href="#" style="margin-left: 20px;"> Students </a> 
				<a href="#" style="margin-left: 20px;"> Teachers  </a> 
			</div>
		</div>
	</section>
	
	<section id = "section1">
		<div class="title"> REFUGEE INFO  </div>
		
		<form action="insert_refugee.php" class="form_design" method="post">
			Name: <br><input type="text" name="ref_name" > <br/> 
			Date Of Birth: <br><input type="date" name="ref_dob"><br>
			blood group: <br>
							<select name= "ref_bg">
								<option value="">-- Select Blood Group --</option>
								<option value="A+">A+</option>
								<option value="A-">A-</option>
								<option value="B+">B+</option>
								<option value="B-">B-</option>
								<option value="AB+">AB+</option>
								<option value="AB-">AB-</option>
								<option value="O+">O+</option>
								<option value="O-">O-</option>
							</select><br>
			home country:<br> <input type="text" name="ref_country" value="Syria" readonly> <br/>
			city: <br><select name= "ref_city">
				<option value="">-- Select City --</option>
				<option value="Hasakah">Hasakah</option>
				<option value="Raqqa">Raqqa</option>
				<option value="Aleppo">Aleppo</option>
				<option value="Deir ez-Zor">Deir ez-Zor</option>
				<option value="Idlib">Idlib</option>
				<option value="Hama">Hama</option>
				<option value="Homs">Homs</option>
				<option value="Latakia">Latakia</option>
				<option value="Tartus">Tartus</option>
				<option value="Damascus">Damascus</option>
				<option value="Quneitra ">Quneitra </option>
				<option value="Daraa">Daraa</option>
				<option value="Suwayda">Suwayda </option>
				</select><br>
			registration:<br><input type= "date" name = "ref_date"><br>
			<input type="submit" value="Register">
		</form>
	</section>

	<section id = "sign in">
        Have an account?
        <a href="login.php">
            <button type="button">Sign_in</button>
        </a>
    </section>

	
	<!----- Footer ----->
	<section id="footer"> 
	
	</section>
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.isotope.min.js"></script>
    <script src="js/wow.min.js"></script>
  </body> 
</html>