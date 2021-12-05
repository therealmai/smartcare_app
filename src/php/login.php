<?php
   session_start(); 
   include 'dbconnect.php'; 


   if(isset($_POST['submit'])){
   $email = $_POST['email']; 
   $password = $_POST['password']; 


   $query = "SELECT * FROM users WHERE email= '$email' LIMIT 1";

   $results = mysqli_query($mysqli, $query);
   $rows = mysqli_num_rows($results);
   
   if ($rows > 0) {
     $row = mysqli_fetch_assoc($results);
     if (password_verify($password, $row['password'])) {
       
       $_SESSION['id'] = $row['id']; 
       $_SESSION['email'] = $row['email']; 
       $_SESSION['password'] = $row['password'];
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
      //no record found
   }
}

//SELECT doctors.id, doctors.userID, doctors.specialization, doctors.license_number, doctors.degree FROM `doctors` LEFT JOIN `users` ON doctors.userID = users.id;//
?>