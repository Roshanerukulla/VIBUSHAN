<?php
session_start(); // Start the session
include 'dbconnection.php';

// Check if the dishes array exists in the session and the dish ID is provided
if (isset($_SESSION['selected_dishes']) && isset($_POST['dish_id'])) {
    $dishId = $_POST['dish_id'];
    $change = intval($_POST['change']); // Convert change to integer

    // Prepare SQL statement to update quantity
    $sql = "UPDATE alldishes SET quantity = quantity + ? WHERE dish_id = ?";
    $stmt = $conn->prepare($sql);

    // Bind parameters
    $stmt->bind_param("ii", $change, $dishId);

    // Execute SQL statement
    if ($stmt->execute()) {
        // Update successful

        // Update the quantity in the session
        if (isset($_SESSION['selected_dishes'][$dishId])) {
            $_SESSION['selected_dishes'][$dishId] += $change;
            if ($_SESSION['selected_dishes'][$dishId] <= 0) {
                unset($_SESSION['selected_dishes'][$dishId]); // Remove dish from session if quantity is 0 or less
            }
        } else {
            $_SESSION['selected_dishes'][$dishId] = $change; // Add dish to session if it doesn't exist yet
        }
    } else {
        // Update failed
        echo "Error updating quantity: " . $conn->error;
    }

    // Close statement
    $stmt->close();
}
?>