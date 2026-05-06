<?php
session_start();
require_once("../dbconnect.php");

if(isset($_POST['Sid']) && isset($_POST['pass'])){
    $u = trim($_POST['Sid']);
    $p = trim($_POST['pass']);

    if(empty($u) || empty($p)){
        header("Location: login.php?error=empty");
        exit();
    }

    $sql    = "SELECT * FROM refugee_credential WHERE Safr_id = '$u' AND Password = '$p'";
    $result = mysqli_query($conn, $sql);

    if(mysqli_num_rows($result) != 0){
        $_SESSION['safr_id'] = $u;
        header("Location: ../Refugeedashboard/refugee_dashboard.php");
        exit();
    } else {
        header("Location: login.php?error=invalid");
        exit();
    }
}

header("Location: login.php");
exit();
?>