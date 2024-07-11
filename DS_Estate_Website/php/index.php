<!-- E21120 ALEXANDROS NIKAS -->

<!-- The registration/login system was mainly influenced from this guide: 
 https://www.fundaofwebit.com/post/login-and-registration-form-in-php-mysql-with-session -->
 
<?php session_start(); 
// starts or resumes a session to be able to store and manage users persistent data across the different pages.
?>

<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../css/stylesIndex.css">
        <title>DS Estate</title>
    </head>

    <body>
        <?php include 'header.php'; 
        // Includes header ?> 

        <main>
            <!-- Displays messsage when a listing is created succesfully- -->
            <?php if(isset($_SESSION['message'])): ?>
                <div class="message">
                    <p><?php echo $_SESSION['message']; ?></p>
                    <?php unset($_SESSION['message']); ?>
                </div>
            <?php endif; ?>
        </main>

        <?php include 'interface1.php'; 
        // Includes the Feed interface  ?> 

        <?php include '../html/footer.html'; 
        // Includes header ?> 

        <script src="../js/scripts.js"></script>
        <!--Links to the javascript mobile hamburger navigation menu-->
    </body>

</html>
