<?php
session_start();
include('../dbconnect.php');

$s      = $_POST['skill'];
$aid    = $_POST['aid'];
$campid = $_POST['cid'];
$date   = $_POST['date'];

$sql    = "SELECT Volunteer_id FROM volunteer WHERE skill='$s'";
$result = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Select Volunteer – SAFR</title>
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

<div class="safr-container">
    <h2>Assign to a Volunteer</h2>
    <form action="insert_assignment.php" method="post">
        <label>Assignment ID</label>
        <input type="text" name="aid" value="<?php echo $aid; ?>" readonly>

        <label>Camp ID</label>
        <input type="text" name="cid" value="<?php echo $campid; ?>" readonly>

        <label>Date</label>
        <input type="text" name="date" value="<?php echo $date; ?>" readonly>

        <label>Skill Required</label>
        <input type="text" name="skill" value="<?php echo $s; ?>" readonly>

        <label for="vid">Select Volunteer</label>
        <select name="vid" id="vid" required>
            <option value="" disabled selected>-- Select Volunteer --</option>
            <?php
            if(mysqli_num_rows($result) > 0){
                while($row = mysqli_fetch_assoc($result)){
                    echo '<option value="' . $row['Volunteer_id'] . '">' . $row['Volunteer_id'] . '</option>';
                }
            } else {
                echo '<option value="" disabled>No volunteers with this skill</option>';
            }
            ?>
        </select>

        <button type="submit" class="safr-btn safr-btn-full">Create Assignment</button>
    </form>
</div>

</body>
</html>