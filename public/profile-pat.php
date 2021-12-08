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
</head>

<body>
<?php
$email = $_SESSION['currUser']['id'];
// $sql = "SELECT * FROM users WHERE email ='$email'";
// $check = mysqli_query($mysqli, $sql) or die ("err $id " . mysqli_error ($mysqli));
// $check2 = mysqli_num_rows($check);
// if ($check2 != 0) {
//     while ($row = mysqli_fetch_assoc($check)) {
//         $email = $row['email'];
//         $fname = $row['fname'];
//         $lname = $row['lname']; // repeat for all db columns you want
//         $id = $row['id'];
//     }
// }
?>
    <?php echo "$email"; ?>
    <?php include "./header.php" ?>

    <main class="prof">
        <section class="prof-btn-cont">
            <br>
            <br>
            <center>
            <img src="../src/img/blankPP.png"/ width=60%;>
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
                                <img src="../src/img/blankPP.png"/ width=100%;>
                                <br>
                                <center>
                                <a href="">Change profile picture</a>
                                </center>
                                <br><br><br>
                            </td>
                            <td>
                                <h1>Jose Glen A. Samson</h1>
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
                                        <label for="email"> 18104218@usc.edu.ph</label><br>
                                        <label for="password"> ********</label><br>
                                    </td>
                                    <td>

                                        <button type="button" class="editBtn">edit</button><br>
                                        <button type="button" class="editBtn">edit</button><br>
                                    </td>
                                </table>
                                <table class="prof-info" id="prof-info" style="width:100%;">
                                    <col span="1" style="width: 10%;">
                                    <col span="1" style="width: 20%;">
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
                                        <br>
                                    </td>   
                                    <td>
                                        <label for="fname">Jose Glen</label><br>
                                        <label for="lname">Samson</label><br>
                                        <label for="age">19</label><br>
                                        <label for="contact"> 09778416426</label><br>
                                        <label for="height">181cm </label><br>
                                        <label for="weight">60kg</label><br>
                                        <label for="heart rate">70 bpm</label><br>
                                    </td>
                                    <td>
                                        <br><br><br><br>
                                        <button type="button" class="editBtn">edit</button><br>
                                        <button type="button" class="editBtn">edit</button><br>
                                        <button type="button" class="editBtn">edit</button><br>
                                        <button type="button" class="editBtn">edit</button><br><br>
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

            <section class="prof-pat-doc" id="profPatDoc">
                <div class="hide" id="profPatDocCont">
                    insert doctors here
                </div>
            </section>
        </div>
    </main>

    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script src="../src/js/profile-pat.js"></script>
</body>

</html>