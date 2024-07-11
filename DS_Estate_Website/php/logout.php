<?php
    session_start();

    session_destroy(); // Destroy the session currently running, as a result we log out the user
    header('Location: login.php');
    exit();

?>