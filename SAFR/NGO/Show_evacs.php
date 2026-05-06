<?php
include('../dbconnect.php');
session_start();
$ngo_name = $_SESSION['NGO_name'];
$date = date("Y-m-d");

$sql = "SELECT er.*, c.Camp_id, n.NGO_name 
FROM evac_request er
JOIN camp c ON er.Operating_areas = c.Location
JOIN ngo n ON c.Camp_id = n.Camp_id
WHERE n.NGO_name = '$ngo_name' AND er.Status='0'";
$result2 = mysqli_query($conn, $sql);

if (isset($_POST['evacid'])) {
    $e = $_POST['evacid'];
    $s = 1;
    $d = $date;
    $sql = "UPDATE evac_request SET Status='$s', Allocation_date='$d' WHERE Evareq_id='$e'";
    mysqli_query($conn, $sql);
    if (mysqli_affected_rows($conn) > 0) {
        header('Refresh:1; url=Show_evacs.php');
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Evacuation Requests – SAFR</title>
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
    <a href="NGO_Assignment_subtab.php">Assignments</a>
    <a href="NGO_aidview_subtab.php">Aid View</a>
    <a href="ngo_medical.php">Medical Aid</a>
    <a href="NGO_Campreqsubtab.php">Camp Requests</a>
    <a href="Show_evacs.php" class="active">Evacuation Requests</a>
</div>

<div class="safr-container">
    <h2>Accept Evacuation Request</h2>
    <form action="Show_evacs.php" method="post">
        <label for="evacid">Evacuation Request ID</label>
        <select name="evacid" id="evacid" required>
            <option value="" disabled selected>-- Select a Request --</option>
            <?php while ($row = mysqli_fetch_assoc($result2)): ?>
            <option value="<?php echo $row['Evareq_id']; ?>">
                <?php echo $row['Evareq_id'] . " – Priority: " . $row['Priority']; ?>
            </option>
            <?php endwhile; ?>
        </select>

        <label>Allocation Date</label>
        <input type="date" value="<?php echo $date; ?>" readonly>

        <button type="submit" class="safr-btn safr-btn-full">Accept Evacuation Request</button>
    </form>
</div>

</body>
</html>