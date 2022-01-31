<?php
session_start();
include 'dbconnect.php';

if (isset($_POST['submit'])) {
    $id = $_POST['patient_id'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $verify = $_POST['verify'];
    echo $verify;
    // Storingthe cipher method 
    $ciphering = "AES-128-CTR";
    // Using OpenSSl Encryption method 
    $iv_length = openssl_cipher_iv_length($ciphering);
    $options   = 0;
    // Non-NULL Initialization Vector for encryption 
    $encryption_iv = '1234567891011121';
    // Storing the encryption key 
    $encryption_key = "smartcare";
    // Using openssl_encrypt() function to encrypt the data 
    $encryption = openssl_encrypt($password, $ciphering, $encryption_key, $options, $encryption_iv);

    $confirm_password = $_POST['confirm_password'];
    if ($_SESSION['currUser']['role'] == "doctor") {
        $sql = "SELECT * FROM `users` LEFT JOIN doctors ON users.id = doctors.userID WHERE users.id = '$id'";
        
    } else {
        $sql = "SELECT * FROM `users` LEFT JOIN patients ON users.id  = patients.userID WHERE users.id = '$id'";
    }
    if (mysqli_num_rows(mysqli_query($mysqli, $sql)) > 0) {
        $row =  mysqli_query($mysqli, $sql);
        $profile = mysqli_fetch_assoc($row);
        if ($confirm_password == $verify) {
            $query = "UPDATE `users` SET `email` = '$email', `password` = '$encryption' WHERE `users`.`id` = '$id';";
            if (mysqli_query($mysqli, $query)) {
                if ($_SESSION['currUser']['role'] == "doctor") {
                    header("location: ../../public/profile-doc.php");
                }else{
                    header("location: ../../public/profile-pat.php");
                }
            } else {
                echo "Error: " . $query . ":-" . mysqli_error($mysqli);
            }
        } else {

            $_SESSION['acc_error']['password'] = "Please type the correct old password";
            if ($_SESSION['currUser']['role'] == "doctor") {
                header("location: ../../public/profile-doc.php");
            }else{
                header("location: ../../public/profile-pat.php");
            }
        }
    }


    // $sql = "UPDATE `patients` SET `height` = '$height', `weight` = '$weight', `blood_pressure` = '$blood_pressure', `heart_rate` = '$heartRate' WHERE `patients`.`userID` = '$id';";
    // if(mysqli_query($mysqli, $sql)){
    //     if($age != NULL){
    //     $query = "UPDATE `users` SET `firstname` = '$firstname', `lastname` = '$lastname', `middle_initial` = '$middle_initial', `contact`='$contact', `month` = '$month', `day` = '$day', `year` = '$year' WHERE `users`.`id` = '$id';";
    //     }else{
    //     $query = "UPDATE `users` SET `firstname` = '$firstname', `lastname` = '$lastname', `middle_initial` = '$middle_initial', `contact`='$contact' WHERE `users`.`id` = '$id';";
    //     }
    //     if(mysqli_query($mysqli, $query)){
    //         header("location: ../../public/profile-pat.php");
    //     }else{
    //         echo "Error: " . $sql . ":-" . mysqli_error($mysqli);
    //     }
    // }else{
    //     echo "Error: " . $sql . ":-" . mysqli_error($mysqli);
    // }
}
