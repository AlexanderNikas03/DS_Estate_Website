<!-- The registration/login system was mainly influenced from this guide: 
 https://www.fundaofwebit.com/post/login-and-registration-form-in-php-mysql-with-session -->

<?php
session_start();

// Checks if the user is already logged in, if he is it redirects to Feed
if(isset($_SESSION['loggedInStatus'])){
    header('Location: index.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Form in PHP MySQL with Session</title>
    <link rel="stylesheet" href="../css/stylesRegister.css">
</head>
<body>

    <div class="container">
        <div class="logo">
            <img src="../images/LogobyAnastasiaKoutougdi.png" alt="Logo">
        </div>

        <h4>Register</h4>
        <hr>
        <!-- Displays errors if there are any -->
        <?php
        if(isset($_SESSION['errors']) && count($_SESSION['errors']) > 0){
            foreach($_SESSION['errors'] as $error){
                ?>
                <div class="alert"><?= $error; ?></div>
                <?php
            }
            unset($_SESSION['errors']); // Clears the errors after 
        }

        if(isset($_SESSION['message'])){
            echo '<div class="alert alert-success">'.$_SESSION['message'].'</div>';
            unset($_SESSION['message']);
        }
        ?>

        <!-- Registration form -->
        <form action="register-code.php" method="POST">

            <div class="formGroup">
                <label>Name</label>
                <input type="text" name="name" required>
            </div>
            <div class="formGroup">
                <label>Surname</label>
                <input type="text" name="surname" required>
            </div>
            <div class="formGroup">
                <label>Username</label>
                <input type="text" name="username" required>
            </div>
            <div class="formGroup">
                <label>Email</label>
                <input type="email" name="email" required>
            </div>
            <div class="formGroup">
                <label>Password</label>
                <input type="password" name="password" required>
            </div>
            <div class="formGroup">
                <button type="submit" name="registerBtn">Submit</button>
            </div>
            <div class="textCenter">
                <a href="login.php">Click here to Login</a>
            </div>

        </form>
    </div>

</body>
</html>
