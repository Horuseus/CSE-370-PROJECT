<?php
session_start();
include("../dbconnect.php");

if(!isset($_SESSION['safr_id'])){
    header("Location: ../refugee login/login.php");
    exit;
}

$safr_id = $_SESSION['safr_id'];

if(isset($_POST['doc_number']) && isset($_POST['doc_name'])){
    $doc_number = $_POST['doc_number'];
    $doc_type   = $_POST['doc_name'];
    $sql = "INSERT INTO identity_doc (Safr_id, Doc_number, Doc_type) VALUES ('$safr_id', '$doc_number', '$doc_type')";
    mysqli_query($conn, $sql);
}

$sql    = "SELECT * FROM identity_doc WHERE Safr_id = '$safr_id'";
$result = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Documents – SAFR</title>
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
    <a href="see_documents.php" class="active">Documents</a>
    <a href="family_Search.php">Family Search</a>
    <a href="evac_rec.php">Evacuation Request</a>
    <a href="camp_change.php">Camp Change</a>
</div>

<div class="safr-container">
    <h2>My Identity Documents</h2>

    <table class="safr-table">
        <thead>
            <tr>
                <th>Document Type</th>
                <th>Document Number</th>
            </tr>
        </thead>
        <tbody>
        <?php if(mysqli_num_rows($result) > 0): ?>
            <?php while($row = mysqli_fetch_array($result)): ?>
            <tr>
                <td><?php echo $row['Doc_type']; ?></td>
                <td><?php echo $row['Doc_number']; ?></td>
            </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr><td colspan="2">No documents added yet.</td></tr>
        <?php endif; ?>
        </tbody>
    </table>

    <h3 style="margin-top:28px;">Add New Document</h3>
    <form method="post" style="margin-top:12px;">
        <label for="doc_name">Document Type</label>
        <select name="doc_name" id="doc_name" required>
            <option value="">-- Select Document Type --</option>
            <option value="NID">NID</option>
            <option value="Passport">Passport</option>
            <option value="Driving License">Driving License</option>
            <option value="School/Office ID Card">School/Office ID Card</option>
        </select>

        <label for="doc_number">Document Number</label>
        <input type="text" id="doc_number" name="doc_number" placeholder="Enter document number" required>

        <button type="submit" class="safr-btn safr-btn-full">Add Document</button>
    </form>
</div>

</body>
</html>