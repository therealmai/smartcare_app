<?php     
include 'dbconnect.php'; 
   
    if(isset($_POST['submit'])){
        $id = $_POST['patient_id'];
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $middle_initial = $_POST['middle_initial'];
        $age = $_POST['age'];
        $year = date('Y', strtotime($age));
        $month = date('m', strtotime($age));
        $day = date('d', strtotime($age));
        $contact = $_POST['contact'];
        $height= $_POST['height'];
        $weight = $_POST['weight'];
        $blood_pressure = $_POST['blood_pressure'];
        $heartRate = $_POST['heartRate'];
        echo $id;
   
        $sql = "UPDATE `patients` SET `height` = '$height', `weight` = '$weight', `blood_pressure` = '$blood_pressure', `heart_rate` = '$heartRate' WHERE `patients`.`userID` = '$id';";
        if(mysqli_query($mysqli, $sql)){
            if($age != NULL){
            $query = "UPDATE `users` SET `firstname` = '$firstname', `lastname` = '$lastname', `middle_initial` = '$middle_initial', `contact`='$contact', `month` = '$month', `day` = '$day', `year` = '$year' WHERE `users`.`id` = '$id';";
            }else{
            $query = "UPDATE `users` SET `firstname` = '$firstname', `lastname` = '$lastname', `middle_initial` = '$middle_initial', `contact`='$contact' WHERE `users`.`id` = '$id';";
            }
            if(mysqli_query($mysqli, $query)){
                header("location: ../../public/profile-pat.php");
            }else{
                echo "Error: " . $sql . ":-" . mysqli_error($mysqli);
            }
        }else{
            echo "Error: " . $sql . ":-" . mysqli_error($mysqli);
        }
    }
?>