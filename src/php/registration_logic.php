<?php
    session_start();
    require 'dbconnect.php';
   //  var_dump($_POST);
    if(isset($_POST['submit'])){
            $first_name = $_POST['first_name'];
            $last_name = $_POST['last_name'];
            $email = $_POST['email'];
            $password = password_hash($_POST['password'], PASSWORD_BCRYPT, ['cost' => 10]);
            $confirm_password = password_hash($_POST['confirm_password-pass'], PASSWORD_BCRYPT, ['cost' => 10]);
            $birthdate = $_POST['birthdate'];
            $street_address = $_POST['street_address'];
            $province = $_POST ['province'];
            $city = $_POST['city'];
            $postal_code = $_POST['postal_code'];
            $ssn = $_POST['ssn'];
            $sql = "INSERT INTO patients_table (first_name, last_name, email, `password`, confirm_password, birthdate, street_address, province, city, postal_code, ssn) 
                                        VALUES ('$first_name','$last_name','$email','$password','$confirm_password','$birthdate','$street_address','$province','$city','$postal_code','$ssn')";
            // var_dump(mysqli_query($mysqli, $sql));
            if (mysqli_query($mysqli, $sql)) {
                header("location: ../../public/homepage.html");
               
            } else {
            echo "Error: " . $sql . ":-" . mysqli_error($mysqli);
            }
            mysqli_close($mysqli);
    };

?>