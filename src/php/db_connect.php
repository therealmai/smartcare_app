<?php
    session_start();

    $con = new mysqli("localhost", "root", "", "smartcare");

    if($con->connect_error) {
        die("Connection failed: " . $con->connect_error);
    }