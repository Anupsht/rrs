<?php
require '../config/config.php';

// Check if user is logged in
if (empty($_SESSION['username'])) {
    header('Location: login.php');
    exit(); // Stop further execution
}

// Check if property ID is provided
if (empty($_POST['property_id'])) {
    $_SESSION['error_message'] = "Property ID is missing.";
    header('Location: list.php');
    exit(); // Stop further execution
}

// Retrieve property ID from POST data
$property_id = $_POST['property_id'];

try {
    // Fetch property details including image path
    $stmt = $connect->prepare('SELECT image FROM room_rental_registrations WHERE id = :property_id');
    $stmt->execute(array(':property_id' => $property_id));
    $property = $stmt->fetch(PDO::FETCH_ASSOC);

    // Delete property data from database
    $stmt = $connect->prepare('DELETE FROM room_rental_registrations WHERE id = :property_id');
    $stmt->execute(array(':property_id' => $property_id));

    // Check if image exists and delete it
    $image_path = $property['image'];
    if (file_exists($image_path) && !is_dir($image_path)) {
        unlink($image_path); // Delete the image file
    }

    $_SESSION['success_message'] = "Property deleted successfully.";
    header('Location: list.php');
    exit(); // Stop further execution
} catch (PDOException $e) {
    $_SESSION['error_message'] = "Error deleting property: " . $e->getMessage();
    header('Location: list.php');
    exit(); // Stop further execution
}
?>
