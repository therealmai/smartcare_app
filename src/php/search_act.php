<?php

    include_once("dbconn.php");

    $obj = [];
    $data = [];
    $message = "";
    $isFound = false;

    $specialty = $_GET["specialty"];
    $order = explode("-", $_GET["order"]);
    $docIds = json_decode($_GET["docIds"]);
    $name = strtolower($_GET["docName"]);
    
    $query = <<<EOT
        SELECT image_profile, doctors.id, specialization, firstname, lastname, middle_initial, contact 
        FROM doctors
        INNER JOIN users
        ON doctors.userID = users.id
    EOT;

    if($specialty !== "" && $name !== "") {
        $query .= <<<EOT
            WHERE LOCATE('$specialty', specialization) > 0 AND (LOCATE('$name', firstname) > 0
            OR LOCATE('$name', lastname) > 0)
        EOT;
    } else if($specialty !== "") {
        $query .= <<<EOT
            WHERE LOCATE('$specialty', specialization) > 0
        EOT;
    } else { // $name !==""
        $query .= <<<EOT
            WHERE LOCATE('$name', firstname) > 0
            OR LOCATE('$name', lastname) > 0
        EOT;
    }

    $query .= " ORDER BY $order[0] $order[1]";
    $stmt = $con->query($query);    

    while($result = $stmt->fetch_assoc()) {
        array_push($data, $result);
    }

    $isFound = $stmt->num_rows > 0 ? true : false;

    $obj = [
        "message" => $message,
        "data" => $data,
        "isFound" => $isFound
    ];

    $obj = json_encode($obj);
    echo $obj;