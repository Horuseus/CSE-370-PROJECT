<?php
session_start();
include("../dbconnect.php");
if(!isset($_SESSION['safr_id'])){ header("Location: ../refugee login/login.php"); exit; }
$safr_id = $_SESSION['safr_id'];
$sql = "SELECT * FROM search_req WHERE Safr_id ='$safr_id'";
$result = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Search Requests – SAFR</title>
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
    <a href="family_Search.php" class="active">Family Search</a>
    <a href="evac_rec.php">Evacuation Request</a>
    <a href="camp_change.php">Camp Change</a>
</div>
<div class="safr-container wide">
    <h2>My Search Requests</h2>
    <?php if(mysqli_num_rows($result) > 0): ?>
    <table class="safr-table">
        <thead>
            <tr>
                <th>Missing Name</th>
                <th>Document Number</th>
                <th>Status</th>
                <th>Matched SAFR ID</th>
            </tr>
        </thead>
        <tbody>
        <?php while($row = mysqli_fetch_assoc($result)): ?>
        <tr>
            <td><?php echo $row['Missing_Name']; ?></td>
            <td><?php echo $row['Doc_number']; ?></td>
            <td>
                <?php if($row['Status'] == 0): ?>
                    <span class="badge badge-pending">Pending</span>
                <?php else: ?>
                    <span class="badge badge-accepted">Found</span>
                <?php endif; ?>
            </td>
            <td><?php echo $row['Status'] == 0 ? '—' : $row['Match_Safr_id']; ?></td>
        </tr>
        <?php endwhile; ?>
        </tbody>
    </table>
    <?php else: ?>
        <p style="color:#666;">No search requests submitted yet.</p>
    <?php endif; ?>
    <div class="note" style="margin-top:18px;">
        <a href="family_Search.php">New Search Request</a>
    </div>
</div>
</body>
</html>
