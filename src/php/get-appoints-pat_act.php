<?php

    include_once "dbconn.php";

    $obj = [];
    $finished = [];
    $unfinished = [];
    $appIdArr = json_decode($_GET["appIdArr"]);

    $userId = $_SESSION["currUser"]["id"];

    $query = <<<EOT
        SELECT patients.id FROM patients
        WHERE userID = $userId
    EOT;

    $stmt = $con->query($query);

    $result = $stmt->fetch_row();
    $patId = $result[0];

    $query = <<<EOT
        SELECT appointments.ID, appointments.Type, appointments.Day, appointments.Month, appointments.Year, appointments.Time, appointments.IsFinished, users.firstname, users.lastname, users.middle_initial, users.contact, doctors.specialization 
        FROM appointments
        INNER JOIN doctors
        ON doctors.id = appointments.DoctorID
        INNER JOIN users
        ON users.id = doctors.userID
        WHERE appointments.PatientID = $patId AND
        appointments.IsCancelled = 0
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
        "unfinished" => $unfinished,
        "appIdArr" => $appIdArr,
        "patId" => $patId,
        "userId" => $userId
    ];
    $obj = json_encode($obj);
    echo $obj;