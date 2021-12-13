<?php     
include 'dbconnect.php'; 
   
    if(isset($_POST['submit'])){
        $id = $_POST['patient_id'];
        $contact = $_POST['contact'];
        echo $id. " ";
        echo $contact;
            $query = "UPDATE `users` SET  `contact`='$contact' WHERE `users`.`id` = '$id';";
            if(mysqli_query($mysqli, $query)){
                header("location: ../../public/profile-pat.php");
            }else{
                echo "Error: " . $sql . ":-" . mysqli_error($mysqli);
            }
        }
