<?php
    session_start();
    require 'dbconnect.php';
   //  var_dump($_POST);
    if(isset($_POST['submit'])){

        // array init
        $_SESSION['reg_err'] = [];

        // Base input validations
        if (empty(trim($_POST['first_name'])) && empty(trim($_POST['last_name'])) && empty(trim($_POST['middle_initial']))) 
            $_SESSION['reg_err']['nameErr'] = "First Name and Last Name are both empty.";

        if (empty(trim($_POST['email']))) 
            $_SESSION['reg_err']['emailErr'] = "Email is required";

        if (empty($_POST['password'])) {
            $_SESSION['reg_err']['passErr'] = "Password is required";
        } else {
            $password = trim($_POST['password']);
        }

        if (empty(trim($_POST['confirm_password']))) {
            $_SESSION['reg_err']['confPassErr'] = "Confirm Password is required";
        } else {
            $confPass = trim($_POST['confirm_password']);
        }

        if (empty(trim($_POST['contact']))) {
            $_SESSION['reg_err']['contactErr'] = "Contact # is required";
        } else {
            $contact = trim($_POST['contact']);
        }

        if (empty(trim($_POST['ssn']))) {
            $_SESSION['reg_err']['ssnErr'] = "SSN is required";
        } else {
            $ssn = trim($_POST['ssn']);
        }


        // Validate password and confPass
        if (isset($password) && isset($confPass)) {
            if ($password !== $confPass) {
                $_SESSION['reg_err']['passwordSimilar'] = "Password did not match";
            } else {
                $hashedPass = password_hash($password, PASSWORD_BCRYPT, ['cost' => 10]);
            }
        }


        // Validate email
        if (!isset($_SESSION['reg_err']['emailErr'])) {
            // Validate email format
            if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                $_SESSION['reg_err']['emailInvalid'] = "Invalid email";
            }

            // Check if email already exists
            $sql = "SELECT id FROM user WHERE email = ?";
            if($stmt = $mysqli->prepare($sql)) {
                $stmt->bind_param("s", $paramEmail);
                $paramEmail = trim($_POST['email']);
                if($stmt->execute()) {
                    $stmt->store_result();
                    if($stmt->num_rows() === 1) {
                        $_SESSION['reg_err']['emailUsed'] = "Email already registered. Use another email.";
                    } else {
                        $email = trim($_POST['email']);
                    }
                } else { 
                    $_SESSION['reg_err'][] = "Server Error. Please Try Again.";
                }

                // Close statement;
                $stmt->close();
                unset($sql);
            }
        }

        // Redirect if input validation fails
        if (!empty($_SESSION['reg_err']))
            header('location: ../../public/registration.php');


        $first_name =  $_POST['first_name'] ?? '';
        $last_name = $_POST['last_name'] ?? '';
        $middle_initial = $_POST['middle_initial'] ?? '';
        $birthdate = $_POST['birthdate'] ?? '';
        $year = date('Y', strtotime($birthdate));
        $month = date('m', strtotime($birthdate));
        $day = date('d', strtotime($birthdate));
        $sql = "INSERT INTO users (email, `password`, ssn, contact, firstname, lastname, middle_initial, `year`, `month`, `day`) 
            VALUES ('$email','$hashedPass','$ssn','$contact','$first_name','$last_name','$middle_initial','$year','$month','$day')";        // var_dump(mysqli_query($mysqli, $sql));
        
        if (mysqli_query($mysqli, $sql)) {
            header("location: ../../public/homepage.php");
            
        } else {
        echo "Error: " . $sql . ":-" . mysqli_error($mysqli);
        }
        mysqli_close($mysqli);
    };
