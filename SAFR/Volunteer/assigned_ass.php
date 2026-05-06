<?php
session_start();
include('../dbconnect.php');
$vol_id = $_SESSION['vol_id'];
$sql = "SELECT Assignment_ID, Assigned_Date, Camp_id FROM assignment WHERE Volunteer_id = '$vol_id'";
$result = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Assignments – SAFR</title>
    <link href="../css/safr.css" rel="stylesheet">
</head>
<body>

<div class="safr-topbar">
    <a href="assigned_ass.php" class="brand">SAFR</a>
    <div class="topbar-right">
        Vol ID: <strong style="color:white;"><?php echo $vol_id; ?></strong>
        <a href="../logout.php">Logout</a>
    </div>
</div>

<div class="safr-nav">
    <a href="assigned_ass.php" class="active">My Assignments</a>
    <a href="Outcome.php">Record Outcome</a>
</div>

<div class="safr-container wide">
    <h2>My Assignments</h2>
    <table class="safr-table">
        <thead>
            <tr>
                <th>Assignment ID</th>
                <th>Assigned Date</th>
                <th>Camp ID</th>
            </tr>
        </thead>
        <tbody>
        <?php if (mysqli_num_rows($result) > 0): ?>
            <?php while ($row = mysqli_fetch_assoc($result)): ?>
            <tr>
                <td><?php echo $row['Assignment_ID']; ?></td>
                <td><?php echo $row['Assigned_Date']; ?></td>
                <td><?php echo $row['Camp_id']; ?></td>
            </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr><td colspan="3">No assignments found.</td></tr>
        <?php endif; ?>
        </tbody>
    </table>
</div>

</body>
</html>