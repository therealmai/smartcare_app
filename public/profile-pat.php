<?php include('session_check.php');
include('../src/php/dbconnect.php')
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
    <?php
    $noData = "No Data Found";
    $id = $_SESSION['currUser']['id'];
    $sql = "SELECT * FROM `users` LEFT JOIN patients ON users.id  = patients.userID WHERE users.id = '$id'";
    $check = mysqli_query($mysqli, $sql) or die("err $id " . mysqli_error($mysqli));
    $check2 = mysqli_num_rows($check);
    if ($check2 != 0) {
        while ($row = mysqli_fetch_assoc($check)) {
            $profile = $row;
        }
        $password = $profile['password'];
        $dateOfBirth = $profile['year'] . "-" . $profile['month'] . "-" . $profile['day'];
        $today = date("Y-m-d");

        $diff = date_diff(date_create($dateOfBirth), date_create($today));
    }
    ?>
    <?php var_dump($profile); ?>
    <?php include "./header.php" ?>
    <main class="prof">
        <section class="prof-btn-cont">
            <br>
            <br>
            <center>
                <img src="../src/img/blankPP.png" / width=60%;>
            </center>
            <br>
            <button id="showPatProfBtn">Profile</button>
            <button id="showPatAppointBtn">Appointments</button>
            <button id="showPatPresBtn">Prescriptions</button>
            <button id="showPatDocBtn">Doctors</button>
        </section>

        <div class="prof-container">
            <section class="prof-pat" id="profPat">
                <div class="hide" id="profPatCont">
                    <form action="/action_page.php">
                        <table style="width:100%;">
                            <col span="1" style="width: 15%;">
                            <col span="1" style="width: 85%;">
                            <td style="padding-right:20px; vertical-align:top">
                                <img src="../src/img/blankPP.png" / width=100%;>
                                <br>
                                <center>
                                    <a href="">Change profile picture</a>
                                </center>
                                <br><br><br>
                            </td>
                            <td>

                                <h1><?php echo $profile['firstname'] . " " . $profile['middle_initial'] . " " . $profile['lastname']; ?></h1>
                                <h3>Patient</h3>
                                <div class="profile-settings-nav">
                                    <button type="button" id="AccSetBtn">Account Settings</button>
                                    <button type="button" id="ProfDetBtn">Personal Details</button>
                                </div>
                                <div class="line"></div>
                                <div class="line-selected-a" id="line-selected-a"></div>
                                <div class="line-selected-b" id="line-selected-b"></div>
                                <table class="acc-info" id="acc-info" style="width:100%;">
                                    <col span="1" style="width: 10%;">
                                    <col span="1" style="width: 20%;">
                                    <td>
                                        <label for="email">Email: </label>
                                        <br>
                                        <label for="password">Password: </label>
                                    </td>
                                    <td>
                                        <label for="email"><?php echo $profile['email']; ?></label><br>
                                        <label for="password"><?php echo $password ?></label><br>
                                    </td>
                                    <td>
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop1">
  Launch static backdrop modal
</button>
                                    </td>
                                </table>
                                <table class="prof-info" id="prof-info">
                                    <col span="1" style="width: 20%;">
                                    <col span="1" style="width: 25%;">
                                    <td>
                                        <label for="fname">First name: </label>
                                        <br>
                                        <label for="lname">Last name: </label>
                                        <br>
                                        <label for="age">Age: </label>
                                        <br>
                                        <label for="contact">Contact: </label>
                                        <br>
                                        <label for="height">Height: </label>
                                        <br>
                                        <label for="weight">Weight: </label>
                                        <br>
                                        <label for="heart rate">Heart Rate:</label>
                                        <br><br><br>
                                    </td>
                                    <td>
                                        <label for="fname"><?php echo $profile['firstname']; ?></label><br>
                                        <label for="lname"><?php echo $profile['lastname'] ?></label><br>
                                        <label for="age"><?php echo $diff->format('%y'); ?></label><br>
                                        <label for="contact"><?php echo $profile['contact'] ?></label><br>
                                        <label for="height"><?php if ($profile['height'] != NULL) {
                                                                echo $profile['firstname'];
                                                            } else {
                                                                echo $noData;
                                                            } ?></label><br>
                                        <label for="weight"><?php if ($profile['weight'] != NULL) {
                                                                echo $profile['firstname'];
                                                            } else {
                                                                echo $noData;
                                                            } ?></label><br>
                                        <label for="heart rate"><?php if ($profile['heart_rate'] != NULL) {
                                                                    echo $profile['firstname'];
                                                                } else {
                                                                    echo $noData;
                                                                } ?></label><br>
                                        <div class="pt-3">
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
  Launch static backdrop modal
</button>
                                        </div>
                                    </td>
                                </table>

                            </td>
                        </table>
                    </form>
                </div>
            </section>

            <section class="prof-res" id="profRes">
                <div class="hide" id="profResAppCont">
                    <div class="prof-res__appoint-cont" id="profResUnApp">
                        <h1>Unfinished Appointments</h1>
                    </div>
                    <div class="prof-res__appoint-cont" id="profResFinApp">
                        <h1>Finished Appointments</h1>
                    </div>
                </div>
            </section>

            <section class="prof-prescription" id="profPatPres">
                <div class="hide" id="profPatPresCont">
                    insert prescription here
                </div>
            </section>

            <section class="prof-pat-doc" id="profPatDoc">
                <div class="hide" id="profPatDocCont">
                    insert doctors heres
                </div>
            </section>
        </div>
    </main>

    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script src="../src/js/profile-pat.js"></script>
</body>

</html>