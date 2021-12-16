<?php

    include_once "dbconn.php";

    $id = $_POST["id"];
    $userId = $_SESSION["currUser"]["id"];
    $message = "Error! The appointment was not properly cancelled.";
    $success = false;
    $obj = [];

    $query = <<<EOT
        SELECT role FROM users
        WHERE id = $userId;
    EOT;

    $stmt = $con->query($query);
    $result = $stmt->fetch_array(MYSQLI_NUM);
    $role = $result[0];

    $stmt->close();

    $query = <<<EOT
        UPDATE appointments
        SET IsCancelled = 1, Canceller = '$role'
        WHERE ID = $id
    EOT;

    if($con->query($query)) {
        $message = "You have successfully cancelled your appointment.";
        $success = true;
    }

    $obj = [
        "message" => $message,
        "success" => $success,
        "role" => $role,
        "id" => gettype($id)
    ];

    $obj = json_encode($obj);
    echo $obj;