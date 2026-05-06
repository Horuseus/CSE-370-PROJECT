<?php
session_start();
include('../dbconnect.php');
$ngo_name = $_SESSION['NGO_name'];

if(isset($_POST['item']) && isset($_POST['unit']) && isset($_POST['cate'])){
    $u = $_POST['item'];
    $s = $_POST['unit'];
    $c = $_POST['cate'];

    $sql    = "INSERT INTO ngo_inventory VALUES ('$ngo_name', '$u', '$c', '$s')";
    $result = mysqli_query($conn, $sql);

    if(mysqli_affected_rows($conn)){
        header('location: NGO_aidview_subtab.php');
    } else {
        header('location: update_inventory.php');
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Inventory – SAFR</title>
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
    <a href="NGO_aidview_subtab.php" class="active">Aid View</a>
    <a href="ngo_medical.php">Medical Aid</a>
    <a href="NGO_Campreqsubtab.php">Camp Requests</a>
    <a href="Show_evacs.php">Evacuation Requests</a>
</div>

<div class="safr-container">
    <h2>Add Aid to Inventory</h2>
    <form action="update_inventory.php" method="post">
        <label>NGO Name</label>
        <input type="text" name="name" value="<?php echo $ngo_name; ?>" readonly>

        <label for="item">Item Name</label>
        <input type="text" id="item" name="item" placeholder="Enter item name" required>

        <label for="cate">Item Category</label>
        <select id="cate" name="cate" required>
            <option value="" disabled selected>-- Select Category --</option>
            <option value="Food">Food</option>
            <option value="Shelter">Shelter</option>
            <option value="Medical">Medical</option>
            <option value="Sanitation">Sanitation</option>
        </select>

        <label for="unit">Item Unit (quantity)</label>
        <input type="number" id="unit" name="unit" placeholder="Enter quantity" required>

        <button type="submit" class="safr-btn safr-btn-full">Add Items</button>
    </form>
</div>

</body>
</html>