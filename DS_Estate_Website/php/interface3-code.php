<?php
require_once 'dbcon.php';
session_start(); // Start the session

// Redirect to login if not logged in
if (!isset($_SESSION['loggedInStatus']) || $_SESSION['loggedInStatus'] !== true) {
    header('Location: login.php');
    exit;
}

// Check if property_id is provided in the URL
if (!isset($_GET['property_id'])) {
    die("Property not found.");
}

// Fetch property details based on property_id
$property_id = $_GET['property_id'];
$query = "SELECT * FROM listings WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $property_id);
$stmt->execute();
$result = $stmt->get_result();

// If property not found then terminate with an error message
if ($result->num_rows === 0) {
    die("Property not found.");
}

// Fetch property details into $property variable
$property = $result->fetch_assoc();

// Initialize session variables if not already set
if (!isset($_SESSION['name']) || !isset($_SESSION['surname']) || !isset($_SESSION['email'])) {
    // we assume you have a way to get the logged-in user's details from the database
    $user_id = $_SESSION['user_id'];
    $user_query = "SELECT name, surname, email FROM users WHERE id = ?";
    $user_stmt = $conn->prepare($user_query);
    $user_stmt->bind_param("i", $user_id);
    $user_stmt->execute();
    $user_result = $user_stmt->get_result();
    
    if ($user_result->num_rows === 1) {
        $user = $user_result->fetch_assoc();
        $_SESSION['name'] = $user['name'];
        $_SESSION['surname'] = $user['surname'];
        $_SESSION['email'] = $user['email'];
    }
}

$name = $_SESSION['name'];
$surname = $_SESSION['surname'];
$email = $_SESSION['email'];

// Handle form submissions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Step 1: Check availability
    if (isset($_POST['step']) && $_POST['step'] == 1) {
        $start_date = $_POST['start_date'];
        $end_date = $_POST['end_date'];

        // Validate dates
        if (strtotime($start_date) > strtotime($end_date)) {
            $availability_error = "Start date must be before end date.";
        } else {
            // Query to check if property is available for selected dates
            $availability_query = "SELECT * FROM reservations WHERE listing_id = ? AND 
                ((start_date BETWEEN ? AND ?) OR (end_date BETWEEN ? AND ?))";
            $availability_stmt = $conn->prepare($availability_query);
            $availability_stmt->bind_param("issss", $property_id, $start_date, $end_date, $start_date, $end_date);
            $availability_stmt->execute();
            $availability_result = $availability_stmt->get_result();

            // If property is not available, set availability_error
            if ($availability_result->num_rows > 0) {
                $availability_error = "The property is not available for the selected dates.";
            } else {
                // Calculate reservation details if property is available
                $available = true;
                $initial_payment_amount = $property['price_per_night'] * ((strtotime($end_date) - strtotime($start_date)) / (60 * 60 * 24));
                $discount_rate = rand(10, 30) / 100;
                $final_payment_amount = $initial_payment_amount * (1 - $discount_rate);
            }
        }
    } elseif (isset($_POST['step']) && $_POST['step'] == 2) {
        // Step 2: Finalize reservation
        if (!isset($_SESSION['user_id']) || empty($_SESSION['user_id'])) {
            die("User ID not found in session. Debug: " . print_r($_SESSION, true));
        }

        $user_id = $_SESSION['user_id'];
        $start_date = $_POST['start_date'];
        $end_date = $_POST['end_date'];
        $total_amount = $_POST['final_payment_amount'];

        // Update session variables with form data if provided
        if (!empty($_POST['name'])) {
            $name = $_POST['name'];
            $_SESSION['name'] = $name;
        }
        if (!empty($_POST['surname'])) {
            $surname = $_POST['surname'];
            $_SESSION['surname'] = $surname;
        }
        if (!empty($_POST['email'])) {
            $email = $_POST['email'];
            $_SESSION['email'] = $email;
        }

        // Insert reservation into database
        $reservation_query = "INSERT INTO reservations (user_id, listing_id, start_date, end_date, total_amount, first_name, surname, email) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $reservation_stmt = $conn->prepare($reservation_query);
        $reservation_stmt->bind_param("iissssss", $user_id, $property_id, $start_date, $end_date, $total_amount, $name, $surname, $email);

        // Execute reservation query
        if ($reservation_stmt->execute()) {
            $success_message = "Your reservation has been successfully made.";

            // Clear session variables after successful reservation
            unset($_SESSION['name']);
            unset($_SESSION['surname']);
            unset($_SESSION['email']);

            header("Location: index.php"); // Redirect to index page after successful reservation
            exit();
        } else {
            $reservation_error = "There was an error processing your reservation.";
        }
    }
}
?>
