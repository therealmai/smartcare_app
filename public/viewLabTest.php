<?php
    include './session_check.php';
    include '../src/php/dbconnect.php';
    include "./header.php";

    $labTestId = $_GET['labTestId'];
    $labTestsSql = "SELECT * FROM lab_tests WHERE id = $labTestId";
    $labTestResult = mysqli_query($mysqli, $labTestsSql);
    $currLabTest = mysqli_fetch_assoc($labTestResult);

?>

        
        <label for="patient">Lab Test</label>
            <?php
                $patientSql = "SELECT `p`.*, `u`.`firstname`, `u`.`lastname`, `u`.`middle_initial`
                    FROM `patients` `p`
                    LEFT JOIN `users` `u` ON `p`.`userID` = `u`.`id`
                    WHERE `p`.`id` = {$currLabTest['patient_id']}";

                $patientResults = mysqli_query($mysqli, $patientSql);
                $patient = mysqli_fetch_assoc($patientResults);
                
                echo "Patient Name: {$patient['firstname']} ".
                    $patient['middle_initial'] ?? ""
                    ."{$patient['lastname']}"
            ?>

        </select>

        <br>
        <label for="date">Date:</label>
        <?php 
            $formattedDate = date('m/d/Y', strtotime($currLabTest['date']));

            echo $formattedDate; ?>

        <br>
        <br>
        <label for="lab">Laboratory Test</label><br>
        <img src="../src/img/labTests/<?php echo $currLabTest['lab_test_img_filepath']; ?>" alt="">

        <br>
        <label for="labTestDesc">Laboratory Description: </label>
        <p>
            <?php echo $currLabTest['lab_test_desc']; ?>
        </p>

        <br>

        <br>
</body>
</html>
