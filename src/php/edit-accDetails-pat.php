<?php    
session_start(); 
include 'dbconnect.php'; 
   
    if(isset($_POST['submit'])){
        $id = $_POST['patient_id'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $hashedPass = password_hash($password, PASSWORD_BCRYPT, ['cost' => 10]);
        $confirm_password = $_POST['confirm_password'];

        $sql = "SELECT * FROM `users` LEFT JOIN patients ON users.id  = patients.userID WHERE users.id = '$id'";
        if( mysqli_num_rows(mysqli_query($mysqli, $sql)) > 0 ){
            $row =  mysqli_query($mysqli, $sql);
            $profile = mysqli_fetch_assoc($row);
            if($confirm_password == $profile['confirm_password']){
                $query = "UPDATE `users` SET `email` = '$email', `password` = '$hashedPass', `confirm_password` = '$password' WHERE `users`.`id` = '$id';";
                if(mysqli_query($mysqli, $query)){
                    header("location: ../../public/profile-pat.php");
                }else{
                    echo "Error: " . $query . ":-" . mysqli_error($mysqli);
                }
            }else{
               
               $_SESSION['acc_error']['password'] = "Please type the correct old password";
               header("location: ../../public/profile-pat.php");
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
?>