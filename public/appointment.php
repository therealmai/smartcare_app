<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../src/css/appointment.css">
    <link rel="stylesheet" href="../src/css/font-awesome-4.7.0/css/font-awesome.min.css">
    <title>SmartCare - Appointment</title>
</head>

<body>
    <?php include('session_check.php') ?>
    <header>
        <img class="header__logo" src="../src/img/logo-with-heading.png" alt="">
    </header>
    <section class="right-sec">
        <div class="right-sec--top-bg"></div>

        <div class="right-sec__doctor-cont">
            <h5>BOOK APPOINTMENT</h5>
            <div class="right-sec__doctor-cont--left">
                <i class="fa fa-user-md fa-2x" aria-hidden="true"></i>
                <div>
                    <h4>Dr. Jose Glen</h4>
                    <h5>Internal Medicine</h5>
                </div>
            </div>

            <div class="right-sec__doctor-cont--right">
                <i class="fa fa-phone fa-2x" aria-hidden="true"></i>
                <div>
                    <h4>+639171338357</h4>
                    <h5>CONTACT NUMBER</h5>
                </div>
            </div>
        </div>

        <div class="right-sec__page">
            <p class="right-sec__page--1">1</p>
            <div class="line"></div>
            <p class="right-sec__page--2">2</p>

            <p class="right-sec__page--ad">Appointment Details</p>
            <p class="right-sec__page--s">Summary</p>
        </div>

        <div class="right-sec__form-cont">
            <h4>Appointment Information</h4>

            <form action="">
                <div>
                    <label for="appoint-type">Appointment Type</label>
                    <select name="appoint-type" id="appoint-type">
                        <option hidden disabled selected value> -- select an option -- </option>
                        <option value="f2f">Face-to-face</option>
                        <option value="vir-appoint">Virtual Appointment</option>
                    </select>
                </div>

                <div>
                    <label for="clinic">Select Clinic</label>
                    <select name="clinic" id="clinic">
                        <option hidden disabled selected value> -- select an option -- </option>
                        <option value="f2f">Face-to-face</option>
                        <option value="vir-appoint">Virtual Appointment</option>
                    </select>
                </div>

                <div>
                    <label for="date">Date of Appointment</label>
                    <input name="date" id="date" type="date">
                </div>

                <div>
                    <label for="time">Time of Appointment</label>
                    <input name="time" id="time" type="time">
                </div>

                <button type="submit">
                    Continue <i class="fa fa-arrow-right" aria-hidden="true"></i>
                </button>
            </form>
        </div>
    </section>
</body>

</html>