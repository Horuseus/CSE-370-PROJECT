<?php
session_start();
include("../dbconnect.php");

if(!isset($_SESSION['safr_id'])){
    header("Location: ../refugee login/login.php");
    exit;
}

$safr_id = $_SESSION['safr_id'];

$sql = "SELECT * FROM refugee_stay_in_camp WHERE Safr_id = '$safr_id' ORDER BY Arrival_date DESC LIMIT 1";
$cid_result = mysqli_query($conn, $sql);
$camp_id2   = mysqli_fetch_array($cid_result);
$camp_id    = $camp_id2['Camp_id'];

$sql = "SELECT * FROM camp WHERE Camp_id='$camp_id'";
$cname_result = mysqli_query($conn, $sql);
$c_name    = mysqli_fetch_array($cname_result);
$camp_name = $c_name['Location'];

$sql   = "SELECT Camp_id, Location FROM camp WHERE Camp_id != '$camp_id'";
$camps = mysqli_query($conn, $sql);

if(isset($_POST['destination']) && isset($_POST['dept_date'])){
    $d = $_POST['destination'];
    $c = $_POST['dept_date'];
    $a = date("Y-m-d", strtotime($c . " +2 days"));
    $sql = "UPDATE refugee_stay_in_camp SET Departure_date = '$c' WHERE Safr_id = '$safr_id' AND Camp_id= '$camp_id'";
    mysqli_query($conn, $sql);
    $sql = "INSERT INTO refugee_stay_in_camp (Safr_id, Camp_id, Arrival_date, Departure_date) VALUES ('$safr_id','$d','$a',NULL)";
    mysqli_query($conn, $sql);
    if(mysqli_affected_rows($conn)){
        header('Location: refugee_dashboard.php');
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Camp Change – SAFR</title>
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
    <a href="evac_rec.php">Evacuation Request</a>
    <a href="camp_change.php" class="active">Camp Change</a>
    <a href="camp_history.php">Camp History</a>
</div>

<div class="safr-container">
    <h2>Update My Destination</h2>

    <div class="safr-info-box" style="margin-bottom:20px;">
        <p><strong>Current Camp:</strong> <?php echo $camp_name; ?></p>
    </div>

    <form action="camp_change.php" method="post">
        <label>Next Destination</label>
        <div style="margin-bottom:16px; font-size:14px; line-height:2;">
        <?php
        if(mysqli_num_rows($camps) > 0){
            while($row = mysqli_fetch_array($camps)){
                echo '<label style="font-weight:normal; display:flex; align-items:center; gap:8px;">';
                echo '<input type="radio" name="destination" value="' . $row['Camp_id'] . '" style="width:auto; margin:0;">';
                echo $row['Location'] . ' (' . $row['Camp_id'] . ')';
                echo '</label>';
            }
        }
        ?>
        </div>

        <label for="dept_date">Departure Date</label>
        <input type="date" id="dept_date" name="dept_date" required>

        <button type="submit" class="safr-btn safr-btn-full">Confirm Camp Change</button>
    </form>
</div>

</body>
</html>