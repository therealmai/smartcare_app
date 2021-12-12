<?php
    include './session_check.php';
    if ($_SESSION['currUser']['role'] != 'doctor') {
        header('location: ./prescriptions.php');
    }
    include '../src/php/dbconnect.php';
    include "./header.php"; 
    ?>
    <img src="/src/img" alt="">
    <form action="../src/php/createLabTest.php" method="post" enctype="multipart/form-data">
        
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
        <br>
        <label for="date">Date</label>
        <input type="date" name="date" id="date">

        <br>
        <label for="lab">Lab Test</label>
        <input type="file" name="labTest" id="lab">

        <br>
        <label for="lab">Lab Description</label>
        <input type="text" name="desc" id="lab">
        
        <br>
        <input type="submit" value="Add Lab Test">
    </form>
</body>
</html>