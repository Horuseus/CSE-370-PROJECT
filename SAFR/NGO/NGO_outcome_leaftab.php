<?php
require_once("../dbconnect.php");
$sql = "SELECT * FROM volunteers_quota";
$result = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Outcomes – SAFR</title>
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
    <a href="NGO_Assignment_subtab.php">Assignments</a>
    <a href="NGO_outcome_leaftab.php" class="active">Outcomes</a>
    <a href="add_assignment.php">Create Assignment</a>
    <a href="assignments.php">View Assignments</a>
</div>

<div class="safr-container wide">
    <h2>All Outcomes</h2>
    <table class="safr-table">
        <thead>
            <tr>
                <th>Assignment ID</th>
                <th>Vol ID</th>
                <th>Outcome</th>
            </tr>
        </thead>
        <tbody>
        <?php if (mysqli_num_rows($result) > 0): ?>
            <?php while ($row = mysqli_fetch_array($result)): ?>
            <tr>
                <td><?php echo $row[2]; ?></td>
                <td><?php echo $row[1]; ?></td>
                <td><?php echo $row[0]; ?></td>
            </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr><td colspan="3">No outcomes recorded yet.</td></tr>
        <?php endif; ?>
        </tbody>
    </table>
</div>

</body>
</html>