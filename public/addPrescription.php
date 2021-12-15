<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../src/css/profile.css">
        <link rel="stylesheet" href="../src/css/addPrescriptionLabTest.css">
        <title>SmartCare - Add Prescription</title>
    </head>
    <body>
        <?php
            include './session_check.php';
            if ($_SESSION['currUser']['role'] != 'doctor') {
                header('location: ./prescriptions.php');
            }
            include '../src/php/dbconnect.php';
            include "./header.php"; ?>
            <div class="form-body">
                <table style="width:100%">
                <col span="1" style="width: 50%;">
                <col span="1" style="width: 50%;">
                <form action="../src/php/createPrescription.php" method="post">
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
                                            <option value="<?php echo $patient['id']?>"><?php echo "{$patient['firstname']} ".
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
                        <td><input type="date" name="date" id="date"></td>
                    </tr>
                    <tr>
                        <td><label for="prescription">Prescription</label></td>
                        <td><input type="text" name="prescription" id="prescription"></td>
                    </tr>
                    <td></td>
                    <td>
                    <button type="submit" class="add-form-btn">Add Prescription</button>
                    </td>
                    
                </form>
                </table>
                </div>
    </body>
</html>