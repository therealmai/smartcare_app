<?php include('session_check.php');
include('../src/php/dbconnect.php')
?>
<!DOCTYPE html>
<html lang="en">
    <!-- SELECT * FROM `appointments` LEFT JOIN `doctors` ON appointments.DoctorID= doctors.id WHERE doctors.userID = '13'; -->
<!-- SELECT * FROM `patients` LEFT JOIN `appointments` ON patients.id= appointments.PatientID WHERE appointments.DoctorID = '2'; -->
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../src/css/font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../src/css/search.css">
    <link rel="stylesheet" href="../src/css/profile.css">
    <link rel="stylesheet" href="../src/css/profile-ivan.css">
    <title>SmartCare - Profile</title>
    <script defer src="../src/js/jquery-3.6.0.min.js"></script>
    <script defer src="../src/js/profile-doc.js"></script>
</head>

<body>
    <?php
    // Non-NULL Initialization Vector for decryption 
    $decryption_iv = '1234567891011121';
    // Storing the decryption key 
    $decryption_key = "smartcare";
    $options = 0;
    // Storingthe cipher method 
    $ciphering = "AES-128-CTR";
    $noData = "No Data Found";
    $id = $_SESSION['currUser']['id'];
    $sql = "SELECT * FROM `users` LEFT JOIN doctors ON users.id = doctors.userID WHERE users.id = '$id'";
    $check = mysqli_query($mysqli, $sql) or die("err $id " . mysqli_error($mysqli));
    $check2 = mysqli_num_rows($check);
    if ($check2 != 0) {
        while ($row = mysqli_fetch_assoc($check)) {
            $profile = $row;
        }
        $encryption = $profile['confirm_password'];
        // Using openssl_decrypt() function to decrypt the data 
        $decryption = openssl_decrypt($encryption, $ciphering, $decryption_key, $options, $decryption_iv);
        $num = strlen($decryption);
        $password =  str_repeat("*", $num);
        $dateOfBirth = $profile['year'] . "-" . $profile['month'] . "-" . $profile['day'];
        $today = date("Y-m-d");
        $diff = date_diff(date_create($dateOfBirth), date_create($today));
        $sec = $profile['secretary_id'];
        // $profile['created_at'] = "";
        // $profile['updated_at'] = "";
        $query = "SELECT * FROM `users` LEFT JOIN doctors ON users.id = doctors.secretary_id WHERE users.id = '$sec'";
        $check = mysqli_query($mysqli, $query) or die("err $id " . mysqli_error($mysqli));
        $check2 = mysqli_num_rows($check);
        if ($check2 != 0) {
            while ($row1 = mysqli_fetch_assoc($check)) {
                $sec = $row1;
            }
        }
    }
    
    ?>
    <?php 
    if(!(isset($sec))){
       $sec = $noData;
    }?>
    <?php include "./header.php" ?>

    <main class="prof">
        <section class="prof-btn-cont" id="profBtns">
            <br>
            <br>
            <center>
                <?php if ($profile['image_profile'] != NULL) { ?>
                    <img src="../src/img/profiles/<?php echo $profile['image_profile'] ?>" / width=60%;>
                <?php } else { ?>
                    <img src="../src/img/blankPP.png" / width=60%;>
                <?php } ?>
            </center>
            <br>
            <button id="showDocProfBtn">Profile</button>
            <!-- <button id="showDocPatBtn">Patients</button> -->
            <button id="showDocAppointBtn">Appointments</button>
            <button id="showSchedBtn">Schedule</button>
        </section>

        <div class="prof-container" id="profRes">
            <section class="prof-pat" id="profPat">
                <form action="/action_page.php">
                    <table style="width:100%;">
                        <col span="1" style="width: 15%;">
                        <col span="1" style="width: 85%;">
                        <td style="padding-right:20px; vertical-align:top">
                            <center>
                                <?php if ($profile['image_profile'] != NULL) { ?>
                                    <img src="../src/img/profiles/<?php echo $profile['image_profile'] ?>" / width=80%;>
                                <?php } else { ?>
                                    <img src="../src/img/blankPP.png" / width=60%;>
                                <?php } ?>
                            </center>
                            <br>
                            <center>
                                <div class="pt-2">
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdropProfile" onclick='showData(<?php echo json_encode($profile); ?>)'>
                                        Change Profile Picture
                                    </button>
                                </div>
                            </center>
                            <br><br><br>
                        </td>
                        <td>
                            <h1><?php echo $profile['firstname'] . " " . $profile['middle_initial'] . ". " . $profile['lastname']; ?></h1>
                            <h3>Doctor</h3>
                            <?php
                            if (isset($_SESSION['acc_error'])) {
                                foreach ($_SESSION['acc_error'] as $accErr) { ?>
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        <?php echo $accErr ?>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                            <?php }
                                unset($_SESSION['acc_error']);
                            }
                            ?>
                               <?php
                            if (isset($_SESSION['profPatImgErr'])) {
                                foreach ($_SESSION['profPatImgErr'] as $profPatErr) { ?>
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        <?php echo $profPatErr ?>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                            <?php }
                                unset($_SESSION['profPatImgErr']);
                            }
                            ?>
                            <div class="profile-settings-nav">
                                <button type="button" id="AccSetBtn">Account Settings</button>
                                <button type="button" id="ProfDetBtn">Personal Details</button>
                            </div>
                            <div class="line"></div>
                            <div class="line-selected-a" id="line-selected-a"></div>
                            <div class="line-selected-b" id="line-selected-b"></div>
                            <table class="acc-info" id="acc-info" style="width:100%;">
                                <col span="1" style="width: 3%;">
                                <col span="1" style="width: 20%;">
                                <td>
                                    <label for="email">Email: </label>
                                    <br>
                                    <label for="password">Password: </label>
                                    <label for="sec-email">Secretary Email: </label>
                                    <br><br><br>
                                </td>
                                <td>
                                    <label for="email"><?php echo $profile['email']; ?></label><br>
                                    <label for="password"><?php echo $password ?></label><br>  
                                    <label for="password"><?php if($sec != $noData){
                                        echo $sec['email'];
                                     }else{
                                        echo $noData;
                                     } ?></label><br>  
                                    <div class="pt-3">
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop1" onclick='showData1(<?php echo json_encode($profile); ?>)'>
                                            Change Account Settings
                                        </button>
                                    </div>
                                </td>
                                
                            </table>
                        
                            <table class="prof-info" id="prof-info">
                                <col span="1" style="width: 1%;">
                                <col span="1" style="width: 25%;">
                                <td>
                                    <label for="fname">First name:  </label>
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
                                    
                                </td>
                                <td>
                                    <label for="fname"><?php echo $profile['firstname']; ?></label><br>
                                    <label for="lname"><?php echo $profile['lastname'] ?></label><br>
                                    <label for="age"><?php echo $diff->format('%y'); ?></label><br>
                                    <label for="contact"><?php echo "0" . $profile['contact'] ?></label><br>
                                    <label for="specialization"><?php echo $profile['specialization']; ?> </label><br>
                                    <label for="license-no"><?php echo $profile['license_number'] ?></label><br>
                                    <label for="degree"><?php echo $profile['degree'] ?></label><br>
                              
                                    
                                </td>
                                
                            </table>
                            
                        </td>
                    </table>
                </form>
            </section>
            <section class="prof-doc-pat" id="profDocPat">
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
            </section>
            <section class="hide prof-res" id="docAppCont">
                <div class="doc__app-btns">
                    <button class="doc__app-btn" id="showUnAppBtn">Unfinished</button>
                    <button class="doc__app-btn" id="showFinAppBtn">Finished</button>
                    <button class="doc__app-btn" id="showNotifsBtn">Notifications</button>
                    <input class="filter-appointments hide" id="inputFilterAppointments" type="text" placeholder="Search for a patient...">
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
                    <!-- <div class="doc__sched-cont hide" id="docSchedCont">
                        <form class="doc__sched-cont--grid-top" id="addSchedForm" action="">
                            <button type="submit" class="doc__add-sched-btn">
                                Add
                                <i class="fa fa-plus" aria-hidden="true"></i>
                            </button>
                            <select name="day">
                                <option id="weekdayInput" value="" selected>
                                    Choose a Day Below
                                </option>
                            </select>
                            <input id="timeStart" name="time-start" type="time">
                            <input id="timeEnd" name="time-end" type="time">
                        </form>
                        <div class="doc__weekday-cont" id="schedWeekdayCont">
                            <button class="doc__weekday-btn" data-weekday="sun">Sunday</button>
                            <button  class="doc__weekday-btn" data-weekday="mon">Monday</button>
                            <button  class="doc__weekday-btn" data-weekday="tue">Tuesday</button>
                            <button  class="doc__weekday-btn" data-weekday="wed">Wednesday</button>
                            <button  class="doc__weekday-btn" data-weekday="thu">Thursday</button>
                            <button  class="doc__weekday-btn" data-weekday="fri">Friday</button>
                            <button  class="doc__weekday-btn" data-weekday="sat">Saturday</button>
                        </div>
                        <div class="doc__time-cont" id="timeCont">
                            <div class="hide" id="sun"></div>
                            <div class="hide" id="mon">
                            </div>
                            <div class="hide" id="tue">
                            </div>
                            <div class="hide" id="wed"></div>
                            <div class="hide" id="thu"></div>
                            <div class="hide" id="fri"></div>
                            <div class="hide" id="sat"></div>
                        </div>
                    </div> -->
                </div>
            </section>
            <section class="doc__sched-cont hide" id="docSchedCont">
                <form class="doc__sched-cont--grid-top" id="addSchedForm" action="">
                    <button type="submit" class="doc__add-sched-btn">
                        Add
                        <i class="fa fa-plus" aria-hidden="true"></i>
                    </button>
                    <select name="day">
                        <option id="weekdayInput" value="" selected>
                            Choose a Day Below
                        </option>
                    </select>
                    <input id="timeStart" name="time-start" type="time">
                    <input id="timeEnd" name="time-end" type="time">
                </form>
                <div class="doc__weekday-cont" id="schedWeekdayCont">
                    <button class="doc__weekday-btn" data-weekday="sun">Sunday</button>
                    <button class="doc__weekday-btn" data-weekday="mon">Monday</button>
                    <button class="doc__weekday-btn" data-weekday="tue">Tuesday</button>
                    <button class="doc__weekday-btn" data-weekday="wed">Wednesday</button>
                    <button class="doc__weekday-btn" data-weekday="thu">Thursday</button>
                    <button class="doc__weekday-btn" data-weekday="fri">Friday</button>
                    <button class="doc__weekday-btn" data-weekday="sat">Saturday</button>
                </div>
                <div class="doc__time-cont" id="timeCont">
                    <div class="hide" id="sun"></div>
                    <div class="hide" id="mon">
                    </div>
                    <div class="hide" id="tue">
                    </div>
                    <div class="hide" id="wed"></div>
                    <div class="hide" id="thu"></div>
                    <div class="hide" id="fri"></div>
                    <div class="hide" id="sat"></div>
                </div>
            </section>
            </section>
    </main>

     <!-- Change Profile Pic -->
     <div class="modal fade" id="staticBackdropProfile" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Change Profile Picture</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="../src/php/add-profPat.php" method="POST" enctype="multipart/form-data">
                        <div class="form mb-3">
                            <input type="file" class="form-control" name="profile_image" accept="image/*" onchange="loadFile(event)">
                            <br>
                            <img id="image_preview" class="img-fluid">
                            <img id="output" class="img-fluid">
                            <script>
                                var loadFile = function(event) {
                                    var output = document.getElementById('output');
                                    if (output && output.style) {
                                        document.getElementById('image_preview').innerHTML = "Preview Image";
                                        output.style.height = '400px';
                                        output.style.width = '400px';
                                    }
                                    output.src = URL.createObjectURL(event.target.files[0]);
                                    output.onload = function() {
                                        URL.revokeObjectURL(output.src) // free memory
                                    }
                                };
                            </script>
                        </div>
                        <input type="text" hidden name="patient_id" id="prof_id">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" name="submit" value="submit" class="btn btn-primary">Change Details</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="staticBackdrop1" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Edit Account Settings</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="../src/php/edit-accDetails-pat.php" method="POST">
                        <div class="form-floating mb-3">
                            <input type="email" class="form-control" id="email" name="email" placeholder="name@gmail.com" required>
                            <label for="floatingInput">Email</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="confirm_password" name="confirm_password" placeholder="name@gmail.com" required>
                            <label for="floatingInput">Confirm Password</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="password" name="password" placeholder="name@gmail.com" required>
                            <label for="floatingInput">New Password</label>
                        </div>
                        <input type="text" hidden name="patient_id" id="Accpatient_id">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" name=submit value=submit class="btn btn-primary">Change</button>
                </div>
                </form>
            </div>
        </div>
    </div>

</body>

</html>