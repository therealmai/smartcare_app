<?php
    session_start();
    require 'dbconnect.php';
    $height = '';
    $weight = '';
    $blood_pressure = '';
    $heart_rate = '';
   //  var_dump($_POST);
   $allowTypes = array('jpg','png','jpeg','gif','pdf');
   $target_dir = "../uploads/";
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

        if (empty(basename($_FILES['ssn']['name']))) {
            
            $_SESSION['reg_err']['ssnErr'] = "SSN is required";
        } else {
            $ssn = basename($_FILES['ssn']['name']);
            $targetFileSSN =$target_dir . $ssn; 
            $fileSSN = strtolower(pathinfo($targetFileSSN,PATHINFO_EXTENSION));
        }

        if (empty(basename($_FILES['image_health']['name']))) {
            $_SESSION['reg_err']['image_health'] = "Health Record is required";
        } else {
            $health = basename($_FILES['image_health']['name']);
            $targetFileHealth = $target_dir . $health; 
            $filehealth = strtolower(pathinfo($targetFileHealth ,PATHINFO_EXTENSION));
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
            $sql = "SELECT id FROM users WHERE email = ?";
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

        if ((move_uploaded_file($_FILES["image_health"]["tmp_name"], $targetFileHealth)) && (move_uploaded_file($_FILES["ssn"]["tmp_name"], $targetFileSSN))) {
            echo "sucess health and ssn";
        }else{
            echo "no health and ssn";
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
        if( (in_array($fileSSN, $allowTypes)) && (in_array($filehealth, $allowTypes))  ){
        $sql = "INSERT INTO users (email, `password`, confirm_password, contact, firstname, lastname, middle_initial, `year`, `month`, `day`,ssn_image,health_record) 
            VALUES ('$email','$hashedPass', '$confPass','$contact','$first_name','$last_name','$middle_initial','$year','$month','$day','$health', '$ssn')";        // var_dump(mysqli_query($mysqli, $sql));
        }else{
            $_SESSION['reg_err']['filetype_error'] = "Filetype not accepted";
        }
        if (mysqli_query($mysqli, $sql)) {
                $selectQuery = "SELECT * FROM users WHERE email= '$email' LIMIT 1";
                $results = mysqli_query($mysqli, $selectQuery);
                $rows = mysqli_num_rows($results);

                if ($rows > 0) {
                    $row = mysqli_fetch_assoc($results);
                    $_SESSION['currUser'] = $row;
                    echo $_SESSION['currUser']['id']."heelo";
                    $id = $_SESSION['currUser']['id'];
                    
                    $query = "INSERT INTO patients (userID, height, `weight`, blood_pressure, heart_rate)
                                            VALUES('$id','$height', '$weight', '$blood_pressure', '$heart_rate')";
                    if (mysqli_query($mysqli, $query)){
                        header("location: ../../public/homepage.php");
                    }else{
                        echo "Error: " . $query . ":-" . mysqli_error($mysqli);
                    }
                    mysqli_close($mysqli);
                    exit();
                }            
         }


        $_SESSION['reg_error']['server_err'] = "A server error has occurred";
        $_SESSION['reg_error']['sql_err'] = "Error: " . $sql . ":-" . mysqli_error($mysqli);
        header('location: ../../public/registration.php');

    };
