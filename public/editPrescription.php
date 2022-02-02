<html>
    <link rel="stylesheet" href="../src/css/profile.css">
    <link rel="stylesheet" href="../src/css/addPrescriptionLabTest.css">
<?php
    include './session_check.php';
    if ($_SESSION['currUser']['role'] != 'doctor') {
        header('location: ./prescriptions.php');
    }

    include '../src/php/dbconnect.php';

    include "./header.php";

    $prescriptionId = $_GET['prescId'];
    $prescriptionsSql = "SELECT * FROM prescriptions WHERE id = $prescriptionId";
    $prescriptionResult = mysqli_query($mysqli, $prescriptionsSql);
    $currPrescription = mysqli_fetch_assoc($prescriptionResult);


?>
    <div class="form-body">
                <table style="width:100%">
                <col span="1" style="width: 50%;">
                <col span="1" style="width: 50%;">
        <form action="../src/php/updatePrescription.php" method="post">
            <tr>
                <td><label for="patient">Patient</label></td>
                <td>
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
                </td>
             </tr>
            <tr>                    
                <td><label for="date">Date</label></td>
                <td><input type="date" name="date" id="date" value="<?php echo $currPrescription['date']; ?>"></td>
            </tr>
            <tr>
                <td><label for="prescription">Prescription</label></td>
                <td><input type="text" name="prescription" id="prescription" value="<?php echo $currPrescription['text']; ?>"></td>
            </tr>
            <td></td>

            <input type="hidden" name="prescriptionId" value="<?php echo $currPrescription['id']?>">
            <td>
            <input type="submit" class="add-form-btn" value="Update Prescription" >
            </td>
        </form>
    </div>

</body>
</html>
