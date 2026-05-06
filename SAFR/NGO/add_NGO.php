<?php
require_once('../dbconnect.php');

$sql1    = "SELECT Location, Camp_id FROM camp WHERE camp_id NOT IN (SELECT Camp_Id FROM ngo)";
$result2 = mysqli_query($conn, $sql1);

if(isset($_POST['name']) && isset($_POST['email']) && isset($_POST['camp']) && isset($_POST['manager']) && isset($_POST['pass'])){
    $a    = $_POST['name'];
    $b    = $_POST['email'];
    $c    = $_POST['camp'];
    $m    = $_POST['manager'];
    $pass = $_POST['pass'];

    $check   = "SELECT NGO_name FROM ngo WHERE NGO_name = '$a'";
    $checker = mysqli_query($conn, $check);

    if(mysqli_num_rows($checker) > 0){
        $msg      = "This NGO name is already registered. Please choose another.";
        $msg_type = "error";
    } else {
        $sql    = "INSERT INTO ngo (NGO_name, Contact_Email, Camp_id, Operating_Areas, Manager_name) VALUES ('$a','$b','$c','Syria','$m')";
        $result = mysqli_query($conn, $sql);
        $sql2   = "INSERT INTO ngo_credential VALUES ('$a', '$pass')";
        $passresult = mysqli_query($conn, $sql2);

        if($result && $passresult){
            $msg      = "Registered successfully! Redirecting to Sign In...";
            $msg_type = "success";
            header('Refresh:2; url=NGOsign.php');
        } else {
            $msg      = "Registration failed. Please try again.";
            $msg_type = "error";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register NGO – SAFR</title>
    <link href="../css/safr.css" rel="stylesheet">
</head>
<body>

<div class="safr-topbar">
    <a href="../home.php" class="brand">SAFR</a>
</div>

<div class="safr-nav">
    <a href="NGOsign.php">Sign In</a>
    <a href="add_NGO.php" class="active">Register NGO</a>
</div>

<div class="safr-container">
    <h2>Register an NGO</h2>

    <?php if(isset($msg)): ?>
        <div class="safr-msg <?php echo $msg_type; ?>"><?php echo $msg; ?></div>
    <?php endif; ?>

    <form action="add_NGO.php" method="post">
        <label for="ngo-name">NGO Name</label>
        <input type="text" id="ngo-name" name="name" placeholder="Enter NGO name" required>

        <label for="ngo-pass">Password</label>
        <input type="password" id="ngo-pass" name="pass" placeholder="Set a password" required>

        <label for="ngo-email">Contact Email</label>
        <input type="text" id="ngo-email" name="email" placeholder="Enter contact email" required>

        <label for="ngo-camp">Assign Camp</label>
        <select id="ngo-camp" name="camp" required>
            <option value="" disabled selected>-- Select a Camp --</option>
            <?php while($row = mysqli_fetch_assoc($result2)): ?>
            <option value="<?php echo $row['Camp_id']; ?>">
                <?php echo $row['Location'] . " – " . $row['Camp_id']; ?>
            </option>
            <?php endwhile; ?>
        </select>

        <label>Operating Areas</label>
        <input type="text" name="country" value="Syria" readonly>

        <label for="ngo-manager">Manager Name</label>
        <input type="text" id="ngo-manager" name="manager" placeholder="Enter manager's name" required>

        <button type="submit" class="safr-btn safr-btn-full">Register NGO</button>
    </form>
    <div class="note" style="margin-top:16px;">Already registered? <a href="NGOsign.php">Sign In here</a></div>
</div>

</body>
</html>
