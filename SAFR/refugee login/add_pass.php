<?php
include("../dbconnect.php");
$safr_id = $_GET['safr_id'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Set Password – SAFR</title>
    <link href="../css/safr.css" rel="stylesheet">
</head>
<body>

<div class="safr-topbar">
    <a href="../home.php" class="brand">SAFR</a>
</div>

<div class="safr-nav">
    <a href="login.php">Sign In</a>
</div>

<div class="safr-container">
    <h2>Set Your Password</h2>
    <div class="safr-info-box" style="margin-bottom:20px;">
        <p><strong>Your SAFR ID:</strong> <?php echo $safr_id; ?></p>
        <p style="color:#555; font-size:13px; margin-top:6px;">
            Please save this ID — you will need it to log in.
        </p>
    </div>
    <form action="save_pass.php" method="post">
        <input type="hidden" name="safr_id" value="<?php echo $safr_id; ?>">
        <label for="pass">Password</label>
        <input type="password" id="pass" name="pass" placeholder="Set a password" required>
        <button type="submit" class="safr-btn safr-btn-full">Confirm &amp; Save</button>
    </form>
</div>

<?php mysqli_close($conn); ?>
</body>
</html>
