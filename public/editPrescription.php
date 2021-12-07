<?php
    // include './session_check.php';
    // if ($_SESSION['currUser']['role'] != 'doctor') {
    //     header('location: ./prescriptions.php');
    // }

    include '../src/php/dbconnect.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
<?php

    $prescriptionId = $_GET['prescId'];
    $prescriptionsSql = "SELECT * FROM prescriptions WHERE id = $prescriptionId";
    $prescriptionResult = mysqli_query($mysqli, $prescriptionsSql);
    $currPrescription = mysqli_fetch_assoc($prescriptionResult);


?>

    <form action="../src/php/updatePrescription.php" method="post">
        
        <label for="patient">Patient</label>
        <select name="patientId" id="patient">
            <?php
                $patientsSql = "SELECT `p`.*, `u`.`firstname`, `u`.`lastname`, `u`.`middle_initial`
                    FROM `patients` `p`
                    LEFT JOIN `users` `u` ON `p`.`userID` = `u`.`id`";

                $patientsResults = mysqli_query($mysqli, $patientsSql);
                $patientsRows = mysqli_fetch_all($patientsResults, MYSQLI_ASSOC);

                if (count($patientsRows)) {
                    foreach($patientsRows as $patient) {
                        ?>
                            <option value="<?php echo $patient['id']?>"
                                <?php echo ($patient['id'] == $currPrescription['patient_id']) ? 'selected' : ''; ?>
                                ><?php echo "{$patient['firstname']} ".
                                                    (!empty($patient['middle_initial'])
                                                        ?"{$patient['middle_initial']}. "
                                                        :"")
                                                    ."{$patient['lastname']}"; ?></option>
                        <?php
                    }
                }
            ?>

        </select>

        <label for="date">Date</label>
        <input type="date" name="date" id="date" value="<?php echo $currPrescription['date']; ?>">

        <label for="prescription">Prescription</label>
        <input type="text" name="prescription" id="prescription" value="<?php echo $currPrescription['text']; ?>">
        
        <input type="hidden" name="prescriptionId" value="<?php echo $currPrescription['id']?>">

        <input type="submit" value="Update Prescription" >
    </form>
</body>
</html>
