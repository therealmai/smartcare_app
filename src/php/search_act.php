<?php

    include_once("db_connect.php");

    $obj = [];
    $data = [];
    $message = "";
    $isFound = 0;

    $specialty = $_GET["specialty"];
    $order = $_GET["order"];
    $name = strtolower($_GET["docName"]);

    if($specialty !== "") {
        $specialty = "Cardiologist";
        $query = <<<EOT
            SELECT doctors.id, specialization, name, contact 
            FROM doctors
            INNER JOIN users
            ON doctors.userID = users.id
            WHERE specialization = '$specialty';
        EOT;
    } else {
        $query = "SELECT doctors.id, users.name, doctors.specialization, users.contact FROM users INNER JOIN doctors ON ";
    }

    $stmt = $con->query($query);

    while($result = $stmt->fetch_assoc()) {
        array_push($data, $result);
    }

    $isFound = count($data) > 0 ? 1 : 0;

    $obj = [
        "message" => $message,
        "data" => $data,
        "isFound" => $isFound
    ];

    $obj = json_encode($obj);
    echo $obj;