<?php
    include('../../public/session_check.php');
    include './dbconnect.php';
    $imageID= $_SESSION['currUser']['id'];
    $target_dir = "../img/profiles/";
    $profile = basename($_FILES["profile_image"]["name"]);
    $id = $_POST['patient_id'];
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($profile,PATHINFO_EXTENSION));
    $final_profile =  $imageID.".".$imageFileType;
    $target_file = $target_dir . $imageID.".".$imageFileType;
    echo $target_file;

    // echo $finalImage . "-". $target_file."=";
    // Check if image file is a actual image or fake image
    $check = getimagesize($_FILES["profile_image"]["tmp_name"]);
    if($check !== false) {
        // echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        $_SESSION['profPatImgErr']['notImage'] = "File is not an image.";
        $uploadOk = 0;
    }

    // Check if file already exists
    // if (file_exists($target_file)) {
    //     $_SESSION['labTestImgErr']['fileExist'] = "Sorry, file already exists.";
    //     $uploadOk = 0;
    // }
    
    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
        $_SESSION['profPatImgErr']['fileType'] = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        $_SESSION['profPatImgErr']['serverErr'] = "Sorry, your file was not uploaded.";
    // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["profile_image"]["tmp_name"], $target_file)) {
            $_SESSION['profPatImgSuccess'] = "Image uploaded.";
        } else {
            $_SESSION['profPatImgErr']['serverErr'] = "Sorry, there was an error uploading your file.";
        }
    }
    if (!empty($_SESSION['profPatImgErr']))
    header('location: ../../public/profile-pat.php');

    $sql = "UPDATE `users` SET `image_profile` = '$final_profile' WHERE `id` = '$imageID'";

    if (mysqli_query($mysqli, $sql)) {
        mysqli_close($mysqli);
        echo "success";
        if($_SESSION['currUser']['role'] == 'patient'){
            header('location: ../../public/profile-pat.php');
        }else{
            header('location: ../../public/profile-doc.php');
        }
        exit();
    }else{
        echo "Error: " . $sql . ":-" . mysqli_error($mysqli);
    }

?>