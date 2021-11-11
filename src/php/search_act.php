<?php

    include_once("db_connect.php");

    $obj = [];
    $data = [];
    $message = "";
    $isFound = 0;

    $specialty = $_GET["specialty"];
    $order = $_GET["order"];
    $docIds = json_decode($_GET["docIds"]);
    $name = strtolower($_GET["docName"]);
    
    $query = <<<EOT
        SELECT doctors.id, specialization, name, contact 
        FROM doctors
        INNER JOIN users
        ON doctors.userID = users.id
    EOT;

    if($specialty !== "" && $name !== "") {
        $query .= <<<EOT
            WHERE LOCATE('$specialty', specialization) > 0 AND LOCATE('$name', name) > 0;
        EOT;
    } else if($specialty !== "") {
        $query .= <<<EOT
            WHERE LOCATE('$specialty', specialization) > 0;
        EOT;
    } else { // $name !==""
        $query .= <<<EOT
            WHERE LOCATE('$name', name) > 0;
        EOT;
    }

    $stmt = $con->query($query);

    while($result = $stmt->fetch_assoc()) {
        array_push($data, $result);
    }

    $isFound = $stmt->num_rows > 0 ? 1 : 0;

    $obj = [
        "message" => $message,
        "data" => $data,
        "isFound" => $isFound
    ];

    $obj = json_encode($obj);
    echo $obj;