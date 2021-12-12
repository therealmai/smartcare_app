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

    <form action="../src/php/updateLabTest.php" method="POST" enctype="multipart/form-data">
        
        <label for="patient">Lab Test</label>
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

        <br>
        <label for="date">Date</label>
        <input type="date" name="date" id="date" value="<?php echo $currLabTest['date']; ?>">

        <br>
        <br>
        <label for="lab">Laboratory Test</label><br>
        <input type="file" name="labTest" id="lab">
        <img src="../src/img/labTests/<?php echo $currLabTest['lab_test_img_filepath']; ?>" alt="">

        <br>
        <label for="labTestDesc">Laboratory Description</label>
        <input type="text" name="desc" id="lab" value="<?php echo $currLabTest['lab_test_desc']; ?>">

        <br>
        <input type="hidden" name="labTestId" value="<?php echo $currLabTest['id']?>">

        <br>
        <input type="submit" value="Update labTest" >
    </form>
</body>
</html>
