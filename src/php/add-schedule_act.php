<?php

    include_once "dbconn.php";

    $success = true;
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
        SELECT time_start, time_end
        FROM doctors_schedules
        WHERE doctor_id = $docId AND day = "$day"
    EOT;

    if($stmt = $con->query($query)) {
        while($result = $stmt->fetch_assoc()) {
            $ets = $result["time_start"];
            $ete = $result["time_end"];
            if($timeStart > $ets && $timeStart < $ete)
                $success = false;
            if($timeEnd > $ets && $timeEnd < $ete)
                $success = false;
            if($ets > $timeStart && $ets < $timeEnd)
                $success = false;
            if($ete > $timeStart && $ete < $timeEnd)
                $success = false;
            if(!$success) {
                $message = "The schedule you added overlaps with another existing schedule. Please adjust the schedule again.";
                break;
            }
        }
    }

    if($success) {
        $query = <<<EOT
            INSERT INTO doctors_schedules(doctor_id, time_start, time_end, day)
            VALUES($docId, '$timeStart', '$timeEnd', '$day')
        EOT;

        if($con->query($query)) {
            $success = true;
            $message = "You have successfully added a schedule.";
        }
    }

    $obj = [
        "message" => $message,
        "success" => $success
    ];
    $obj = json_encode($obj);
    echo $obj;