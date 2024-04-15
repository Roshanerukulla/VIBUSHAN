<?php
include 'dbconnection.php'; // Include database connection file

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $username = $_POST["username"];
    $password = $_POST["password"];
    $confirmPassword = $_POST["confirm-password"];
    $address = $_POST["address"];

   

    // Check if password and confirm password match
    if ($password != $confirmPassword) {
        // Passwords don't match
        echo "Passwords do not match. Please try again.";
        exit(); // Exit PHP script
    }

    // Escape variables to prevent SQL injection
    $username = $conn->real_escape_string($username);
    $password = $conn->real_escape_string($password);
    $address = $conn->real_escape_string($address);

    // Perform database operation to save manager email
    // Construct the SQL query with escaped variables
    $sql = "INSERT INTO customers (username, password, address) VALUES ('$username', '$password' , '$address')";

    // Execute the query
    if ($conn->query($sql) === TRUE) {
        echo "customer registered successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    // Close connection
    $conn->close();
} else {
    // If form is not submitted, redirect to registration page
    header("Location: customer_reg.html");
    exit(); // Exit PHP script
}
?>
