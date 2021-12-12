<?php
    include '../../public/session_check.php';
    if ($_SESSION['currUser']['role'] != 'doctor') {
        header('location: ./prescriptions.php');
    }

    include './dbconnect.php';

    // var_dump($_POST, $_FILES);
    if (!empty(trim($_FILES['labTest']['name']))) {
        $target_dir = "../img/labTests/";
        $labtestDb = time() . basename($_FILES["labTest"]["name"]);
        $target_file = $target_dir . $labtestDb;
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        // Check if image file is a actual image or fake image
        $check = getimagesize($_FILES["labTest"]["tmp_name"]);
        if($check !== false) {
            // echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            $_SESSION['labTestImgErr']['notImage'] = "File is not an image.";
            $uploadOk = 0;
        }

        // Check if file already exists
        if (file_exists($target_file)) {
            $_SESSION['labTestImgErr']['fileExist'] = "Sorry, file already exists.";
            $uploadOk = 0;
        }
        
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
            if (move_uploaded_file($_FILES["labTest"]["tmp_name"], $target_file)) {
                $_SESSION['labTestImgSuccess'] = "Image uploaded.";
            } else {
                $_SESSION['labTestImgErr']['serverErr'] = "Sorry, there was an error uploading your file.";
            }
        }
    }


    $patientId = $_POST['patientId'];
    $date = $_POST['date'];
    $labTestDesc = $_POST['desc'];
    $labTestId = $_POST['labTestId'];

    $docSql = "SELECT * FROM doctors WHERE userID = {$_SESSION['currUser']['id']}";

    $docResults = mysqli_query($mysqli, $docSql);
    $docRow = mysqli_fetch_assoc($docResults);
    
    $imgUpdate = !empty(trim($_FILES['labTest']['name'])) ? ", `lab_test_img_filepath` = '$labtestDb' " : '';

    $updateSql = "UPDATE lab_tests 
        SET doctor_id = {$docRow['id']}, patient_id = $patientId, `date` = '$date', `lab_test_desc` = '$labTestDesc' $imgUpdate
        WHERE id = $labTestId";

    if (mysqli_query($mysqli, $updateSql)) {
        mysqli_free_result($docResults);
        mysqli_close($mysqli);
        header('location: ../../public/labTest.php');
        exit();
    }

?>