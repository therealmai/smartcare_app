<?php

    include_once "dbconn.php";

    $obj = [];
    $finished = [];
    $unfinished = [];
    $notifications = [];
    $appIdArr = json_decode($_GET["appIdArr"]);

    $userId = $_SESSION["currUser"]["id"];

    $query = <<<EOT
        SELECT id FROM doctors
        WHERE userID = $userId
    EOT;

    $stmt = $con->query($query);
    $result = $stmt->fetch_row();
    $docId = $result[0];

    $query = <<<EOT
        SELECT appointments.ID, appointments.Type, appointments.Day, appointments.Month, appointments.Year, appointments.Time, appointments.IsFinished, appointments.IsCancelled, users.firstname, users.lastname, users.middle_initial, users.contact, users.year AS "userYear", users.month AS "userMon", users.day AS "userDay"
        FROM appointments
        INNER JOIN patients
        ON patients.id = appointments.PatientID
        INNER JOIN users
        ON users.id = patients.userID
        WHERE appointments.DoctorID = $docId
    EOT;

    $stmt = $con->query($query);

    while($result = $stmt->fetch_assoc()) {
        $result["length"] = $result["Month"] + $result["Day"] + $result["Year"];
        if(in_array($result["ID"], $appIdArr))
            break;
        if($result["IsFinished"] == 1)
            array_push($finished, $result);
        else if($result["IsCancelled"] == 0) 
            array_push($unfinished, $result);
        else
            array_push($notifications, $result);
    }

    $keys = array();
    foreach($finished as $key => $row) {
        $keys[$key] = $row["length"];
    }
    array_multisort($keys, SORT_DESC, $finished);

    $keys = array();
    foreach($unfinished as $key => $row) {
        $keys[$key] = $row["length"];
    }
    array_multisort($keys, SORT_DESC, $unfinished);

    $stmt->close();

    $obj = [
        "finished" => $finished,
        "unfinished" => $unfinished,
        "notifications" => $notifications
    ];
    $obj = json_encode($obj);
    echo $obj;