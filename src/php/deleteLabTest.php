<?php
    include '../../public/session_check.php';
    if ($_SESSION['currUser']['role'] != 'doctor') {
        header('location: ../../public/labtest.php');
    }

    include './dbconnect.php';


    $labTestId = $_POST['labTestId'];

    $deleteSql = "DELETE FROM lab_tests WHERE id = '$labTestId'";

    if (mysqli_query($mysqli, $deleteSql)) {
        mysqli_free_result($docResults);
        mysqli_close($mysqli);
        header('location: ../../public/labtest.php');
        exit();
    }

?>