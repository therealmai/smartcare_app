<?php

    include_once "dbconn.php";

    $obj = [];
    $finished = [];
    $unfinished = [];
    $cancelled = [];
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
        SELECT image_profile, appointments.ID, appointments.Type, appointments.Day, appointments.Month, appointments.Year, appointments.Time, appointments.IsFinished, appointments.IsCancelled, appointments.Canceller, users.firstname, users.lastname, users.middle_initial, users.contact, doctors.specialization 
        FROM appointments
        INNER JOIN doctors
        ON doctors.id = appointments.DoctorID
        INNER JOIN users
        ON users.id = doctors.userID
        WHERE appointments.PatientID = $patId AND
        appointments.IsDiscarded = 0
    EOT;
    
    $stmt = $con->query($query);

    while($result = $stmt->fetch_assoc()) {
        $result["length"] = sprintf("%04u%02u%02u%s", $result["Year"], $result["Month"], $result["Day"], $result["Time"]);
        if(in_array($result["ID"], $appIdArr))
            continue;
        if($result["IsCancelled"] == 1)
            array_push($cancelled, $result);
        else if($result["IsFinished"] == 1)
            array_push($finished, $result);
        else 
            array_push($unfinished, $result);
    }

    $keys = array();
    foreach($finished as $key => $row) {
        $keys[$key] = $row["length"];
    }
    array_multisort($keys, SORT_ASC, $finished);

    $keys = array();
    foreach($unfinished as $key => $row) {
        $keys[$key] = $row["length"];
    }
    array_multisort($keys, SORT_ASC, $unfinished);

    $keys = array();
    foreach($cancelled as $key => $row) {
        $keys[$key] = $row["length"];
    }
    array_multisort($keys, SORT_ASC, $cancelled);

    $stmt->close();

    $obj = [
        "finished" => $finished,
        "unfinished" => $unfinished,
        "cancelled" => $cancelled,
        "appIdArr" => $appIdArr
    ];
    $obj = json_encode($obj);
    echo $obj;