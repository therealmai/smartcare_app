<?php

    include_once("dbconn.php");

    $obj = [];
    $msg = "Error: Did not appoint!";
    $success = false;

    $date = explode("-", $_POST["date"]);
    $year = $date[0];
    $month = $date[1];
    $day = $date[2];
    $time = $_POST["time"];
    $type = $_POST["appoint-type"];
    $docId = $_POST["docId"];
    $patientId = $_SESSION['currUser']["id"];
    //$patientId = $_SESSION["patientId"];

    $query = <<<EOT
        INSERT INTO appointments(DoctorID, PatientID, Type, Day, Month, Year, Time, isFinished)
        VALUES('$docId', '$patientId', '$type', '$day', '$month', '$year', '$time', 0)
    EOT;

    $stmt = $con->query($query);

    if($stmt) {
        $msg = "Success! You had made an appointment.";
        $success = true;
    }

    // $obj = [
    //     "date" => $date,
    //     "time" => $time,
    //     "type" => $type,
    //     "docId" => $docId
    // ];

    $obj = [
        "msg" => $msg,
        "success" => $success
    ];

    $obj = json_encode($obj);
    echo $obj; 