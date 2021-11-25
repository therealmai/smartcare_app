<?php

    include_once("dbconn.php");

    $docId = $_GET["docId"];

    $obj = [];
    $data = [];
    $message = "";
    $valid = false;

    $sql = <<<EOT
        SELECT name, contact, specialization
        FROM users
        INNER JOIN doctors
        ON users.id = doctors.userID
        WHERE doctors.id = '$docId'
    EOT;

    $stmt = $con->query($sql);

    if($stmt) {
        $data = $stmt->fetch_assoc();
        $valid = true;
    }

    $obj = [
        'valid' => $valid,
        'data' => $data
    ];
    $obj = json_encode($obj, JSON_FORCE_OBJECT);
    echo $obj;