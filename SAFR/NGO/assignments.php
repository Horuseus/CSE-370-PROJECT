<?php
session_start();
include('../dbconnect.php');

$sql    = "SELECT a.Assignment_ID, a.Volunteer_id, a.Assigned_Date, a.Camp_id, vq.Outcome 
           FROM assignment a 
           LEFT JOIN volunteers_quota vq ON a.Volunteer_id = vq.Volunteer_id";
$result = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Assignments – SAFR</title>
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
    <h2>All Assignments</h2>
    <p style="margin-bottom:16px;">
        <a href="add_assignment.php" class="safr-btn">+ Create Assignment</a>
        &nbsp;
        <a href="NGO_outcome_leaftab.php" class="safr-btn" style="background:#224a73;">View Outcomes</a>
    </p>
    <table class="safr-table">
        <thead>
            <tr>
                <th>Assignment ID</th>
                <th>Volunteer ID</th>
                <th>Assigned Date</th>
                <th>Camp ID</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
        <?php if(mysqli_num_rows($result) > 0): ?>
            <?php while($row = mysqli_fetch_assoc($result)):
                $status = (!empty($row['Outcome'])) ? 'Done' : 'Pending';
            ?>
            <tr>
                <td><?php echo $row['Assignment_ID']; ?></td>
                <td><?php echo $row['Volunteer_id']; ?></td>
                <td><?php echo $row['Assigned_Date']; ?></td>
                <td><?php echo $row['Camp_id']; ?></td>
                <td>
                    <?php if($status === 'Done'): ?>
                        <span class="badge badge-accepted">Done</span>
                    <?php else: ?>
                        <span class="badge badge-pending">Pending</span>
                    <?php endif; ?>
                </td>
            </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr><td colspan="5">No assignments found.</td></tr>
        <?php endif; ?>
        </tbody>
    </table>
</div>

</body>
</html>