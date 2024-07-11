<?php 
session_start();

require_once 'dbcon.php';

// Check to see if the login button is pressed
if(isset($_POST['loginBtn']))
{
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    $errors = []; 

    // Validate input fields
    if($username == '' || $password == ''){
        array_push($errors, "All fields are mandatory");
    }

    if(count($errors) > 0)
    {
        $_SESSION['errors'] = $errors;
        header('Location: login.php');
        exit();
    }

    // Query to fetch user details based on username and password
    $userQuery = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $result = mysqli_query($conn, $userQuery);

    if($result){
        if(mysqli_num_rows($result) == 1){

            // Fetch user details
            $user = mysqli_fetch_assoc($result);

            // Set session variables
            $_SESSION['loggedInStatus'] = true;
            $_SESSION['user_id'] = $user['id']; 
            $_SESSION['username'] = $user['username']; // You can store other user details as needed

            header('Location: index.php');
            exit();
            
        }else{
            array_push($errors, "Invalid Username or Password!");
            $_SESSION['errors'] = $errors;
            header('Location: login.php');
            exit();
        }
    }else{
        array_push($errors, "Something Went Wrong!");
        $_SESSION['errors'] = $errors;
        header('Location: login.php');
        exit();
    }
}
?>
