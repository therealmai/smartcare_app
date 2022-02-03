<?php
include './session_check.php';
if ($_SESSION['currUser']['role'] != 'doctor') {
    header('location: ./prescriptions.php');
}
include '../src/php/dbconnect.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../src/css/profile.css">


    <!-- DataTables -->

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.4/css/jquery.dataTables.css">
    <title>SmartCare - Patients</title>
</head>

<body>

    <?php
    include "./header.php";

    $docSql = "SELECT * FROM `doctors` WHERE `userID` = {$_SESSION['currUser']['id']}";
    $docResults = mysqli_query($mysqli, $docSql);
    $doc = mysqli_fetch_assoc($docResults);
    $patSql = "SELECT * FROM `appointments` WHERE DoctorID = {$doc["id"]};";
    $patResults = mysqli_query($mysqli, $patSql);
    while ($row = mysqli_fetch_assoc($patResults)) {
        $pat[] = $row["PatientID"];
    }
    for ($x = 0; $x < count($pat); $x++) {
        $user = "SELECT users.firstname, users.lastname, users.lastname  FROM `users` LEFT JOIN patients ON users.id = patients.userID WHERE patients.id = '$pat[$x]'";
        $userResults = mysqli_query($mysqli, $user);
        while ($row1 = mysqli_fetch_assoc($userResults)) {
            $pat1[] = $row1;
        }
    }
    var_dump($pat1);
   
    ?>
    <main class="profPres">

        <!-- <table id="patientsTable" class="display">
            <thead>
                <tr>
                    <th>Column 1</th>
                    <th>Column 2</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Row 1 Data 1</td>
                    <td>Row 1 Data 2</td>
                </tr>
                <tr>
                    <td>Row 2 Data 1</td>
                    <td>Row 2 Data 2</td>
                </tr>
            </tbody>
        </table> -->
        <section>
            <h1>Patients</h1>
            <div class="table-over">


                <table style="width:100%;" id='patientsTable' class="display">
                    <col span="1" style="width: 33%;">
                    <col span="1" style="width: 33%;">
                    <col span="1" style="width: 33%;">
                    <!-- <col span="1" style="width: 10%;"> -->
                    <thead>
                        <tr>
                            <th>
                                Patient
                            </th>
                            <th>
                                Prescription
                            </th>
                            <th>
                                Lab Test
                            </th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php
                        $patientsSql = "SELECT `u`.`firstname`,`u`.`lastname`,`u`.`middle_initial`,`p`.* 
                            FROM `patients` `p`
                            LEFT JOIN `users` `u` ON `p`.`userID` = `u`.`id`";

                        $patientsResults = mysqli_query($mysqli, $patientsSql);
                        $patientsRows = mysqli_fetch_all($patientsResults, MYSQLI_ASSOC);


                        // var_dump($_SESSION);
                        // exit();
                        // $prescriptionsSql = "SELECT `p`.*, ".
                        //         (($_SESSION['currUser']['role'] == 'doctor')
                        //             ? "`pu`.`firstname`, `pu`.`lastname`, `pu`.`middle_initial`,"
                        //             : "`du`.`firstname`, `du`.`lastname`, `du`.`middle_initial`,"
                        //         )
                        //         ."`du`.`id` AS `doc_user_id`, `pu`.`id` AS `patient_user_id`
                        //     FROM `prescriptions` `p`
                        //     LEFT JOIN `doctors` `d` ON `p`.`doctor_id` = `d`.`id`
                        //     LEFT JOIN `patients` `pa` ON `p`.`patient_id` = `pa`.`id`
                        //     LEFT JOIN `users` `du` ON `du`.`id` = `d`.`userID`
                        //     LEFT JOIN `users` `pu` ON `pu`.`id` = `pa`.`userID` ".
                        //     (($_SESSION['currUser']['role'] == 'doctor')
                        //         ?" WHERE `du`.`id` = {$_SESSION['currUser']['id']}"
                        //         :" WHERE `pu`.`id` = {$_SESSION['currUser']['id']}");

                        // $prescriptionsResults = mysqli_query($mysqli, $prescriptionsSql);
                        // $prescriptionsRows = mysqli_fetch_all($prescriptionsResults, MYSQLI_ASSOC);

                        if (count($patientsRows)) {

                            foreach ($patientsRows as $patient) {
                                // var_dump($patient, $_SESSION);
                                // exit();
                                // $formattedDate = date('m/d/Y', strtotime($prescriptionRow['date']));

                        ?>
                                <tr>
                                    <td>
                                        <?php echo "{$patient['firstname']} " .
                                            $patient['middle_initial'] . ". "
                                            . "{$patient['lastname']}"; ?>
                                    </td>

                                    <td>
                                        <?php
                                        $prescriptionsSql = "SELECT * FROM `prescriptions`
                                                WHERE `patient_id` = {$patient['id']} AND `doctor_id` = {$doc['id']}";

                                        $prescriptionsResults = mysqli_query($mysqli, $prescriptionsSql);
                                        $prescriptionsRows = mysqli_fetch_all($prescriptionsResults, MYSQLI_ASSOC);

                                        if (count($prescriptionsRows)) {
                                            foreach ($prescriptionsRows as $prescription) {
                                                // var_dump($prescription);
                                                $formattedDate = date('m/d/Y', strtotime($prescription['date']));

                                                echo "{$prescription['text']} - {$formattedDate}";

                                        ?>

                                                <button onclick="location.href='./editPrescription.php?prescId=<?php echo $prescription['id'] ?>'" type="button" class="btn btn-outline-warning btn-sm">Edit</button>
                                                <form action="../src/php/deletePrescription.php" method="POST" style="display: inline">
                                                    <input type="hidden" value="<?php echo $prescription['id'] ?>" name="prescriptionId">
                                                    <input type="submit" value="Delete" class="btn btn-outline-danger btn-sm">
                                                </form>
                                        <?php
                                            }
                                        }
                                        ?>
                                        <br>
                                        <!-- <button onclick="location.href='./addPrescription.php'" type="button" class="btn btn-outline-primary btn-sm">Add</button> -->
                                    </td>

                                    <td>
                                        <?php
                                        $labTestsSql = "SELECT * FROM `lab_tests`
                                                WHERE `patient_id` = {$patient['id']} AND `doctor_id` = {$doc['id']}";

                                        $labTestsResults = mysqli_query($mysqli, $labTestsSql);
                                        $labTestsRows = mysqli_fetch_all($labTestsResults, MYSQLI_ASSOC);

                                        if (count($labTestsRows)) {
                                            foreach ($labTestsRows as $labTest) {
                                                $formattedDate = date('m/d/Y', strtotime($labTest['date']));
                                                echo "{$labTest['lab_test_desc']} - {$formattedDate}";

                                        ?>
                                                <span>
                                                    <button onclick="location.href='./editLabTest.php?labTestId=<?php echo $labTest['id'] ?>'" type="button" class="btn btn-outline-warning btn-sm">Edit</button>
                                                    <button onclick="location.href='./viewLabTest.php?labTestId=<?php echo $labTest['id'] ?>'" type="button" class="btn btn-outline-success btn-sm">View</button>
                                                    <form action="../src/php/deleteLabTest.php" method="POST" style="display: inline;">
                                                        <input type="hidden" value="<?php echo $labTest['id'] ?>" name="labTestId">
                                                        <input type="submit" value="Delete" class="btn btn-outline-danger btn-sm">
                                                    </form>
                                                </span>
                                        <?php
                                            }
                                        }
                                        ?>
                                        <br>
                                        <!-- <button onclick="location.href='./addPrescription.php'" type="button" class="btn btn-outline-primary btn-sm">Add</button> -->
                                    </td>
                                </tr>
                        <?php
                            }
                        }
                        ?>
                    </tbody>
            </div>
            </table>
        </section>
    </main>

    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.js"></script>
    <!-- <script defer src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script> -->
    <script defer type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.js"></script>
    <script defer src="../src/js/patientsDataTables.js"></script>
</body>

</html>