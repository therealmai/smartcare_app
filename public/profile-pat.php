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
    <link rel="stylesheet" href="../src/css/font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../src/css/profile-ivan.css">
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
        $profile['created_at'] = "";
        $profile['updated_at'] = "";
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

        <div class="prof-container" id="profRes">
            <section class="prof-pat" id="profPat">
                <div class="hide" id="profPatCont">
                    <table style="width:100%;">
                        <col span="1" style="width: 15%;">
                        <col span="1" style="width: 85%;">
                        <td style="padding-right:20px; vertical-align:top">
                            <img src="../src/img/blankPP.png" / width=100%;>
                            <br>
                            <center>
                                <div class="pt-3">
                                    <button type="button" class="btn btn-primary">
                                        Change Profile Picture
                                    </button>
                                </div>
                            </center>
                            <br><br><br>
                        </td>
                        <td>

                            <h1><?php echo $profile['firstname'] . " " . $profile['middle_initial'] . ". " . $profile['lastname']; ?></h1>
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
                                    <label for="password">Password: </label><br><br><br>
                                </td>
                                <td>
                                    <label for="email"><?php echo $profile['email']; ?></label><br>
                                    <label for="password"><?php echo $password ?></label><br>
                                    <div class="pt-3">
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop1">
                                            Change Account Settings
                                        </button>
                                    </div>
                                </td>
                                <td>

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
                                    <label for="weight">Blood Pressure: </label>
                                    <br>
                                    <label for="heart rate">Heart Rate:</label>
                                    <br><br><br>
                                </td>
                                <td>
                                    <label for="fname"><?php echo $profile['firstname']; ?></label><br>
                                    <label for="lname"><?php echo $profile['lastname'] ?></label><br>
                                    <label for="age"><?php echo $diff->format('%y'); ?></label><br>
                                    <label for="contact"><?php echo "0".$profile['contact'] ?></label><br>
                                    <label for="height"><?php if ($profile['height'] != NULL) {
                                                            echo $profile['height'];
                                                        } else {
                                                            echo $noData;
                                                        } ?></label><br>
                                    <label for="weight"><?php if ($profile['weight'] != NULL) {
                                                            echo $profile['weight'];
                                                        } else {
                                                            echo $noData;
                                                        } ?></label><br>
                                                         <label for="heart rate"><?php if ($profile['heart_rate'] != NULL) {
                                                                echo $profile['blood_pressure'];
                                                            } else {
                                                                echo $noData;
                                                            } ?></label><br>
                                    <label for="heart rate"><?php if ($profile['heart_rate'] != NULL) {
                                                                echo $profile['heart_rate'];
                                                            } else {
                                                                echo $noData;
                                                            } ?></label><br>
                                    <div class="pt-3">

                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop" onclick=showData(<?php echo json_encode($profile) ?>,<?php echo $diff->format('%y') . ")" ?> )>
                                            Change Personal Details
                                        </button>
                                    </div>
                                </td>
                            </table>
                        </td>
                    </table>
                </div>
            </section>
            <section class="prof-res" id="profResAppCont">     
                <div class="doc__app-btns">
                    <button class="doc__app-btn" id="showUnAppBtn">Unfinished</button>
                    <button class="doc__app-btn" id="showFinAppBtn">Finished</button>
                </div>
                <div class="prof-res__appoint-cont hide" id="profResUnApp">
                </div>
                <div class="prof-res__appoint-cont hide" id="profResFinApp">
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

    <!-- Edit Account Settings -->
    <div class="modal fade" id="staticBackdrop1" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Edit Account Settings</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Email address</label>
                            <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                            <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Password</label>
                            <input type="password" class="form-control" id="exampleInputPassword1">
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Understood</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit Personal Detail -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Edit Personal Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="../src/php/edit-perDetails-doc.php" method="POST">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="firstname" name="firstname" placeholder="name@gmail.com">
                            <label for="floatingInput">First Name</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="lastname" name="lastname" placeholder="name@gmail.com">
                            <label for="floatingInput">Last Name</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="middle_initial" name="middle_initial" placeholder="name@gmail.com">
                            <label for="floatingInput">Middle Initial</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="date" class="form-control" id="age" name="age" placeholder="name@gmail.com">
                            <label for="floatingInput">Birthdate</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="contact" class="form-control" id="contact" name="contact" placeholder="name@gmail.com">
                            <label for="floatingInput">Contact</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="height" name="height" placeholder="name@gmail.com">
                            <label for="floatingInput">Height</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="weight" name="weight" placeholder="name@gmail.com">
                            <label for="floatingInput">Weight</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="blood_pressure" name="blood_pressure" placeholder="name@gmail.com">
                            <label for="floatingInput">Blood Pressure</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="heartRate" name="heartRate" placeholder="name@gmail.com">
                            <label for="floatingInput">Heart Rate</label>
                        </div>
                        <input type="text" hidden name="patient_id" id="patient_id">

                </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" name="submit" value="submit" class="btn btn-primary">Change Details</button>
                        </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script src="../src/js/profile-pat.js"></script>
</body>

</html>