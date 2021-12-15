<?php

    include_once "dbconn.php";

    $id = $_POST["id"];
    $success = false;
    $message = "Error: Something happened on our end.";

    $query = <<<EOT
        UPDATE appointments
        SET IsFinished = 1
        WHERE ID = $id;
    EOT;

    if($con->query($query)) {
        $success = true;
        $message = "Success!";
    }

    $con->close();

    $obj = [
        "success" => $success,
        "message" => $message
    ];

    $obj = json_encode($obj);

    echo $obj;