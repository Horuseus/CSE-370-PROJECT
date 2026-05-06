<?php
session_start();
include('../dbconnect.php');
$vol_id = $_SESSION['vol_id'];

$sql = "SELECT Assignment_ID FROM assignment WHERE Volunteer_id = '$vol_id'";
$result = mysqli_query($conn, $sql);

if(isset($_POST['assign']) && isset($_POST['outcome'])){
    $u = $_POST['assign'];
    $o = $_POST['outcome'];
    $sql2 = "INSERT INTO volunteers_quota VALUES ('$vol_id','$o','$u')
             ON DUPLICATE KEY UPDATE Outcome='$o', Assignment_ID='$u'";
    $result2 = mysqli_query($conn, $sql2);
    if(mysqli_affected_rows($conn)){
        header('location:assigned_ass.php');
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Record Outcome – SAFR</title>
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
    <a href="assigned_ass.php">My Assignments</a>
    <a href="Outcome.php" class="active">Record Outcome</a>
</div>

<div class="safr-container">
    <h2>Record Outcome</h2>
    <form action="Outcome.php" method="post">
        <label for="assign">Select Assignment</label>
        <select name="assign" id="assign" required>
            <option value="" disabled selected>-- Select Assignment --</option>
            <?php while($row = mysqli_fetch_assoc($result)): ?>
            <option value="<?php echo $row['Assignment_ID']; ?>">
                <?php echo $row['Assignment_ID']; ?>
            </option>
            <?php endwhile; ?>
        </select>

        <label for="outcome">Your Outcome / Feedback</label>
        <input type="text" id="outcome" name="outcome" placeholder="Describe the outcome..." required>

        <button type="submit" class="safr-btn safr-btn-full">Submit Outcome</button>
    </form>
</div>

</body>
</html>