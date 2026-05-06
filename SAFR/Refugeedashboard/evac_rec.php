<?php
session_start();
include("../dbconnect.php");

if(!isset($_SESSION['safr_id'])){ exit(); }

$safr_id = $_SESSION['safr_id'];

$sql = "SELECT * FROM evac_request WHERE Safr_id ='$safr_id' AND Status= 0";
$result = mysqli_query($conn, $sql);
if(mysqli_num_rows($result) > 0){
    echo "Already submitted an Evacuation request.";
    header('Refresh:1; url=evac_list.php');
}

$count_sql    = "SELECT * FROM evac_request";
$count_result = mysqli_query($conn, $count_sql);
$count        = mysqli_num_rows($count_result);
$evareq_id    = "EVAC0" . ($count + 1);
$date         = date("Y-m-d");

if(isset($_POST['priority']) && isset($_POST['location'])){
    $priority = $_POST['priority'];
    $location = $_POST['location'];
    $sql = "INSERT INTO evac_request (Evareq_id, Status, Priority, Request_date, Allocation_date, Safr_id, Operating_areas) 
            VALUES ('$evareq_id', 0, '$priority', '$date', NULL, '$safr_id', '$location')";
    mysqli_query($conn, $sql);
    if(mysqli_affected_rows($conn)){
        header('location: evac_list.php');
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Evacuation Request – SAFR</title>
    <link href="../css/safr.css" rel="stylesheet">
</head>
<body>

<div class="safr-topbar">
    <a href="refugee_dashboard.php" class="brand">SAFR</a>
    <div class="topbar-right">
        <a href="refugee_logout.php">Logout</a>
    </div>
</div>

<div class="safr-nav">
    <a href="refugee_dashboard.php">Dashboard</a>
    <a href="see_documents.php">Documents</a>
    <a href="family_Search.php">Family Search</a>
    <a href="evac_rec.php" class="active">Evacuation Request</a>
    <a href="camp_change.php">Camp Change</a>
</div>

<div class="safr-container">
    <h2>Evacuation Request Form</h2>
    <form action="evac_rec.php" method="post">
        <label>SAFR ID</label>
        <input type="text" value="<?php echo $safr_id; ?>" readonly>

        <label>Request ID</label>
        <input type="text" value="<?php echo $evareq_id; ?>" readonly>

        <label>Request Date</label>
        <input type="text" value="<?php echo $date; ?>" readonly>

        <label for="priority">Priority</label>
        <select name="priority" id="priority" required>
            <option value="" disabled selected>-- Select Priority --</option>
            <option value="Chronically Ill">Chronically Ill</option>
            <option value="Minor">Minor</option>
            <option value="Elder">Elder</option>
            <option value="General">General</option>
        </select>

        <label for="location">Destination Location</label>
        <select name="location" id="location" required>
            <option value="">-- Select Location --</option>
            <option value="Aleppo">Aleppo</option>
            <option value="Damascus">Damascus</option>
            <option value="Homs">Homs</option>
            <option value="Latakia">Latakia</option>
            <option value="Daraa">Daraa</option>
            <option value="Deir ez-Zor">Deir ez-Zor</option>
            <option value="Raqqa">Raqqa</option>
            <option value="Idlib">Idlib</option>
            <option value="Hasakah">Hasakah</option>
            <option value="Hama">Hama</option>
            <option value="Tartus">Tartus</option>
            <option value="Quneitra">Quneitra</option>
            <option value="As-Suwayda">As-Suwayda</option>
        </select>

        <p style="font-size:13px; color:#666; margin-bottom:8px;"><strong>Status:</strong> Pending</p>
        <p style="font-size:13px; color:#666; margin-bottom:16px;"><strong>Allocation Date:</strong> Will be assigned by NGO</p>

        <button type="submit" class="safr-btn safr-btn-full">Submit Evacuation Request</button>
    </form>
    <div class="note" style="margin-top:18px;"><a href="evac_list.php">View Previous Requests</a></div>
</div>

</body>
</html>