<?php
session_start();

// Include database connection file
include 'dbconnection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $username = $_POST["username"];
    $password = $_POST["password"];

    try {
        // Prepare SQL statement to select user with provided username and password
        $stmt = $conn->prepare("SELECT * FROM customers WHERE username = :username AND password = :password");
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $password);
        $stmt->execute();

        // Check if user exists and credentials are correct
        if ($stmt->rowCount() == 1) {
            // Authentication successful, set session variable
            $_SESSION["loggedin"] = true;
            // Redirect to the customer query page after successful login
            header("Location: customer_query_page.html");
            exit;
        } else {
            // Authentication failed, redirect to sign-in page with error message
            header("Location: customer_sign_in.html?error=invalid_credentials");
            exit;
        }
    } catch (PDOException $e) {
        // Handle database connection error
        echo "Error: " . $e->getMessage();
    }

    // Close connection
    $conn = null;
}
?>
