<?php 
session_start(); 

// if the user is not logged in a message iss diplayedd and input is disablesd
if (!isset($_SESSION['loggedInStatus']) ) {
    $disabled = 'disabled';
    $message = "You must log in to create a listing.";
} else{
    $disabled = ''; // Enable input if the user is logged in
    $message = '';  // No warning if the user is logged in
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/stylesIndex.css">
    <link rel="stylesheet" href="../css/stylesInterface4.css">
    <title>Create Listing</title>
</head>
<body>

    <?php include 'header.php'; ?> 

    <main>
    <h1 style="text-align: center;">Create Listing</h1>
        <?php if(!empty($message)): ?>
            <div class="errors">
                <p><?php echo $message; ?></p>
            </div>
        <?php endif; ?>

        <!-- This form has both options: image upload locally or URL input -->
        <form action="interface4-code.php" method="POST" enctype="multipart/form-data" id="listingForm">
            <label for="fileToUpload">Upload Photo:</label>
            <input type="file" name="fileToUpload" id="fileToUpload" accept="image/*" <?php echo $disabled; ?>>
            
            <label for="photoUrl">Or enter Photo URL:</label>
            <input type="text" name="photoUrl" id="photoUrl" <?php echo $disabled; ?>>
            
            <label for="title">Title:</label>
            <input type="text" name="title" id="title" required <?php echo $disabled; ?>>
            
            <label for="area">Area:</label>
            <input type="text" name="area" id="area" required <?php echo $disabled; ?>>
            
            <label for="rooms">Number of Rooms:</label>
            <input type="number" name="rooms" id="rooms" required <?php echo $disabled; ?>>
            
            <label for="price_per_night">Price per Night:</label>
            <input type="number" name="price_per_night" id="price_per_night" required <?php echo $disabled; ?>>
            
            <?php if(empty($message)): ?>
                <button type="submit" name="createListingBtn">Create Listing</button>
            <?php else: ?>
                <button type="button" disabled>Create Listing</button>
            <?php endif; ?>
        </form>
    </main>

    <?php include '../html/footer.html'; ?> 

    <script>
        const fileInput = document.getElementById('fileToUpload');
        const urlInput = document.getElementById('photoUrl');

        // If the form is disabled file and URL inputs are disabled
        if ('<?php echo $disabled; ?>' === 'disabled') {
            fileInput.disabled = true;
            urlInput.disabled = true;
        }

        // We add an event listener to ensure either a file or URL is provided
        document.getElementById('listingForm').addEventListener('submit', function(event) {
            if (!fileInput.value && !urlInput.value) {
                event.preventDefault();
                alert('Please upload a photo or enter a photo URL.'); 
            }
        });
    </script>
    <script src="../js/scripts.js"></script>
</body>
</html>
