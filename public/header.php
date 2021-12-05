<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SmartCare - Homepage</title>
    <!-- Bootstrap CSS Link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="../src/css/index.css">

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

<body>

    <div class="container-nav">
        <nav class="navbar navbar-expand-lg">
            <div class="container-xl">
                <div class="container-fluid">
                    <a class="navbar-brand" href="/">
                        <div class="logo-image">
                            <img src="../src/img/logo.jpg" width="100" height="300" class="img-fluid">
                        </div>
                    </a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse nav justify-content-end" id="navbarNavDropdown">
                        <ul class="nav">

                            <li class="nav-item">
                                <a class="nav-link nav-head" href="#">Home</a>
                            </li>

                            <li class="nav-item nav-head">
                                <a class="nav-link" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    nav 1
                                </a>
                            </li>

                            <li class="nav-item nav-head">
                                <a class="nav-link" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    nav 2
                                </a>
                            </li>

                            <li class="nav-item nav-head">
                                <a class="nav-link" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    nav 3
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link nav-head" href="#">nav 4</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link nav-head" href="#">nav 5</a>
                            </li>

                            <li class="nav-item">
                                <button class="btn btn-primary"><a class="nav-link nav-head" href="#">Logout</a></button>
                            </li>

                        </ul>
                    </div>
                </div>
            </div>
        </nav>
</body>