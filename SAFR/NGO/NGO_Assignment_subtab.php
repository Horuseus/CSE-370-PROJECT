<?php
include('../dbconnect.php');
session_start();
$ngo_name = $_SESSION['NGO_name'];
$sql = "SELECT * FROM volunteer";
$result = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Assignments – SAFR</title>
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
    <a href="NGO_Assignment_subtab.php" class="active">Assignments</a>
    <a href="NGO_aidview_subtab.php">Aid View</a>
    <a href="ngo_medical.php">Medical Aid</a>
    <a href="NGO_Campreqsubtab.php">Camp Requests</a>
    <a href="Show_evacs.php">Evacuation Requests</a>
</div>

<div class="safr-container wide">
    <h2>All Volunteers</h2>
    <p style="margin-bottom:16px; font-size:13px; color:#555;">
        <a href="add_assignment.php" class="safr-btn">+ Add Assignment</a>
        &nbsp;
        <a href="NGO_outcome_leaftab.php" class="safr-btn" style="background:#224a73;">View Outcomes</a>
    </p>
    <table class="safr-table">
        <thead>
            <tr>
                <th>Vol ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
            </tr>
        </thead>
        <tbody>
        <?php if (mysqli_num_rows($result) > 0): ?>
            <?php while ($row = mysqli_fetch_array($result)): ?>
            <tr>
                <td><?php echo $row[0]; ?></td>
                <td><?php echo $row[1]; ?></td>
                <td><?php echo $row[2]; ?></td>
                <td><?php echo $row[3]; ?></td>
            </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr><td colspan="4">No volunteers found.</td></tr>
        <?php endif; ?>
        </tbody>
    </table>
</div>

</body>
</html>