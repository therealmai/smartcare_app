<?php

    include_once("dbconn.php");

    $obj = [];
    $msg = "Error: Did not appoint!";
    $success = true;

    $date = explode("-", $_POST["date"]);
    $year = $date[0];
    $month = $date[1];
    $day = $date[2];
    $time = $_POST["time"];
    $type = $_POST["appoint-type"];
    $docId = $_POST["docId"];
    $userId = $_SESSION['currUser']["id"];
    $timeSplit = explode("-", $time);
    $userTs = $timeSplit[0];
    $userTe = $timeSplit[1];

    $query = <<<EOT
        SELECT id FROM patients
        WHERE userID = $userId
    EOT;
    
    $stmt = $con->query($query);
    $result = $stmt->fetch_row();
    $patId = $result[0];

    $query = <<<EOT
        SELECT * FROM appointments WHERE
        PatientID = $patId AND
        Day = $day AND
        Month = $month AND
        Year = $year
    EOT;
    $stmt = $con->query($query);
    while($result = $stmt->fetch_assoc()) {
        $t = explode("-", $result["Time"]);
        $ts = $t[0];
        $te = $t[1];
        if($userTs > $ts && $userTs < $te ||
            $userTe > $ts && $userTe < $te ||
            $ts > $userTs && $ts < $userTe ||
            $te > $userTs && $te < $userTe ||
            $ts == $userTs && $te == $userTe) {
                $success = false;
                $msg = "You have another schedule ongoing during the time of your choosing.";
                break;
        }
    }

    // $query = <<<EOT
    //     SELECT * FROM appointments WHERE 
    //     DoctorID = $docId AND
    //     Day = $day AND
    //     Month = $month AND
    //     Year = $year AND
    //     Time = '$time' AND 
    //     IsCancelled = 0    
    // EOT;
    // $stmt = $con->query($query);
    // if($success && $stmt->num_rows > 0) {
    //     $success = false;
    //     $msg = "This time schedule is already occupied. Please choose another.";
    // }

    $query = <<<EOT
        INSERT INTO appointments(DoctorID, PatientID, Type, Day, Month, Year, Time, isFinished, isCancelled)
        VALUES('$docId', '$patId', '$type', '$day', '$month', '$year', '$time', 0, 0)
    EOT;
    if($success) {
        $stmt = $con->query($query);
        $msg = "Success! You had made an appointment.";
    }

    $obj = [
        "msg" => $msg,
        "success" => $success
    ];

    $obj = json_encode($obj);
    echo $obj; 