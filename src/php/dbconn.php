<?php

    session_start();

    $server = "localhost";
    $user = "root";
    $pass = "";
    $db = "smartcare";

    $con = mysqli_connect($server, $user, $pass, $db);

    if (!$con) {
        die('Could not connect: ' . mysqli_error());
        exit;
    }