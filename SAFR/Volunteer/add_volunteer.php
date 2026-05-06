<?php
include('../dbconnect.php');

$sql    = "SELECT * FROM `volunteer` ORDER BY `volunteer`.`Volunteer_id` DESC LIMIT 1";
$result = mysqli_query($conn, $sql);
$row    = mysqli_fetch_assoc($result);
$lastID = $row['Volunteer_id'];
$num    = filter_var($lastID, FILTER_SANITIZE_NUMBER_INT) + 1;
$volid  = "VOL0" . $num;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register as Volunteer – SAFR</title>
    <link href="../css/safr.css" rel="stylesheet">
</head>
<body>

<div class="safr-topbar">
    <a href="../home.php" class="brand">SAFR</a>
</div>

<div class="safr-nav">
    <a href="Volunteer_signin.php">Sign In</a>
    <a href="add_volunteer.php" class="active">Register</a>
</div>

<div class="safr-container">
    <h2>Register as a Volunteer</h2>
    <form action="insert_volunteer.php" method="post">
        <label>Volunteer ID</label>
        <input type="text" name="vid" value="<?php echo $volid; ?>" readonly>

        <label for="sname">Full Name</label>
        <input type="text" id="sname" name="sname" placeholder="Enter your full name" required>

        <label for="v-pass">Password</label>
        <input type="password" id="v-pass" name="pass" placeholder="Set a password" required>

        <label for="v-email">Email</label>
        <input type="text" id="v-email" name="email" placeholder="Enter your email" required>

        <label for="v-phone">Phone</label>
        <input type="text" id="v-phone" name="phn" placeholder="Enter your phone number" required>

        <label for="v-origin">Home Country</label>
        <input type="text" id="v-origin" name="origin" placeholder="Enter your home country" required>

        <label for="v-skill">Skill</label>
        <select id="v-skill" name="skill" required>
            <option value="" disabled selected>-- Select a Skill --</option>
            <option value="Education">Education</option>
            <option value="Distribution">Distribution</option>
            <option value="Counselling">Counselling</option>
            <option value="Mechanic">Mechanic</option>
            <option value="Logistics">Logistics</option>
            <option value="Translation">Translation</option>
            <option value="Medical Worker">Medical Worker</option>
        </select>

        <button type="submit" class="safr-btn safr-btn-full">Register</button>
    </form>
    <div class="note" style="margin-top:16px;">Already registered? <a href="Volunteer_signin.php">Sign In here</a></div>
</div>

</body>
</html>
