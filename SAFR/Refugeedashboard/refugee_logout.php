<?php
session_start();
session_destroy();
header("Location:../refugee login/login.php");
?>