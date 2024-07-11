<?php
session_start();
require_once 'dbcon.php';

// had to enable this error reporting during development due to some repeating problems occuring
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Checks if the form has been submitted
if(isset($_POST['createListingBtn'])) {
    $title = $_POST['title'];
    $area = $_POST['area'];
    $rooms = $_POST['rooms'];
    $price_per_night = $_POST['price_per_night'];
    $photoUrl = $_POST['photoUrl'];
    
    $errors = []; // array to store errors
    
    // Validate input fields
    if(empty($title) || empty($area) || empty($rooms) || empty($price_per_night)) {
        $errors[] = "All fields should be filled in";
    }

    // Ensures either a file or URL is given but not both
    if ((isset($_FILES['fileToUpload']) && $_FILES['fileToUpload']['error'] === UPLOAD_ERR_OK) && !empty(trim($photoUrl))) {
        $errors[] = "Please upload a photo or enter a photo URL, not both.";
    } elseif (!(isset($_FILES['fileToUpload']) && $_FILES['fileToUpload']['error'] === UPLOAD_ERR_OK) && empty(trim($photoUrl))) {
        $errors[] = "Please upload a photo or enter a photo URL.";
    }
    
    // stores any errors and redirects to interface4, all this was necessary since i encountered many problems here while writing the code
    if(count($errors) > 0) {
        $_SESSION['errors'] = $errors;
        header('Location: interface4.php');
        exit();
    }

    // Handles file upload
    if(isset($_FILES['fileToUpload']) && $_FILES['fileToUpload']['error'] === UPLOAD_ERR_OK) {
        $target_dir = "../images/";
        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Check file size limit which is 5MB
        if ($_FILES["fileToUpload"]["size"] > 5000000) {
            $errors[] = "Sorry, your file is too large. The file should be less than 5MB.";
            $_SESSION['errors'] = $errors;
            header('Location: interface4.php');
            exit();
        }

        // Allow only specific picture formats ( JPG, JPEG, PNG and GIF )
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
            $errors[] = "Sorry, only JPG, JPEG, PNG and GIF files are allowed.";
            $_SESSION['errors'] = $errors;
            header('Location: interface4.php');
            exit();
        }

        // Place the uploaded file to the target directory
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            $photo = $target_file;
        } else {
            $errors[] = "Sorry, there was an error uploading your file.";
            $_SESSION['errors'] = $errors;
            header('Location: interface4.php');
            exit();
        }
    } elseif(!empty(trim($photoUrl))) {
        // Check in order to validate the URL format
        if(!filter_var($photoUrl, FILTER_VALIDATE_URL)) {
            $errors[] = "Invalid URL format";
            $_SESSION['errors'] = $errors;
            header('Location: interface4.php');
            exit();
        }
        $photo = $photoUrl;
    }

    // Insert into database if no errors have been detected
    if(empty($errors)) {
        $query = "INSERT INTO listings (photo, title, area, rooms, price_per_night) VALUES ('$photo', '$title', '$area', '$rooms', '$price_per_night')";
        $result = mysqli_query($conn, $query);

        // Check if the insertion was successful
        if($result) {
            $_SESSION['message'] = "Listing created successfully!";
            header('Location: index.php');
            exit();
        } else {
            $_SESSION['message'] = "Something went wrong: " . mysqli_error($conn); // Include error message
            header('Location: interface4.php');
            exit();
        }
    }
}
?>