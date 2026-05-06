<?php
session_start();
include("../dbconnect.php");
if(!isset($_SESSION['safr_id'])){ header("Location: ../refugee login/login.php"); exit; }
$safr_id = $_SESSION['safr_id'];
$sql = "SELECT r.Camp_id, r.Arrival_date, r.Departure_date, c.Location
        FROM refugee_stay_in_camp r
        JOIN camp c ON r.Camp_id=c.Camp_id
        WHERE r.Safr_id='$safr_id'
        ORDER BY r.Departure_date ASC";
$result = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Camp History – SAFR</title>
    <link href="../css/safr.css" rel="stylesheet">
</head>
<body>
<div class="safr-topbar">
    <a href="refugee_dashboard.php" class="brand">SAFR</a>
    <div class="topbar-right"><a href="refugee_logout.php">Logout</a></div>
</div>
<div class="safr-nav">
    <a href="refugee_dashboard.php">Dashboard</a>
    <a href="see_documents.php">Documents</a>
    <a href="family_Search.php">Family Search</a>
    <a href="evac_rec.php">Evacuation Request</a>
    <a href="camp_change.php">Camp Change</a>
    <a href="camp_history.php" class="active">Camp History</a>
</div>
<div class="safr-container wide">
    <h2>My Camp History</h2>
    <table class="safr-table">
        <thead>
            <tr>
                <th>Location</th>
                <th>Camp ID</th>
                <th>Arrival Date</th>
                <th>Departure Date</th>
            </tr>
        </thead>
        <tbody>
        <?php if(mysqli_num_rows($result) > 0): ?>
            <?php while($row = mysqli_fetch_array($result)): ?>
            <tr>
                <td><?php echo $row['Location']; ?></td>
                <td><?php echo $row['Camp_id']; ?></td>
                <td><?php echo $row['Arrival_date']; ?></td>
                <td><?php echo $row['Departure_date'] ? $row['Departure_date'] : 'Currently here'; ?></td>
            </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr><td colspan="4">No camp history found.</td></tr>
        <?php endif; ?>
        </tbody>
    </table>
</div>
</body>
</html>