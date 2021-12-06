<?php
session_start();
var_dump($_SESSION['currUser']);
exit();
if(!isset($_SESSION['currUser']))
    header("location:loginpage.php");
?>
