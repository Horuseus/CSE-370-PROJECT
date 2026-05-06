<?php
require_once('../dbconnect.php');

if(isset($_POST['vid']) && isset($_POST['sname']) && isset($_POST['email']) && isset($_POST['phn']) && isset($_POST['origin'])){
    $a = $_POST['vid'];
    $b = $_POST['sname'];
    $c = $_POST['email'];
    $d = $_POST['phn'];
    $e = $_POST['origin'];
    $p = $_POST['pass'];
    $s = $_POST['skill'];

    $sql     = "INSERT INTO volunteer VALUES('$a','$b','$c','$d','$e','$s')";
    $result1 = mysqli_query($conn, $sql);

    $sql     = "INSERT INTO volunteer_credential VALUES('$a','$p')";
    $result2 = mysqli_query($conn, $sql);

    if($result1 && $result2){
        header("Refresh: 1; url=Volunteer_signin.php");
    } else {
        header("Location: add_volunteer.php");
    }
}
?>