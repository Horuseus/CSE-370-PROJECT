<?php
    session_start();
    include('../dbconnect.php');

    if(isset($_POST['vid'])){
        $s = $_POST['skill'];
        $aid = $_POST['aid'];
        $campid = $_POST['cid'];
        $date = $_POST['date'];
        $v= $_POST['vid'];

        $sql1 = "INSERT INTO assignment VALUES ('$aid','$v','$date','$campid')";
        $result1= mysqli_query($conn,$sql1);

        $sql2 = "INSERT INTO assignment_required_skill VALUES ('$aid','$s')";
        $result2 = mysqli_query($conn,$sql2);

        if($result1 && $result2){
           // echo "assignment created successfully";
            header('location:assignments.php');
        }
        else{
            echo "failed";
        }
    }
?>