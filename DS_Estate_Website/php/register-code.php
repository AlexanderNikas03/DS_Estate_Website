<?php
session_start();

require_once "dbcon.php";

// if the register button is clicked then
if(isset($_POST['registerBtn']))
{
    // We get the input of the user while also being careful for sql injections
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $surname = mysqli_real_escape_string($conn, $_POST['surname']);
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
   

    $errors = [];

    // Checks if all the fields are filled
    if($name == '' || $surname == '' || $username == '' || $email == '' || $password == ''){
        array_push($errors, "All fields are required");
    }

    // Valid email format
    if($email != '' && !filter_var($email, FILTER_VALIDATE_EMAIL)){
        array_push($errors, "Enter valid email address");
    }

    // is the email is unique ?
    if($email != ''){
        $emailCheck = mysqli_query($conn, "SELECT email FROM users WHERE email='$email'");
        if($emailCheck){
            if(mysqli_num_rows($emailCheck) > 0){
                array_push($errors, "Email already registered");
            }
        } else {
            array_push($errors, "Something went wrong with email check!");
        }
    }

    // Validates password length and other extra characterss
    if($password != '' && (strlen($password) < 4 || strlen($password) > 10 || !preg_match('/[0-9]/', $password))){
        array_push($errors, "Password must be between 4 and 10 characters long and contain at least one number");
    }

    

    // Checks if the username is unique
    if($username != ''){
        $usernameCheck = mysqli_query($conn, "SELECT username FROM users WHERE username='$username'");
        if($usernameCheck){
            if(mysqli_num_rows($usernameCheck) > 0){
                array_push($errors, "Username already taken");
            }
        } else {
            array_push($errors, "Something went wrong with username check!");
        }
    }

    // If errors are found then we store them in the session and redirect to register page
    if(count($errors) > 0){
        $_SESSION['errors'] = $errors;
        header('Location: register.php');
        exit();
    }

    // Insert users credentials into the database
    $query = "INSERT INTO users (name, surname, username, email, password) VALUES ('$name', '$surname', '$username', '$email', '$password')";
    $userResult = mysqli_query($conn, $query);

    // Check if the query was successful and depending on the situation the redirect needed is executed.
    if($userResult){
        $_SESSION['message'] = "Registered Successfully";
        header('Location: login.php');
        exit();
    }else{
        $_SESSION['message'] = "Something Went Wrong";
        header('Location: register.php');
        exit();
    }

}

?>