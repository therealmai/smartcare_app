<?php

    include_once "dbconn.php";

    $obj = [];
    $finished = [];
    $unfinished = [];
    $appIdArr = json_decode($_GET["appIdArr"]);

    $docId = 3;

    $query = <<<EOT
        SELECT appointments.ID, appointments.Type, appointments.Day, appointments.Month, appointments.Year, appointments.Time, appointments.IsFinished, users.firstname, users.lastname, users.middle_initial 
        FROM appointments
        INNER JOIN patients
        ON patients.id = appointments.PatientID
        INNER JOIN users
        ON users.id = patients.userID
        WHERE appointments.DoctorID = $docId
    EOT;

    $stmt = $con->query($query);

    while($result = $stmt->fetch_assoc()) {
        if(in_array($result["ID"], $appIdArr))
            break;
        if($result["IsFinished"] == 1)
            array_push($finished, $result);
        else 
            array_push($unfinished, $result);
    }

    $stmt->close();

    $obj = [
        "finished" => $finished,
        "unfinished" => $unfinished
    ];
    $obj = json_encode($obj);
    echo $obj;