<?php
session_start();
include("../dbconnect.php");

if(!isset($_SESSION['safr_id'])){
    header("Location: ../refugee login/login.php");
    exit;
}

$safr_id = $_SESSION['safr_id'];

$sql    = "SELECT * FROM refugee WHERE Safr_id = '$safr_id'";
$result = mysqli_query($conn, $sql);
$refugee = mysqli_fetch_array($result);

$sql= "SELECT * FROM refugee_stay_in_camp WHERE Safr_id = '$safr_id' ORDER BY Arrival_date DESC LIMIT 1";
$cid_result = mysqli_query($conn, $sql);
$camp_id2 = mysqli_fetch_array($cid_result);
$camp_id = $camp_id2['Camp_id'];

$sql = "SELECT * FROM camp WHERE Camp_id='$camp_id'";
$cname_result = mysqli_query($conn, $sql);
$c_name = mysqli_fetch_array($cname_result);
$camp_name = $c_name['Location'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard – SAFR</title>
    <link href="../css/safr.css" rel="stylesheet">
</head>
<body>

<div class="safr-topbar">
    <a href="refugee_dashboard.php" class="brand">SAFR</a>
    <div class="topbar-right">
        Hello, <strong style="color:white;"><?php echo $refugee['Full_name']; ?></strong>
        <a href="refugee_logout.php">Logout</a>
    </div>
</div>

<div class="safr-nav">
    <a href="refugee_dashboard.php" class="active">Dashboard</a>
    <a href="see_documents.php">Documents</a>
    <a href="family_Search.php">Family Search</a>
    <a href="evac_rec.php">Evacuation Request</a>
    <a href="camp_change.php">Camp Change</a>
</div>

<div class="safr-container">
    <h2><?php echo $refugee['Full_name']; ?>'s Profile</h2>
    <div class="safr-info-box">
        <p><strong>SAFR ID:</strong> <?php echo $refugee['Safr_id']; ?></p>
        <p><strong>Date of Birth:</strong> <?php echo $refugee['Date_of_Birth']; ?></p>
        <p><strong>Blood Group:</strong> <?php echo $refugee['Blood_Group']; ?></p>
        <p><strong>City:</strong> <?php echo $refugee['City']; ?></p>
        <p><strong>Current Camp:</strong> <?php echo $camp_name; ?></p>
    </div>
</div>

</body>
</html>