<?php
    include '../../public/session_check.php';
    if ($_SESSION['currUser']['role'] != 'doctor') {
        header('location: ../../public/prescriptions.php');
    }

    include './dbconnect.php';


    $prescriptionId = $_POST['prescriptionId'];

    $deleteSql = "DELETE FROM prescriptions WHERE id = '$prescriptionId'";

    if (mysqli_query($mysqli, $deleteSql)) {
        mysqli_free_result($docResults);
        mysqli_close($mysqli);
        header('location: ../../public/prescriptions.php');
        exit();
    }

?>