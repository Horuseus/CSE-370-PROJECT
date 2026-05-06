<?php
include('../dbconnect.php');
session_start();
$ngo_name = $_SESSION['NGO_name'];

$message = "";
$message_type = "";

if(isset($_POST['camp']) && isset($_POST['item']) && isset($_POST['amount'])){
    $camp   = $_POST['camp'];
    $item   = $_POST['item'];
    $amount = $_POST['amount'];

    $sql = "SELECT Unit FROM ngo_inventory WHERE NGO_name='$ngo_name' AND Item_name='$item'";
    $result = mysqli_query($conn, $sql);

    if($result && mysqli_num_rows($result) > 0){
        $row = mysqli_fetch_assoc($result);
        $current_unit = $row['Unit'];

        if($current_unit >= $amount){
            $new_unit = $current_unit - $amount;
            $update_sql = "UPDATE ngo_inventory SET Unit = '$new_unit' WHERE NGO_name='$ngo_name' AND Item_name='$item'";
            if(mysqli_query($conn, $update_sql)){
                $message = "Request accepted. Inventory updated successfully.";
                $message_type = "success";
            } else {
                $message = "Error updating data: " . mysqli_error($conn);
                $message_type = "error";
            }
        } else {
            $message = "Not enough inventory to fulfil this request.";
            $message_type = "error";
        }
    } else {
        $message = "No matching inventory record found.";
        $message_type = "error";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accept Request – SAFR</title>
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
    <a href="NGO_Campreqsubtab.php" class="active">Camp Requests</a>
    <a href="Show_evacs.php">Evacuation Requests</a>
</div>

<div class="safr-container">
    <h2>Accept Camp Request</h2>

    <?php if($message !== ""): ?>
        <div class="safr-msg <?php echo $message_type; ?>"><?php echo $message; ?></div>
    <?php endif; ?>

    <form action="reqaccepttab.php" method="post">
        <label>Your NGO</label>
        <input type="text" name="ngo" value="<?php echo $ngo_name; ?>" readonly>

        <label for="camp">Camp ID</label>
        <input type="text" id="camp" name="camp" placeholder="Enter camp ID">

        <label for="item">Item Name</label>
        <input type="text" id="item" name="item" placeholder="Enter item name">

        <label for="amount">Amount</label>
        <input type="text" id="amount" name="amount" placeholder="Enter amount to deduct">

        <button type="submit" class="safr-btn safr-btn-full">Confirm &amp; Accept</button>
    </form>
</div>

</body>
</html>
