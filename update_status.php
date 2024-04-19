<?php
// Include your database connection file
include 'dbconnection.php';

// Check if the customer_id is set in the POST request
if(isset($_POST['customer_id'])) {
    // Sanitize the input to prevent SQL injection
    $customerId = mysqli_real_escape_string($conn, $_POST['customer_id']);
    
    // Update the status to 'Done' for the given customer_id
    $sql = "UPDATE customer_info SET status = 'Done' WHERE customer_id = '$customerId'";
    
    if (mysqli_query($conn, $sql)) {
        // If the query is successful, return a success message
        echo "Status updated successfully";
    } else {
        // If there's an error with the query, return an error message
        echo "Error updating status: " . mysqli_error($conn);
    }
} else {
    // If customer_id is not set in the POST request, return an error message
    echo "Customer ID not provided";
}

// Close the database connection
mysqli_close($conn);
?>
