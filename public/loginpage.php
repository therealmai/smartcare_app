<?php 
    session_start();
    if (isset($_SESSION['id']))
        header('location: ./homepage.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>smartcare - Homepage</title>
    <!-- Bootstrap CSS Link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="../src/css/login.css">

    <!-- Font Links -->
    <!-- Roboto -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@500&display=swap" rel="stylesheet">
    <!-- Varela Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Varela+Round&display=swap" rel="stylesheet">
</head>
<body style="background-image: url('../src/img/Login\ bg.png'); background-size:100%">

<div class="container-nav">

    <nav class="navbar navbar-expand-lg">
    
      <div class="container-xl">          

          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
            
    <main>
      <div class="container">
        <div class="smartcare-logo">
          <img src="../src/img/smartcare login.jpg" alt="smartcare-logo.png" width="150%">
        </div>
        <?php
            // Have fun with these errors hehe :>
            if (isset($_SESSION['login_err'])) {
                foreach($_SESSION['login_err'] as $loginErr) {
                    echo "<p>{$loginErr}</p>";
                }
                
                unset($_SESSION['login_err']);
            }
            
        ?>
        <form class="login-form" method="POST" action="../src/php/login.php">
          <div class="user">
            <input class="user" type="text" name="email" placeholder="EMAIL" required>
          </div>

          <div class="password">
            <input class="password" type="password" name="password" placeholder="PASSWORD" required>
          </div>
          <div class="login-btn">
            <input type="submit" name="submit" value="SUBMIT" >
          </div>
          <label class="checkb">
            <input type="checkbox" checked="checked">
            REMEMBER ME<span class="checkmark"></span>
          </label>
          <hr>
          <center>
            <label>
              Don't have an account? <a href="registration.php" style="text-decoration: none;">Sign Up</a>
            </label>
          </center>
        </form>
          
      </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>