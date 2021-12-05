<?php
    require 'dbconnect.php';
   //  var_dump($_POST);
    if(isset($_POST['submit'])){
            $first_name = $_POST['first_name'];
            $last_name = $_POST['last_name'];
            $middle_initial = $_POST['middle_initial'];
            $email = $_POST['email'];
            $password = password_hash($_POST['password'], PASSWORD_BCRYPT, ['cost' => 10]);
            $confirm_password = password_hash($_POST['confirm_password-pass'], PASSWORD_BCRYPT, ['cost' => 10]);
            $birthdate = $_POST['birthdate'];
            $contact = $_POST['contact'];
            $year = date('Y', strtotime($birthdate));
            $month = date('m', strtotime($birthdate));
            $day = date('d', strtotime($birthdate));
            $ssn = $_POST['ssn'];
            echo $day;
            $sql = "INSERT INTO users ( email, `password`, ssn, contact, firstname, lastname, middle_initial, `year`, `month`, `day`) 
                                  VALUES ('$email','$password','$ssn','$contact','$first_name','$last_name','$middle_initial','$year','$month','$day')";
            // var_dump(mysqli_query($mysqli, $sql));
            if (mysqli_query($mysqli, $sql)) {
                header("location: ../../public/loginpage.php");
            } else {
            echo "Error: " . $sql . ":-" . mysqli_error($mysqli);
            }
            mysqli_close($mysqli);
    };
