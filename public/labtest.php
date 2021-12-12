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
    <link rel="stylesheet" href="../src/css/search.css">
    <link rel="stylesheet" href="../src/css/profile.css">
    <title>SmartCare - Profile</title>
</head>

<body>

    <?php include "./header.php" ?>

    <main class="prof">
        <section>
            <h1>Patients' Lab Tests</h1>
            <table>
                <thead>
                    <tr>
                        <th>
                            Patient
                        </th>
                        <th>
                            Lab Test
                        </th>
                        <th>
                            Lab Description
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
                        $labTestsSql = "SELECT `lb`.*, ".
                                (($_SESSION['currUser']['role'] == 'doctor')
                                    ? "`pu`.`firstname`, `pu`.`lastname`, `pu`.`middle_initial`,"
                                    : "`du`.`firstname`, `du`.`lastname`, `du`.`middle_initial`,"
                                )
                                ."`du`.`id` AS `doc_user_id`, `pu`.`id` AS `patient_user_id`
                            FROM `lab_tests` `lb`
                            LEFT JOIN `doctors` `d` ON `lb`.`doctor_id` = `d`.`id`
                            LEFT JOIN `patients` `pa` ON `lb`.`patient_id` = `pa`.`id`
                            LEFT JOIN `users` `du` ON `du`.`id` = `d`.`userID`
                            LEFT JOIN `users` `pu` ON `pu`.`id` = `pa`.`userID` ".
                            (($_SESSION['currUser']['role'] == 'doctor')
                                ?" WHERE `du`.`id` = {$_SESSION['currUser']['id']}"
                                :" WHERE `pu`.`id` = {$_SESSION['currUser']['id']}");

                        $labTestsResults = mysqli_query($mysqli, $labTestsSql);
                        $labTestsRows = mysqli_fetch_all($labTestsResults, MYSQLI_ASSOC);

                        if (count($labTestsRows)) {

                            foreach ($labTestsRows AS $labTestRow) {
                                // var_dump($labTestRow);
                                $formattedDate = date('m/d/Y', strtotime($labTestRow['date']));
                                ?>
                                    <tr>
                                        <td>
                                            <?php echo "{$labTestRow['firstname']} ".
                                                    (!empty($labTestRow['middle_initial'])
                                                        ?"{$labTestRow['middle_initial']}. "
                                                        :"")
                                                    ."{$labTestRow['lastname']}"; ?>
                                        </td>
                                        <td>
                                            <img src="../src/img/labTests/<?php echo "{$labTestRow['lab_test_img_filepath']}"; ?>" alt="">
                                        </td>
                                        <td>
                                            <?php echo "{$labTestRow['lab_test_desc']}"; ?>
                                        </td>
                                        <td>
                                            <?php echo "{$formattedDate}"; ?>
                                        </td>

                                        <?php if ($_SESSION['currUser']['role'] == 'doctor') { ?>

                                        <td>
                                            <a href="./editLabTest.php?labTestId=<?php echo $labTestRow['id']?>">Edit</a><br>
                                            <a href="./deleteLabTest.php?labTestId=<?php echo $labTestRow['id']?>">Delete</a>
                                        </td>

                                        <?php } ?>
                                    </tr>
                                <?php
                            }
                        }
                    ?>

                </tbody>
            </table>
            <?php if ($_SESSION['currUser']['role'] == 'doctor') { ?>
                <a href="./addLabTest.php">Add</a>
            <?php } ?>
            
            
        </section>

    </main>

    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script src="../src/js/profile.js"></script>
</body>

</html>