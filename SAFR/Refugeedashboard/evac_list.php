<?php
session_start();
include("../dbconnect.php");
if(!isset($_SESSION['safr_id'])){ header("Location: ../refugee login/login.php"); exit; }
$safr_id = $_SESSION['safr_id'];
$sql = "SELECT * FROM evac_request WHERE Safr_id = '$safr_id'";
$result = mysqli_query($conn, $sql);
if(mysqli_num_rows($result) == 0){ header('location:evac_rec.php'); }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Evacuation Requests – SAFR</title>
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
    <a href="evac_rec.php" class="active">Evacuation Request</a>
    <a href="camp_change.php">Camp Change</a>
</div>
<div class="safr-container wide">
    <h2>Your Evacuation Requests</h2>
    <table class="safr-table">
        <thead>
            <tr>
                <th>Request ID</th>
                <th>Priority</th>
                <th>Location</th>
                <th>Request Date</th>
                <th>Approval Date</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
        <?php while($row = mysqli_fetch_assoc($result)): ?>
        <tr>
            <td><?php echo $row['Evareq_id']; ?></td>
            <td><?php echo $row['Priority']; ?></td>
            <td><?php echo $row['Operating_areas']; ?></td>
            <td><?php echo $row['Request_date']; ?></td>
            <td><?php echo $row['Allocation_date'] ? $row['Allocation_date'] : '—'; ?></td>
            <td>
                <?php if($row['Status'] == 0): ?>
                    <span class="badge badge-pending">Pending</span>
                <?php else: ?>
                    <span class="badge badge-accepted">Approved</span>
                <?php endif; ?>
            </td>
        </tr>
        <?php endwhile; ?>
        </tbody>
    </table>
    <div class="note" style="margin-top:18px;">
        <a href="evac_rec.php">Make New Request</a>
    </div>
</div>
</body>
</html>