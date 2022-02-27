<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../src/css/profile.css">
    <link rel="stylesheet" href="../src/css/addPrescriptionLabTest.css">
    <title>SmartCare - Add Lab Test</title>
</head>

<body>
    <?php

    use LDAP\Result;

    include './session_check.php';
    if ($_SESSION['currUser']['role'] != 'doctor') {
        header('location: ./prescriptions.php');
    }
    include '../src/php/dbconnect.php';
    include "./header.php";
    $query = "SELECT id FROM `doctors` WHERE userID = {$_SESSION['currUser']['id']}";
    $doctor = mysqli_query($mysqli, $query);
    $result = mysqli_fetch_assoc($doctor);
    $query = "SELECT DISTINCT PatientID FROM `appointments` WHERE DoctorID = {$result["id"]}";
    $patients = mysqli_query($mysqli, $query);
    while ($result = mysqli_fetch_assoc($patients)) {
        $row[] = $result;
    }
    ?>
    <img src="/src/img" alt="">
    <div class="form-body">
        <table style="width:100%">
            <col span="1" style="width: 50%;">
            <col span="1" style="width: 50%;">
            <form action="../src/php/createLabTest.php" method="post" enctype="multipart/form-data">
                <tr>
                    <td>
                        <label for="patient">Patient</label>
                    </td>
                    <td>

                        <select name="patientId" id="patient">
                            <?php
                            //SELECT * FROM `users` LEFT JOIN patients ON users.id = patients.userID WHERE patients.id = $row;
                            if (isset($row)) {
                                for ($x = 0; $x < count($row); $x++) {
                                    $user = "SELECT users.firstname, users.middle_initial, users.lastname FROM `users` LEFT JOIN patients ON users.id = patients.userID WHERE patients.id = {$row[$x]['PatientID']}";
                                    $userResults = mysqli_query($mysqli, $user);
                                    while ($row1 = mysqli_fetch_assoc($userResults)) {
                                        $patient[] = $row1;
                                    }
                                }
                            }
                    
                                for($x = 0 ; $x< count($patient); $x++) {
                            ?>
                                    <option value="<?php echo $patient['id'] ?>"><?php echo "{$patient[$x]["firstname"]} " .
                                                                                    (!empty($patient[$x]['middle_initial'])
                                                                                        ? "{$patient[$x]['middle_initial']}. "
                                                                                        : "")
                                                                                    . "{$patient[$x]['lastname']}"; ?></option>
                            <?php
                                }
                            ?>
                        </select>
                    </td>
                <tr>
                    <td><label for="date">Date</label></td>
                    <td><input type="date" name="date" id="date"></td>
                </tr>
                <tr>
                    <td><label for="lab">Lab Test</label></td>
                    <td><input type="file" name="labTest" id="lab"></td>
                </tr>
                <tr>
                    <td><label for="lab">Lab Description</label></td>
                    <td><input type="text" name="desc" id="lab"></td>
                </tr>
                <td></td>
                <td>
                    <button type="submit" class="add-form-btn">Add Lab Test</button>
                </td>
            </form>
        </table>
    </div>
</body>

</html>