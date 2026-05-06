<?php
    include("../dbconnect.php");

    $safr_id  = $_POST['safr_id'];
    $password = $_POST['pass'];

    $sql = "INSERT INTO refugee_credential (Safr_id, Password) VALUES ('$safr_id', '$password')";
    mysqli_query($conn, $sql);

    if(mysqli_affected_rows($conn)){
        header('location:login.php');
    }else{
        echo "Something went wrong";
    }
?>