<?php
session_start();
include "dbconnection.php";

// Redirect to customer sign-in page if customer_id is not set
if (!isset($_SESSION['customer_id'])) {
    header("Location: thankyou.html");
    exit;
}

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $food_rating = $_POST['food_rating'] ?? '';
    $interface_rating = $_POST['interface_rating'] ?? '';
    $ordering_rating = $_POST['ordering_rating'] ?? '';
    $comment = $_POST['comment'] ?? '';

    // Validate form data (optional)
    // Add your validation logic here, e.g., checking if ratings are within a specific range

    // Prepare SQL statement to insert ratings into the database
    $sql = "INSERT INTO customer_reviews (customer_id, food_rating, interface_rating, ordering_rating, comment) 
            VALUES (?, ?, ?, ?, ?)";

    // Prepare and bind parameters
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iiiss", $customer_id, $food_rating, $interface_rating, $ordering_rating, $comment);

    // Set customer_id
    $customer_id = $_SESSION['customer_id'];

    // Execute the statement
    if ($stmt->execute()) {
        echo "Review submitted successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close statement and connection
    $stmt->close();
}

// Close database connection
$conn->close();
?>
