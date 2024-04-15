<?php
// Assuming you already have the database connection included in dbconnection.php
include 'dbconnection.php';

// Check if dish_id and availability parameters are set and valid
if(isset($_POST['dish_id']) && isset($_POST['availability'])) {
    $dishId = $_POST['dish_id'];
    $availability = $_POST['availability']; // Get availability
    
    // Prepare SQL statement to update availability
    $sql = "UPDATE alldishes SET available = ? WHERE dish_id = ?";
    $stmt = $conn->prepare($sql);
    
    // Bind parameters
    $stmt->bind_param("si", $availability, $dishId);
    
    // Execute SQL statement
    if($stmt->execute()) {
        // Update successful
        echo "Availability updated successfully";
    } else {
        // Update failed
        echo "Error updating availability: " . $conn->error;
    }
    
    // Close statement
    $stmt->close();
} else {
    // Parameters not set or invalid
    echo "Invalid request";
}

// Close connection
$conn->close();
?>
