<?php
    session_start(); // starts the session 

    // checks if the user is logged in by verifying the session variable
    if (!isset ($_SESSION['loggedInStatus']) ) {
        $_SESSION['message'] = "Login to continue...";
        // if the user is not logged in it redirects to the login page
        header('Location: login.php');
        exit();
    }
?>