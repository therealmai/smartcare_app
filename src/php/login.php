<?php
    session_start(); 
    include 'dbconnect.php'; 


    if(isset($_POST['submit'])){

        $_SESSION['login_err'] = [];

        if (empty(trim($_POST['email']))) {
            $_SESSION['login_err']['email_err'] = "Email is required";
        } else {
            $email = trim($_POST['email']);
        }

        
        if (empty(trim($_POST['password']))) {
            $_SESSION['login_err']['password_err'] = "Password is required";
        } else {
            $password = trim($_POST['password']);
        }

        if (isset($email) && isset($password)) {

            $query = "SELECT * FROM users WHERE email= '$email' LIMIT 1";

            $results = mysqli_query($mysqli, $query);
            $rows = mysqli_num_rows($results);
        
            if ($rows > 0) {
                $row = mysqli_fetch_assoc($results);
                if (password_verify($password, $row['password'])) {
                    $_SESSION['id'] = $row['id']; 
                    $_SESSION['email'] = $row['email']; 
                    $_SESSION['password'] = $row['password'];
                    mysqli_close($mysqli);
                    if($row['role'] == "doctor"){
                        header("location:../../public/doctorpage.php"); 
                    }else{
                        header("location:../../public/homepage.php");
                    }
                    // redirect to "login success" page would be a better solution
                    
                    //      } else {
                    //       echo "<SCRIPT> //not showing me this
                    //       alert('Incorrect Username and Password')
                    //       window.location.replace('../../public/loginpage.php');
                    //       </SCRIPT>";
                    //      }
                    //    } else {
                    //      echo "<SCRIPT> //not showing me this
                    //         alert('Incorrect Username and Password')
                    //         window.location.replace('../../public/loginpage.php');
                    //         </SCRIPT>";
                    //    }
                }            
            } else {
                $_SESSION['login_err']['email_err'] = "Email isn't registered";
            }
        }
    }

    header('location: ../../public/loginpage.php');

?>