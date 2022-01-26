<?php

    include_once("dbconn.php");

    $obj = [];
    $success = false;
    $message = "";
    $reserved = [];
    $conflict = [];
    $allAppointments = [];
    $doctorSchedules = [];

    $year = $_GET["year"];
    $month = $_GET["month"];
    $day = $_GET["day"];
    $weekday = $_GET["weekday"];
    $docId = $_GET["docId"];
    $userId = $_SESSION['currUser']['id'];

    /*
        Getting patient id
    */
    $query = <<<EOT
        SELECT id FROM patients
        WHERE userID = $userId
    EOT;
    $stmt = $con->query($query);
    $result = $stmt->fetch_row();
    $patId = $result[0];

    /*
        Fetching all the appointments of the doctor on a particular date
    */
    $query = <<<EOT
        SELECT Time FROM appointments WHERE 
        DoctorID = $docId AND
        year = $year AND
        month = $month AND
        day = $day AND
        IsFinished = 0 AND
        IsCancelled = 0
        ORDER BY Time ASC
    EOT;
    $stmt = $con->query($query);
    $reserved = $stmt->fetch_all(MYSQLI_ASSOC);

    /*
        Fetching all appointments made by a patient on a particular date
    */
    $query = <<<EOT
        SELECT Time FROM appointments WHERE
        PatientID = $patId AND
        Day = $day AND
        Month = $month AND
        Year = $year AND
        IsFinished = 0 AND
        IsCancelled = 0
    EOT;
    $stmt = $con->query($query);
    $allAppointments = $stmt->fetch_all(MYSQLI_ASSOC);

    /* 
        Fetching all the doctor's schedule on a particular date
    */
    $query = <<<EOT
        SELECT time_start, time_end FROM doctors_schedules WHERE
        doctor_id = $docId AND
        day = '$weekday'
    EOT;
    $stmt = $con->query($query);
    $doctorSchedules = $stmt->fetch_all(MYSQLI_ASSOC);

    /**
     * Finding the current appointments of the patient that have conflicts with the doctor's schedule
     */
    foreach($allAppointments as $app) {
        $t = explode("-", $app["Time"]);
        $userTs = $t[0];
        $userTe = $t[1];
        $isSkip = false;
        foreach($doctorSchedules as $sched) {
            $ts = $sched["time_start"];
            $te = $sched["time_end"];
            $tste = $ts . "-" . $te;
            foreach($reserved as $res) {
                if($res["Time"] == $tste) {
                    $isSkip = true;
                    break;
                }
            }
            if($isSkip) {
                continue;
            }
            if($userTs > $ts && $userTs < $te ||
                $userTe > $ts && $userTe < $te ||
                $ts > $userTs && $ts < $userTe ||
                $te > $userTs && $te < $userTe ||
                $ts == $userTs && $te == $userTe) {
                    array_push($conflict, $tste);
            }
        }
    }

    $obj = [
        "success" => $success,
        "message" => $message,
        "reserved" => $reserved,
        "conflict" => $conflict
    ];
    $obj = json_encode($obj);
    echo $obj;