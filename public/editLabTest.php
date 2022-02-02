<html>
    <link rel="stylesheet" href="../src/css/profile.css">
    <link rel="stylesheet" href="../src/css/addPrescriptionLabTest.css">    
<?php
    include './session_check.php';
    if ($_SESSION['currUser']['role'] != 'doctor') {
        header('location: ./labTest.php');
    }

    include '../src/php/dbconnect.php';

    include "./header.php";

    $labTestId = $_GET['labTestId'];
    $labTestsSql = "SELECT * FROM lab_tests WHERE id = $labTestId";
    $labTestResult = mysqli_query($mysqli, $labTestsSql);
    $currLabTest = mysqli_fetch_assoc($labTestResult);

?>
    <div class="form-body">
        <table style="width:100%">
        <col span="1" style="width: 50%;">
        <col span="1" style="width: 50%;">
    <form action="../src/php/updateLabTest.php" method="POST" enctype="multipart/form-data">
        <tr>
        <td><label for="patient">Lab Test</label></td>
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
                                <?php echo ($patient['id'] == $currLabTest['patient_id']) ? 'selected' : ''; ?>
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
        <td><input type="date" name="date" id="date" value="<?php echo $currLabTest['date']; ?>"></td>
        <tr>
        <td><label for="lab">Laboratory Test</label><br></td>
        <td><input type="file" name="labTest" id="lab"></td>
        <img src="../src/img/labTests/<?php echo $currLabTest['lab_test_img_filepath']; ?>" alt="">
        </tr>
        <tr>
        <td><label for="labTestDesc">Laboratory Description</label></td>
        <td><input type="text" name="desc" id="lab" value="<?php echo $currLabTest['lab_test_desc']; ?>"></td>
        </tr>
        <td></td>
        <input type="hidden" name="labTestId" value="<?php echo $currLabTest['id']?>">
        <td>
        <input type="submit" class="add-form-btn" value="Update labTest" >
        </td>
    </form>
            </table>
            </div>

        <!-- <div class="form-body">
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
                </div> -->
</body>
</html>
