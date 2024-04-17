<?php
// Assuming you already have the database connection included in dbconnection.php
include 'dbconnection.php';

// Check if dish_id and change parameters are set and valid
if(isset($_POST['dish_id']) && isset($_POST['change'])) {
    $dishId = $_POST['dish_id'];
    $change = intval($_POST['change']); // Convert change to integer
    
    // Check if the change will result in a quantity less than 0
    if($change < 0) {
        echo "Error: Quantity cannot go below 0";
    } else {
        // Prepare SQL statement to update quantity
        $sql = "UPDATE alldishes SET quantity = quantity + ? WHERE dish_id = ?";
        $stmt = $conn->prepare($sql);
        
        // Bind parameters
        $stmt->bind_param("is", $change, $dishId);
        
        // Execute SQL statement
        if($stmt->execute()) {
            // Update successful
            echo "Quantity updated successfully";
        } else {
            // Update failed
            echo "Error updating quantity: " . $conn->error;
        }
        
        // Close statement
        $stmt->close();
    }
} else {
    // Parameters not set or invalid
    echo "Invalid request";
}

// Close connection
$conn->close();
?>
