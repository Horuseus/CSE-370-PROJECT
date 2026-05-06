<?php
include('../dbconnect.php');
session_start();

if(isset($_POST['ID']) && isset($_POST['pass'])){
    $u = $_POST['ID'];
    $p = $_POST['pass'];

    $sql    = "SELECT * FROM volunteer_credential WHERE Volunteer_id = '$u' AND Password = '$p'";
    $result = mysqli_query($conn, $sql);

    if(mysqli_num_rows($result) != 0){
        $_SESSION['vol_id'] = $u;
        header("Location: assigned_ass.php");
    } else {
        header("Location: Volunteer_signin.php");
    }
}
?>
