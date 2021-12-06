<?php
    include '../../public/session_check.php';
    if ($_SESSION['currUser']['role'] != 'doctor') {
        header('location: ./prescriptions.php');
    }

    include './dbconnect.php';


    $patientId = $_POST['patientId'];
    $date = $_POST['date'];
    $prescription = $_POST['prescription'];
    $prescriptionId = $_POST['prescriptionId'];

    $docSql = "SELECT * FROM doctors WHERE userID = {$_SESSION['currUser']['id']}";

    $docResults = mysqli_query($mysqli, $docSql);
    $docRow = mysqli_fetch_assoc($docResults);
    $createSql = "UPDATE prescriptions 
        SET doctor_id = {$docRow['id']}, patient_id = $patientId, `date` = '$date', `text` = '$prescription'
        WHERE id = $prescriptionId";

    if (mysqli_query($mysqli, $createSql)) {
        mysqli_free_result($docResults);
        mysqli_close($mysqli);
        header('location: ../../public/prescriptions.php');
        exit();
    }

?>