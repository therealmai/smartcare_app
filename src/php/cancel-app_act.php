<?php

    include_once "dbconn.php";

    $id = $_POST["id"];
    $message = "Error! The appointment was not properly cancelled.";
    $success = false;
    $obj = [];

    $query = <<<EOT
        UPDATE appointments
        SET IsCancelled = 1
        WHERE ID = '$id'
    EOT;

    if($con->query($query)) {
        $message = "You have successfully cancelled your appointment.";
        $success = true;
    }

    $obj = [
        "message" => $message,
        "success" => $success
    ];

    $obj = json_encode($obj);
    echo $obj;