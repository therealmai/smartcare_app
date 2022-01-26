<?php

    include_once "dbconn.php";

    $id = $_POST["id"];
    $message = "There was an error in discarding the notification.";
    $success = false;

    $query = <<<EOT
        UPDATE appointments
        SET IsDiscarded = 1
        WHERE ID = $id
    EOT;

    $stmt = $con->query($query);

    if($stmt) {
        $message = "The notification has been discarded successfully.";
        $success = true;
    }

    $obj = [
        "message" => $message,
        "success" => $success
    ];  

    $obj = json_encode($obj);

    echo $obj;