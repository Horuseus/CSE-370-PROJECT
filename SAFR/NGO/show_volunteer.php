<?php
require_once("../dbconnect.php");
$sql    = "SELECT * FROM volunteer";
$result = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Volunteers – SAFR</title>
    <link href="../css/safr.css" rel="stylesheet">
</head>
<body>

<div class="safr-topbar">
    <a href="NGO_Dashboard.php" class="brand">SAFR</a>
    <div class="topbar-right">
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
    <table class="safr-table">
        <thead>
            <tr>
                <th>Vol ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Home Country</th>
            </tr>
        </thead>
        <tbody>
        <?php if(mysqli_num_rows($result) > 0): ?>
            <?php while($row = mysqli_fetch_array($result)): ?>
            <tr>
                <td><?php echo $row[0]; ?></td>
                <td><?php echo $row[1]; ?></td>
                <td><?php echo $row[2]; ?></td>
                <td><?php echo $row[3]; ?></td>
                <td><?php echo $row[4]; ?></td>
            </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr><td colspan="5">No volunteers found.</td></tr>
        <?php endif; ?>
        </tbody>
    </table>
</div>

</body>
</html>
