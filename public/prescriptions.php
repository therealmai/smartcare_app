<?php
include './session_check.php';
include '../src/php/dbconnect.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" href="../src/css/profile.css">
    <title>SmartCare - Profile</title>
</head>

<body>

    <?php include "./header.php" ?>
    <main class="profPres">
        <section>
            <h1>Patients' Prescriptions</h1>
            <table style="width:100%;">
                <col span="1" style="width: 30%;">
                <col span="1" style="width: 30%;">
                <col span="1" style="width: 30%;">
                <col span="1" style="width: 10%;">
                <thead>
                    <tr>
                        <th>
                            Patient
                        </th>
                        <th>
                            Prescription
                        </th>
                        <th>
                            Date
                        </th>
                        <?php if ($_SESSION['currUser']['role'] == 'doctor') { ?>
                            <th>
                                Actions
                            </th>
                        <?php } ?>
                    </tr>
                </thead>
                <tbody>

                    <?php
                        // var_dump($_SESSION);
                        // exit();
                        $prescriptionsSql = "SELECT `p`.*, ".
                                (($_SESSION['currUser']['role'] == 'doctor')
                                    ? "`pu`.`firstname`, `pu`.`lastname`, `pu`.`middle_initial`,"
                                    : "`du`.`firstname`, `du`.`lastname`, `du`.`middle_initial`,"
                                )
                                ."`du`.`id` AS `doc_user_id`, `pu`.`id` AS `patient_user_id`
                            FROM `prescriptions` `p`
                            LEFT JOIN `doctors` `d` ON `p`.`doctor_id` = `d`.`id`
                            LEFT JOIN `patients` `pa` ON `p`.`patient_id` = `pa`.`id`
                            LEFT JOIN `users` `du` ON `du`.`id` = `d`.`userID`
                            LEFT JOIN `users` `pu` ON `pu`.`id` = `pa`.`userID` ".
                            (($_SESSION['currUser']['role'] == 'doctor')
                                ?" WHERE `du`.`id` = {$_SESSION['currUser']['id']}"
                                :" WHERE `pu`.`id` = {$_SESSION['currUser']['id']}");

                        $prescriptionsResults = mysqli_query($mysqli, $prescriptionsSql);
                        $prescriptionsRows = mysqli_fetch_all($prescriptionsResults, MYSQLI_ASSOC);

                        if (count($prescriptionsRows)) {

                            foreach ($prescriptionsRows AS $prescriptionRow) {
                                // var_dump($prescriptionRow);
                                $formattedDate = date('m/d/Y', strtotime($prescriptionRow['date']));
                                ?>
                                    <tr>
                                        <td>
                                            <?php echo "{$prescriptionRow['firstname']} ".
                                                    (!empty($prescriptionRow['middle_initial'])
                                                        ?"{$prescriptionRow['middle_initial']}. "
                                                        :"")
                                                    ."{$prescriptionRow['lastname']}"; ?>
                                        </td>
                                        <td>
                                            <?php echo "{$prescriptionRow['text']}"; ?>
                                        </td>
                                        <td>
                                            <?php echo "{$formattedDate}"; ?>
                                        </td>

                                        <?php if ($_SESSION['currUser']['role'] == 'doctor') { ?>

                                        <td>
                                            <a href="./editPrescription.php?prescId=<?php echo $prescriptionRow['id']?>">Edit</a><br>
                                            <form action="../src/php/deletePrescription.php" method="POST">
                                                <input type="hidden" value="<?php echo $prescriptionRow['id']?>" name="prescriptionId">
                                                <input type="submit" value="Delete">
                                            </form>
                                        </td>


                                        <?php } ?>
                                    </tr>
                                <?php
                            }
                        }
                    ?>

                </tbody>
            </table>
            <?php 
            if ($_SESSION['currUser']['role'] == 'doctor') { ?>
                <a href="./addPrescription.php">Add</a>
            <?php } ?>
            
            
        </section>

    </main>

    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script src="../src/js/profile-doc.js"></script>
</body>
</html>