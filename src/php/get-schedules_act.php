<?php

    include_once "dbconn.php";

    $data = [];
    $message = "";
    $success = false;

    $userId = $_SESSION["currUser"]["id"];
    
    $query = <<<EOT
        SELECT id FROM doctors
        WHERE userID = $userId
    EOT;  
    
    $stmt = $con->query($query);
    $result = $stmt->fetch_row();
    $docId = $result[0];

    $query = <<<EOT
        SELECT * FROM doctors_schedules
        WHERE doctor_id = $docId
    EOT;

    $stmt = $success = $con->query($query);
    $data = $stmt->fetch_all(MYSQLI_ASSOC);

    $stmt->close();

    $obj = [
        "data" => $data,
        "message" => $message,
        "success" => $success
    ];
    $obj = json_encode($obj);
    echo $obj;