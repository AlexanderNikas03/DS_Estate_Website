<?php
    require_once 'dbcon.php'; // Makes connection 

    //  Gets all the listings from the database
    $query = "SELECT * FROM listings";
    $result = mysqli_query($conn,$query);

    // Checks if there are any listings in the databasse, if not create empty array
    if(mysqli_num_rows($result) > 0) {
        $listings = mysqli_fetch_all($result,MYSQLI_ASSOC);
    } else {  $listings = []; }
?>

<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../css/stylesInterface1.css">
    </head>

    <body>
        <main>
            <h1 class="homeListings">Home listings</h1>
            <!-- this is the container for all property listings which shows up on top of index.php -->
            <div class="propertyListings"> 
                <?php foreach ($listings as $property): ?> <!-- repeats for each property in the listings array -->
                    <div class="propertyCard">
                        <img src="<?php echo $property['photo']; ?>" alt="Property Photo">
                        <h2><?php echo $property['title']; ?></h2>
                        <p>Area: <?php echo $property['area']; ?> </p>
                        <p>Number of Rooms: <?php echo $property['rooms']; ?></p>
                        <p>Price per Night: €<?php echo number_format($property['price_per_night'], 2); ?></p>
                        <?php if(isset($_SESSION['loggedInStatus']) && $_SESSION['loggedInStatus'] === true): ?> <!-- reserve the property if user is logged in -->
                            <a href="interface3.php?property_id=<?php echo $property['id']; ?>" class="btn btn-primary">Reserve Property</a>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </div>
        </main>
    </body>

</html>
