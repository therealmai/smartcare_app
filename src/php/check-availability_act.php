<?php

    include_once("dbconn.php");

    $obj = [];
    $success = false;
    $message = "";
    $data = [];

    $year = $_GET["year"];
    $month = $_GET["month"];
    $day = $_GET["day"];
    $docId = $_GET["docId"];

    $query = <<<EOT
        SELECT Time FROM appointments 
        WHERE DoctorID = $docId AND
        year = $year AND
        month = $month AND
        day = $day AND
        IsFinished = 0 AND
        IsCancelled = 0
        ORDER BY Time ASC
    EOT;
    $stmt = $con->query($query);
    $data = $stmt->fetch_all(MYSQLI_ASSOC);


    $obj = [
        "success" => $success,
        "message" => $message,
        "data" => $data
    ];
    $obj = json_encode($obj);
    echo $obj;