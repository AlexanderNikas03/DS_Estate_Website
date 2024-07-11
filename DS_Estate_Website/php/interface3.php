<?php
include 'interface3-code.php';

// Ensures session variables are set or else default values are provided
$name = isset($_SESSION['name']) ? $_SESSION['name'] : '';
$surname = isset($_SESSION['surname']) ? $_SESSION['surname'] : '';
$email = isset($_SESSION['email']) ? $_SESSION['email'] : '';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/stylesIndex.css">
    <link rel="stylesheet" href="../css/stylesInterface3.css">
    <link rel="stylesheet" href="../css/stylesInterface4.css"> <!-- Include the new CSS for the box -->
    <title>Book Property</title>
    <script>
        // javascript function to validate start and end dates
        function validateDates() {
            const startDate = new Date(document.getElementById('start_date').value);
            const endDate = new Date(document.getElementById('end_date').value);

            if (startDate > endDate) {
                alert('End date must be after start date.');
                return false;
            }
            return true;
        }
    </script>
</head>
<body>
    <?php include 'header.php'; ?>

    <main>
        <h1>Book Property</h1>
        <div class="listingBox"> 
            <div class="propertyDetails">
                <img src="<?php echo $property['photo']; ?>" alt="Property Photo"> <!-- Display property photo -->
                <h2><?php echo $property['title']; ?></h2> <!-- Display property title -->
                <p>Area: <?php echo $property['area']; ?></p> <!-- Display property area -->
                <p>Number of Rooms: <?php echo $property['rooms']; ?></p> <!-- Display number of rooms -->
                <p>Price per Night: €<?php echo number_format($property['price_per_night'], 2); ?></p> <!-- Display price per night -->
            </div>

            <?php if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($availability_error)): ?>
                 <!-- Display availability error if no available dates are found -->
                <p class="error"><?php echo $availability_error; ?></p>
            <?php endif; ?>

            <?php if (!isset($available)): ?>
                <form method="POST" action="interface3.php?property_id=<?php echo $property_id; ?>" onsubmit="return validateDates();">
                    <input type="hidden" name="step" value="1">
                    <div>
                        <label for="start_date">Start Date:</label>
                        <input type="date" id="start_date" name="start_date" required>
                    </div>
                    <div>
                        <label for="end_date">End Date:</label>
                        <input type="date" id="end_date" name="end_date" required>
                    </div>
                    <button type="submit">Check Availability</button>
                </form>
            <?php else: ?>
                 <!-- Form in order to finalize reservation if availability is ok -->
                <form method="POST" action="interface3.php?property_id=<?php echo $property_id; ?>">
                    <input type="hidden" name="step" value="2">
                    <input type="hidden" name="start_date" value="<?php echo $start_date; ?>">
                    <input type="hidden" name="end_date" value="<?php echo $end_date; ?>">
                    <input type="hidden" name="final_payment_amount" value="<?php echo number_format($final_payment_amount, 2, '.', ''); ?>">
                    <div>
                        <label for="name">Name:</label>
                        <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($name); ?>">
                    </div>
                    <div>
                        <label for="surname">Surname:</label>
                        <input type="text" id="surname" name="surname" value="<?php echo htmlspecialchars($surname); ?>">
                    </div>
                    <div>
                        <label for="email">Email:</label>
                        <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>">
                    </div>
                    <p>Total Amount to Pay: €<?php echo number_format($final_payment_amount, 2, '.', ''); ?></p>
                    <button type="submit">Finalize Reservation</button>
                    <p>If you want to make the reservation under a different name, fill in the fields above.</p>
                </form>
            <?php endif; ?>

            <?php if (isset($success_message)): ?>
                <!-- Display success message if reservation is successful -->
                <p class="success"><?php echo $success_message; ?></p>
            <?php endif; ?>
        </div> 
    </main>

    <footer>
        <?php include '../html/footer.html'; ?>
    </footer>
    <script src="../js/scripts.js"></script>
</body>
</html>
