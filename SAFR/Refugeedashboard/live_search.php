<?php
session_start();
include("../dbconnect.php");

if(!isset($_SESSION['safr_id'])){
    header("Location: ../refugee login/login.php");
    exit;
}

$safr_id = $_SESSION['safr_id'];

if(isset($_GET['name'])){
       $u = $_GET['name'];

$sql = "SELECT r.*, c.Location
        FROM refugee r
        LEFT JOIN refugee_stay_in_camp rc 
            ON r.Safr_id = rc.Safr_id
        LEFT JOIN camp c 
            ON rc.Camp_id = c.Camp_id
        WHERE r.Full_name LIKE '%$u%'
        Group BY  r.Full_name
        ORDER BY rc.Arrival_date DESC";

$result = mysqli_query($conn, $sql);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Family Search</title>
</head>
<body>
    <br><br><br>

    <div align="center">
        <h2>Search Refugee</h2>
        <form method="GET">
            <h3>Missing Person's name:</h3>
            <input type="text" name="name" placeholder="Enter Full Name" size="50" required>
            <br><br>
            <input type="submit" name="submit" value="Search">
        </form>
    </div>

    <div align="center">
    <?php if(isset($_GET['name'])){ ?>
    <table border="1" cellpadding="10">
        <tr>
            <th>SAFR ID</th>
            <th>Full Name</th>
            <th>Blood Group</th>
            <th>Date of Birth</th>
            <th>Origin City</th>
            <th>Camp Location</th>
        </tr>
        <?php
            if(mysqli_num_rows($result) > 0){
                while($row = mysqli_fetch_assoc($result)){
                    echo "<tr>";
                    echo "<td>" . $row['Safr_id'] . "</td>";
                    echo "<td>" . $row['Full_name'] . "</td>";
                    echo "<td>" . $row['Blood_Group'] . "</td>";
                    echo "<td>" . $row['Date_of_Birth'] . "</td>";
                    echo "<td>" . $row['City'] . "</td>";
                    echo "<td>" . $row['Location']. "</td>";
                    echo "</tr>";
                }
            }else{
                echo "<tr><td colspan='6'>No person found</td></tr>";
            }
        ?>
    </table>
    <?php } ?>

    <br><br>
    <a href="family_Search.php">New Search</a> |
    <a href="refugee_dashboard.php">Back to Dashboard</a>
    </div>

</body>
</html>