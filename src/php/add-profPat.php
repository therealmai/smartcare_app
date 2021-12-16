<?php
    include('../../public/session_check.php');
    include './dbconnect.php';
    $imageID= $_SESSION['currUser']['id'];
    $target_dir = "../img/profiles/";
    $profile = basename($_FILES["profile_image"]["name"]);
    $id = $_POST['patient_id'];
    $finalImage = $imageID.".".$imageFileType;
    $target_file = $target_dir . $finalImage;
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    
    echo $finalImage . "-". $target_file."=";
    // Check if image file is a actual image or fake image
    $check = getimagesize($_FILES["profile_image"]["tmp_name"]);
    if($check !== false) {
        // echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        $_SESSION['labTestImgErr']['notImage'] = "File is not an image.";
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
        $_SESSION['labTestImgErr']['fileType'] = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        $_SESSION['labTestImgErr']['serverErr'] = "Sorry, your file was not uploaded.";
    // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["profile_image"]["tmp_name"], $target_file)) {
            $_SESSION['labTestImgSuccess'] = "Image uploaded.";
        } else {
            $_SESSION['labTestImgErr']['serverErr'] = "Sorry, there was an error uploading your file.";
        }
    }

    $sql = "UPDATE `patients` SET `image_profile` = '$profile' WHERE `userID` = '$id'";

    if (mysqli_query($mysqli, $sql)) {
        mysqli_close($mysqli);
        header('location: ../../public/profile-pat.php');
        exit();
    }else{
        echo "Error: " . $sql . ":-" . mysqli_error($mysqli);
    }

?>