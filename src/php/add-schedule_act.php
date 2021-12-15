<?php

    include_once "dbconn.php";

    $success = false;
    $message = "An error occured in adding the schedule.";

    $userId = $_SESSION["currUser"]["id"];
    $timeStart = $_POST["time-start"];
    $timeEnd = $_POST["time-end"];
    $day = $_POST["day"];

    $query = <<<EOT
        SELECT id FROM doctors
        WHERE userID = $userId
    EOT;

    $stmt = $con->query($query);
    $result = $stmt->fetch_row();
    $docId = $result[0];

    $query = <<<EOT
        INSERT INTO doctors_schedules(doctor_id, time_start, time_end, day)
        VALUES($docId, '$timeStart', '$timeEnd', '$day')
    EOT;

    if($con->query($query)) {
        $success = true;
        $message = "You have successfully added a schedule.";
    }

    $obj = [
        "message" => $message,
        "success" => $success
    ];
    $obj = json_encode($obj);
    echo $obj;