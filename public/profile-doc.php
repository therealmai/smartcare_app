<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../src/css/font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../src/css/search.css">
    <link rel="stylesheet" href="../src/css/profile.css">
    <link rel="stylesheet" href="../src/css/profile-ivan.css">
    <title>SmartCare - Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
    <!-- <?php include('session_check.php') ?> -->
    <?php include "./header.php" ?>

    <main class="prof">
        <section class="prof-btn-cont">
            <br>
            <br>
            <center>
            <img src="../src/img/blankPP.png"/ width=60%;>
            </center>
            <br>
            <button id="showDocProfBtn">Profile</button>
            <button id="showDocPatBtn">Patients</button>
            <button id="showDocAppointBtn">Appointments</button>
        </section>

        <div class="prof-container" id="profRes">
            <section class="prof-pat" id="profPat">
                <div class="hide" id="profDocCont">
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
                                <h1>Jomar Leano</h1>
                                <h3>Doctor</h3>
                                <div class="profile-settings-nav">                  
                                        <button type="button" id="AccSetBtn">Account Settings</button>
                                        <button type="button" id="ProfDetBtn">Personal Details</button>
                                </div>
                                <div class="line"></div>
                                <div class="line-selected-a" id="line-selected-a"></div>
                                <div class="line-selected-b" id="line-selected-b"></div>
                                <table class="acc-info" id="acc-info" style="width:100%;">
                                    <col span="1" style="width: 1%;">
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
                                </table>
                                <table class="prof-info" id="prof-info">
                                    <col span="1" style="width: 1%;">
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
                                        <label for="specialization">Specialization: </label>
                                        <br>
                                        <label for="license-no">License No:</label>
                                        <br>
                                        <label for="degree">Degree:</label>
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
                                </table>
                            </td>
                        </table>
                    </form>
                </div>
            </section>
            <section class="prof-doc-pat" id="profDocPat">
                <div class="hide" id="profDocPatCont">
                <h1>
                    REPLACE THIS DOCTORPATIENTS DUMMY CODE WITH THE CORRECT ONE.
                </h1>
                <p>
                    Must be included:
                    firstname
                    lastname
                    middle initial
                    age [year month day]
                    patient id
                    height
                    weight
                    blood pressure
                    heart rate

                    view person's appointments and
                </p>
                </div>
            </section>
            <section class="hide prof-res" id="docAppCont">
                <div class="doc__app-btns">
                    <button class="doc__app-btn" id="showUnAppBtn">Unfinished</button>
                    <button class="doc__app-btn" id="showFinAppBtn">Finished</button>
                    <button class="doc__app-btn" id="showNotifsBtn">Notifications</button>
                </div>
                <div id="docAppResCont">
                    <div class="doc__app-cont hide" id="docAppFinResCont">
                        <h1 class="doc__empty-msg hide">Nothing to see here.</h1>
                    </div>
                    <div class="doc__app-cont hide" id="docAppUnResCont">
                        <h1 class="doc__empty-msg hide">Nothing to see here.</h1>
                    </div>
                    <div class="doc__app-cont hide" id="docNotifsCont">
                        <h1 class="doc__empty-msg hide">Nothing to see here.</h1>
                    </div>
                </div>
            </section>
        </section>
    </main>
    <script src="../src/js/jquery-3.6.0.min.js"></script>
    <script src="../src/js/profile-doc.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>