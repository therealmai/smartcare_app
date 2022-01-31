<?php     
include 'dbconnect.php'; 
   

    if(isset($_POST['submit'])){
        $id = $_POST['patient_id'];
        $contact = $_POST['contact'];
        $emergency_contact = $_POST['emergency_contact'];
        echo $id. " ";
        echo $contact;
            $query = "UPDATE `users` SET  `contact`='$contact' WHERE `users`.`id` = '$id';";
            $query2 = "UPDATE `patients` SET  `emergency_contact`='$emergency_contact' WHERE `patients`.`userID` = '$id';";
            if(mysqli_query($mysqli, $query)&&mysqli_query($mysqli, $query2)){
                header("location: ../../public/profile-pat.php");
            }else{
                echo "Error: " . $sql . ":-" . mysqli_error($mysqli);
            }
    }
