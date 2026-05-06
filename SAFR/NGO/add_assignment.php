<?php
session_start();
include('../dbconnect.php');

if(!isset($_SESSION['NGO_name'])){
    header('location:NGOsign.php');
}

$ngo_name = $_SESSION['NGO_name'];

$sql = "SELECT Assignment_ID FROM assignment_required_skill ORDER BY Assignment_ID DESC LIMIT 1";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$lastID = $row['Assignment_ID'];
$num = filter_var($lastID, FILTER_SANITIZE_NUMBER_INT) + 1;
$assingmentID = "ASGN0" . $num;

$sql = "SELECT Camp_id FROM ngo WHERE NGO_name='$ngo_name'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$camp_id = $row['Camp_id'];

$date = date("Y-m-d");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Assignment – SAFR</title>
    <link href="../css/safr.css" rel="stylesheet">
</head>
<body>

<div class="safr-topbar">
    <a href="NGO_Dashboard.php" class="brand">SAFR</a>
    <div class="topbar-right">
        Logged in as: <strong style="color:white;"><?php echo $ngo_name; ?></strong>
        <a href="../logout.php">Logout</a>
    </div>
</div>

<div class="safr-nav">
    <a href="NGO_Dashboard.php">Dashboard</a>
    <a href="NGO_Assignment_subtab.php">Assignments</a>
    <a href="NGO_aidview_subtab.php">Aid View</a>
    <a href="ngo_medical.php">Medical Aid</a>
    <a href="NGO_Campreqsubtab.php">Camp Requests</a>
    <a href="Show_evacs.php">Evacuation Requests</a>
</div>

<div class="safr-container">
    <h2>Assign a Volunteer</h2>
    <form action="add_assign.php" method="post">

        <label>Assignment ID</label>
        <input type="text" name="aid" value="<?php echo $assingmentID; ?>" readonly>

        <label for="skill">Required Skill</label>
        <select name="skill" id="skill" required>
            <option value="" disabled selected>-- Select Required Skill --</option>
            <option value="Education">Education</option>
            <option value="Distribution">Distribution</option>
            <option value="Counselling">Counselling</option>
            <option value="Mechanic">Mechanic</option>
            <option value="Logistics">Logistics</option>
            <option value="Translation">Translation</option>
            <option value="Medical Worker">Medical Worker</option>
        </select>

        <label>Camp ID</label>
        <input type="text" name="cid" value="<?php echo $camp_id; ?>" readonly>

        <label>Assigned Date</label>
        <input type="text" name="date" value="<?php echo $date; ?>" readonly>

        <button type="submit" class="safr-btn safr-btn-full">Next</button>
    </form>
</div>

</body>
</html>
