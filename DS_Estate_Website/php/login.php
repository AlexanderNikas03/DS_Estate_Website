<!-- The registration/login system was mainly influenced from this guide: 
 https://www.fundaofwebit.com/post/login-and-registration-form-in-php-mysql-with-session -->

<?php
session_start();

// If the user is already logged in they will be redirected to the index page
if(isset($_SESSION['loggedInStatus'])) {
    header('Location: index.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form in PHP MySQL with Session</title>
    <link rel="stylesheet" href="../css/stylesLogin.css">
</head>
<body>

    <div class="container">
        <div class="logo">
            <img src="../images/LogobyAnastasiaKoutougdi.png" alt="Logo">
        </div>

        <h4>Login</h4>
        <hr>

        <?php // Display errors if we have any
        if(isset($_SESSION['errors']) && count($_SESSION['errors']) > 0){
            foreach($_SESSION['errors'] as $error){
                ?>
                <div class="alert"><?= $error; ?></div>
                <?php
            }
            unset($_SESSION['errors']);
        }

        if(isset($_SESSION['message'])){ // else we display success message
            echo '<div class="alert alert-success">'.$_SESSION['message'].'</div>';
            unset($_SESSION['message']);
        }
        ?>

        <form action="login-code.php" method="POST"> <!-- Login form -->

            <div class="formGroup">
                    <label class="colorInput">Username</label>
                    <input type="text" name="username">
            </div>
            <div class="formGroup">
                    <label class="colorInput">Password</label>
                    <input type="password" name="password">
            </div>
            <div class="formGroup">
                <button type="submit" name="loginBtn">Login Now</button>
            </div>
            <div class="textCenter">
                <a href="index.php">Go to Home Page</a>
                <br/><br/>
                <a href="register.php">Click here to Register</a>
            </div>

        </form>
    </div>

</body>
</html>
