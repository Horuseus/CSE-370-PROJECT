<?php
session_start();
include("../dbconnect.php");

if(!isset($_SESSION['safr_id'])){
    header("Location: ../refugee login/login.php");
    exit;
}

$safr_id = $_SESSION['safr_id'];

if(isset($_POST['missing_name']) && isset($_POST['doc_number']) && isset($_POST['Doc_name'])){
    $u = $_POST['missing_name'];
    $doc_type = $_POST['Doc_name'];
    $n = $doc_type . "-" . $_POST['doc_number'];
    if(empty($n)) { $n = NULL; }
    $sql = "INSERT INTO search_req (Safr_id, Status, Missing_Name, Doc_number, Match_Safr_id) VALUES ('$safr_id','0','$u','$n',NULL)";
    $result = mysqli_query($conn, $sql);
    if(mysqli_affected_rows($conn) > 0){
        header('location:submit.php');
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Family Search – SAFR</title>
    <link href="../css/safr.css" rel="stylesheet">
</head>
<body>

<div class="safr-topbar">
    <a href="refugee_dashboard.php" class="brand">SAFR</a>
    <div class="topbar-right">
        <a href="refugee_logout.php">Logout</a>
    </div>
</div>

<div class="safr-nav">
    <a href="refugee_dashboard.php">Dashboard</a>
    <a href="see_documents.php">Documents</a>
    <a href="family_Search.php" class="active">Family Search</a>
    <a href="evac_rec.php">Evacuation Request</a>
    <a href="camp_change.php">Camp Change</a>
</div>

<div class="safr-container">
    <h2>Search for a Family Member</h2>
    <form action="" method="post">
        <label>Your SAFR ID</label>
        <input type="text" value="<?php echo $safr_id; ?>" readonly>

        <label for="missing_name">Missing Person's Full Name</label>
        <input type="text" id="missing_name" name="missing_name" placeholder="Enter full name of missing person" required>

        <label for="Doc_name">Missing Person's Document Type</label>
        <select id="Doc_name" name="Doc_name" required>
            <option value="">-- Select Document Type --</option>
            <option value="DIFF">None of the mentioned</option>
            <option value="NID">NID</option>
            <option value="PID">Passport</option>
            <option value="DL">Driving License</option>
            <option value="EDU">School/Office ID Card</option>
        </select>

        <label for="doc_number">Document Number</label>
        <input type="text" id="doc_number" name="doc_number" placeholder="Enter their passport or ID number" required>

        <p style="font-size:13px; color:#666; margin-bottom:16px;">
            <strong>Status:</strong> Pending (will be updated when found)
        </p>

        <button type="submit" class="safr-btn safr-btn-full">Submit Search Request</button>
    </form>
    <div class="note" style="margin-top:18px;"><a href="submit.php">View My Requests</a></div>
    <div class="note" style="margin-top:18px;"><a href="live_search.php">Live Search</a></div>
</div>

</body>
</html>