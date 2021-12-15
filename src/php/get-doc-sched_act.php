<?php

    include_once "dbconn.php";

    $id = $_GET["id"];

    $query = <<<EOT
        SELECT * FROM doctors_schedules
        WHERE doctor_id = $id
    EOT;

    $stmt = $con->query($query);
    $data = $stmt->fetch_all(MYSQLI_ASSOC);
    
    $keys = array();
    foreach($data as $key => $row) {
        $keys[$key] = $row["time_start"];
    }
    array_multisort($keys, SORT_ASC, $data);

    $stmt->close();

    $obj = [
        "data" => $data
    ];
    $obj = json_encode($obj);
    echo $obj;