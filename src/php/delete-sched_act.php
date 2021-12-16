<?php

    include_once "dbconn.php";

    $success = false;
    $message = "The schedule was not deleted.";

    $id = $_POST["id"];

    $query = <<<EOT
        DELETE FROM doctors_schedules
        WHERE id = $id
    EOT;

    if($con->query($query)) {
        $success = true;
        $message = "Message was deleted.";
    }

    $obj = [
        "message" => $message,
        "success" => $success
    ];
    $obj = json_encode($obj);
    echo $obj;