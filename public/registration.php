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

           <a href="./homepage.php"><button class="btn btn-primary btn-lg" style="margin-top: 50px;" > Back to Home</button></a>
        </section>

        <section id="userFormCont" class="right-sec">
            <h1>Registration Form</h1>
            <center><h3>Please fill up the blanks</h3></center>
            <form class="right-sec__form" method="POST" action="../src/php/registration_logic.php">
                <div>
                    <label for="first_name">First Name</label>
                    <input id="fname" name="first_name" type="text" >
                </div>

                <div>
                    <label for="last_name">Last Name</label>
                    <input id="lname" name="last_name" type="text" >
                </div>

                <div>
                    <label for="email">Email</label>
                    <input id="email" name="email" type="text" >
                </div>

                <div>
                    <label for="password">Password</label>
                    <input id="password" name="password" type="password" >
                </div>

                <div>
                    <label for="confirm_password">Confirm Password</label>
                    <input id="confirm-pass" name="confirm_password-pass" type="password" >
                </div>

                <div>
                    <label for="birthdate">Birthday</label>
                    <input id="birthday" name="birthdate" type="date" >
                </div>

                <div>
                    <label for="street_address">Street Address</label>
                    <input id="streetAdd" name="street_address" type="text" >
                </div>

                <div>
                    <label for="province">Province</label>
                    <input id="province" name="province" type="text" >
                </div>

                <div>
                    <label for="city">City</label>
                    <input id="city" name="city" type="text" >
                </div>

                <div>
                    <label for="postal_code">Postal Code</label>
                    <input id="pcode" name="postal_code" type="number" >
                </div>

                <div>
                    <label for="ssn">Philippine SSN</label>
                    <input id="ssn" name="ssn" type="text" >
                </div>

                <input class = "btn btn-primary" class="font-weight-bold" type="submit" name="submit" value="Register">
            </form>
        </section>
        
        

        <!-- <section id="choicesCont" class="hide right-sec right-sec--choices-cont">
            <h1>
                Thank you for creating an account!
                <br>
                Tell us which are you.
            </h1>
            <div>
                <button id="choosePatientBtn">Patient</button>
                <button id="chooseDocBtn">Doctor</button>
                <button id="chooseSecBtn">Secretary</button>
            </div>
        </section>

        <section id="patientFormCont" class="hide right-sec right-sec--position">
            <h1>Hi Patient! Please fill up the blanks.</h1>
            <form class="right-sec__form" method="">
                <div>
                    <label for="fname">First Name</label>
                    <input id="a" name="fname" type="text" >
                </div>

                <button id="regBtnPatient" type="submit">Register</button>
            </form>
            <button class="backBtn"><-- Back</button>
        </section>

        <section id="doctorFormCont" class="hide right-sec right-sec--position">
            <h1>Hi Doctor! Please fill up the blanks.</h1>
            <form class="right-sec__form" method="">
                <div>
                    <label for="fname">First Name</label>
                    <input id="b" name="fname" type="text" >
                </div>
                
                <button id="regBtnDoc" type="submit">Register</button>
            </form>
            <button class="backBtn"><-- Back</button>
        </section>

        <section id="secretaryFormCont" class="hide right-sec right-sec--position">
            <h1>Hi Secretary! Please fill up the blanks.</h1>
            <form class="right-sec__form" method="">
                <div>
                    <label for="fname">First Name</label>
                    <input id="c" name="fname" type="text" >
                </div>
                
                <button id="regBtnSec" type="submit">Register</button>
            </form>
            <button class="backBtn"><-- Back</button>
        </section> -->
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <!-- <script src="../src/js/registration.js"></script> -->
</body>
</html>