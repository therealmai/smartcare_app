<?php

    include_once "dbconn.php";

    $obj = [];
    $finished = [];
    $unfinished = [];

    $patId = 1;
    //$patId = $_SESSION["patId"];

    $query = <<<EOT
        SELECT appointments.Type, appointments.Day, appointments.Month, appointments.Year, appointments.Time, appointments.IsFinished, users.firstname, users.lastname, users.middle_initial, doctors.specialization 
        FROM appointments
        INNER JOIN doctors
        ON doctors.id = appointments.DoctorID
        INNER JOIN users
        ON users.id = doctors.userID
        WHERE appointments.PatientID = $patId
    EOT;
    
    $stmt = $con->query($query);

    while($result = $stmt->fetch_assoc()) {
        if($result["IsFinished"] == 1)
            array_push($finished, $result);
        else 
            array_push($unfinished, $result);
    }

    $obj = [
        "finished" => $finished,
        "unfinished" => $unfinished
    ];
    $obj = json_encode($obj);
    echo $obj;