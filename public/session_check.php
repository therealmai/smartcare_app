<?php

session_start();
if(!isset($_SESSION['currUser']))
    header("location: loginpage.php");
?>
