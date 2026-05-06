<?php
session_start();
include('../dbconnect.php');

if(!isset($_SESSION['NGO_name'])){
    header('location:NGOsign.php');
}

$ngo_name = $_SESSION['NGO_name'];

$sql = "SELECT Camp_id FROM ngo WHERE NGO_name='$ngo_name'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$camp_id = $row['Camp_id'];

if(isset($_POST['requested_inv']) && isset($_POST['units'])){
    $requested_inv = $_POST['requested_inv'];
    $units = $_POST['units'];

    $get_item_sql = "SELECT Item_name FROM camp_medical_inventory WHERE Inventory_id='$requested_inv'";
    $get_item_result = mysqli_query($conn, $get_item_sql);
    
    if($get_item_result && mysqli_num_rows($get_item_result) > 0){
        $item_row = mysqli_fetch_assoc($get_item_result);
        $item_needed = $item_row['Item_name'];
        
        $get_requesting_sql = "SELECT Inventory_id FROM camp_medical_inventory WHERE Camp_id='$camp_id' LIMIT 1";
        $get_requesting_result = mysqli_query($conn, $get_requesting_sql);
        
        if($get_requesting_result && mysqli_num_rows($get_requesting_result) > 0){
            $requesting_row = mysqli_fetch_assoc($get_requesting_result);
            $requesting_inv = $requesting_row['Inventory_id'];
            
            $insert_sql = "INSERT INTO camp_medical_inventory_asks_for (Requesting_Inventory_id, Requested_Inventory_id, Item_needed, Units, Status) 
                           VALUES ('$requesting_inv', '$requested_inv', '$item_needed', '$units', 0)";
            
            if(mysqli_query($conn, $insert_sql)){
                $success_msg = "Medical request created successfully!";
            } else {
                $error_msg = "Failed to create request: " . mysqli_error($conn);
            }
        } else {
            $error_msg = "No inventory found for your camp. Please contact administrator.";
        }
    } else {
        $error_msg = "Invalid inventory selected.";
    }
}

$other_inventory_sql = "SELECT Inventory_id, Item_name, Camp_id FROM camp_medical_inventory";
$other_inventory_result = mysqli_query($conn, $other_inventory_sql);

$pending_sql = "SELECT cmia.*, cmi1.Camp_id as Requesting_Camp, cmi2.Camp_id as Requested_Camp 
                FROM camp_medical_inventory_asks_for cmia
                JOIN camp_medical_inventory cmi1 ON cmia.Requesting_Inventory_id = cmi1.Inventory_id
                JOIN camp_medical_inventory cmi2 ON cmia.Requested_Inventory_id = cmi2.Inventory_id
                WHERE cmi1.Camp_id = '$camp_id' AND cmia.Status = 0";
$pending_result = mysqli_query($conn, $pending_sql);

$accepted_sql = "SELECT cmia.*, cmi1.Camp_id as Requesting_Camp, cmi2.Camp_id as Requested_Camp 
                FROM camp_medical_inventory_asks_for cmia
                JOIN camp_medical_inventory cmi1 ON cmia.Requesting_Inventory_id = cmi1.Inventory_id
                JOIN camp_medical_inventory cmi2 ON cmia.Requested_Inventory_id = cmi2.Inventory_id
                WHERE cmi1.Camp_id = '$camp_id' AND cmia.Status = 1";
$accepted_result = mysqli_query($conn, $accepted_sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Medical Aid – SAFR</title>
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
    <a href="ngo_medical.php" class="active">Medical Aid</a>
    <a href="NGO_Campreqsubtab.php">Camp Requests</a>
    <a href="Show_evacs.php">Evacuation Requests</a>
</div>

<div class="safr-container wide">

    <h2>Create Medical Supply Request</h2>

    <?php if(isset($success_msg)): ?>
        <div class="safr-msg success"><?php echo $success_msg; ?></div>
    <?php endif; ?>
    <?php if(isset($error_msg)): ?>
        <div class="safr-msg error"><?php echo $error_msg; ?></div>
    <?php endif; ?>

    <form action="ngo_medical.php" method="post">
        <label>Your Camp</label>
        <input type="text" name="your_camp" value="<?php echo $camp_id; ?>" readonly>

        <label for="requested_inv">Request From (Camp Inventory)</label>
        <select name="requested_inv" id="requested_inv" required>
            <option value="" disabled selected>-- Select Inventory --</option>
            <?php while($other_inv = mysqli_fetch_assoc($other_inventory_result)): ?>
            <option value="<?php echo $other_inv['Inventory_id']; ?>">
                <?php echo $other_inv['Inventory_id'] . " – " . $other_inv['Item_name'] . " (Camp: " . $other_inv['Camp_id'] . ")"; ?>
            </option>
            <?php endwhile; ?>
        </select>

        <label for="units">Units Required</label>
        <input type="number" id="units" name="units" min="1" required>

        <button type="submit" class="safr-btn safr-btn-full">Create Request</button>
    </form>

    <div class="safr-section" style="margin-top:36px;">
        <h2>Pending Medical Requests</h2>
        <table class="safr-table">
            <thead>
                <tr>
                    <th>Requesting Inv ID</th>
                    <th>Requested Inv ID</th>
                    <th>Item Needed</th>
                    <th>Units</th>
                    <th>From Camp</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
            <?php if(mysqli_num_rows($pending_result) > 0): ?>
                <?php while($row = mysqli_fetch_array($pending_result)): ?>
                <tr>
                    <td><?php echo $row['Requesting_Inventory_id']; ?></td>
                    <td><?php echo $row['Requested_Inventory_id']; ?></td>
                    <td><?php echo $row['Item_needed']; ?></td>
                    <td><?php echo $row['Units']; ?></td>
                    <td><?php echo $row['Requested_Camp']; ?></td>
                    <td><span class="badge badge-pending">Pending</span></td>
                </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr><td colspan="6">No pending medical requests.</td></tr>
            <?php endif; ?>
            </tbody>
        </table>
    </div>

    <div class="safr-section" style="margin-top:36px;">
        <h2>Accepted Medical Requests</h2>
        <table class="safr-table">
            <thead>
                <tr>
                    <th>Requesting Inv ID</th>
                    <th>Requested Inv ID</th>
                    <th>Item Needed</th>
                    <th>Units</th>
                    <th>From Camp</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
            <?php if(mysqli_num_rows($accepted_result) > 0): ?>
                <?php while($row = mysqli_fetch_array($accepted_result)): ?>
                <tr>
                    <td><?php echo $row['Requesting_Inventory_id']; ?></td>
                    <td><?php echo $row['Requested_Inventory_id']; ?></td>
                    <td><?php echo $row['Item_needed']; ?></td>
                    <td><?php echo $row['Units']; ?></td>
                    <td><?php echo $row['Requested_Camp']; ?></td>
                    <td><span class="badge badge-accepted">Accepted</span></td>
                </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr><td colspan="6">No accepted medical requests.</td></tr>
            <?php endif; ?>
            </tbody>
        </table>
    </div>

</div>

</body>
</html>
