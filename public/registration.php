<?php
session_start();
if (isset($_SESSION['currUser']))
    header('location: ./homepage.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="../src/css/registration.css">
    <title>SmartCare - Registration</title>
</head>

<body style="background-image:url(../src/img/registration.jpg)">

    <header>
        <img class="header__logo" src="../src/img/logo_trans.png" alt="">
    </header>
    <main>
        <section id="leftSection" class="left-sec">
            <p class="left-sec__p1">
                <span class="left-sec__span--font-size-m">Let's Get</span> <br>
                <span class="left-sec__span--font-size-xl">Started!</span> <br>
                Signing up for a Doctor account is fast and easy. <br>
                It will only take a few minutes.
            </p>

            <p class="left-sec__p2">
                Already have an account? <a href="">Sign in</a>
                <br>
            </p>

            <a href="./loginpage.php"><button class="btn btn-primary btn-lg" style="margin-top: 50px;"> Back to Login</button></a>
        </section>

        <section id="userFormCont" class="right-sec">
            <h1>Registration Form</h1>
            <center>
                <h3>Please fill up the blanks</h3>
            </center>
            <?php
            // Have fun with these errors hehe :>
            if (isset($_SESSION['reg_err'])) {
                foreach ($_SESSION['reg_err'] as $regErr) {
                    echo "<p>{$regErr}</p>";
                }

                unset($_SESSION['reg_err']);
            }

            ?>
            <form class="right-sec__form" method="POST" action="../src/php/registration_logic.php" enctype="multipart/form-data">
                <div>
                    <label for="first_name">First Name</label>
                    <input id="fname" name="first_name" type="text">
                </div>

                <div>
                    <label for="last_name">Last Name</label>
                    <input id="lname" name="last_name" type="text">
                </div>

                <div>
                    <label for="middle_initial">Middle Initial</label>
                    <input id="middle_initial" name="middle_initial" type="text">
                </div>

                <div>
                    <label for="email">Email</label>
                    <input id="email" name="email" type="text" required>
                </div>

                <div>
                    <label for="password">Password</label>
                    <input id="password" name="password" type="password" required>
                </div>

                <div>
                    <label for="password">Confirm Password</label>
                    <input id="confirm_password" name="confirm_password" type="password" required>
                </div>

                <div>
                    <label for="contact">Contact Number</label>
                    <input id="mobile" name="contact" type="text" maxlength="12" title="Ten digits code" required>
                </div>

                <div>
                    <label for="birthdate">Birthdate</label>
                    <input id="birthday" name="birthdate" type="date" required>
                </div>

                <div>
                    <label for="ssn">Upload File SSN</label>
                    <input id="ssn" name="ssn" type="file">
                </div>

                <div>
                    <label for="ssn">Upload Health Record</label>
                    <input id="image_health" name="image_health" type="file">
                </div>

                <input class="btn btn-primary" class="font-weight-bold" type="submit" name="submit" value="Register">
            </form>
        </section>



    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script src="../src/js/registration.js"></script>
</body>

</html>