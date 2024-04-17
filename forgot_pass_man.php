<?php
include 'dbconnection.php'; // Include database connection file

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $email = $_POST["email"];
    $authCode = $_POST["auth-code"];
    $password = $_POST["password1"];
    $confirmPassword = $_POST["password2"];

    // Check if authentication code is correct
    if ($authCode != '464646') {
        // Authentication code is incorrect
        echo "Authentication code is incorrect. Please try again.";
        exit(); // Exit PHP script
    }

    // Check if password and confirm password match
    if ($password != $confirmPassword) {
        // Passwords don't match
        echo "Passwords do not match. Please try again.";
        exit(); // Exit PHP script
    }

    // Escape variables to prevent SQL injection
    // $email = $conn->real_escape_string($email);
    // $password = $conn->real_escape_string($password);

    // Update password in the database
    $sql = "UPDATE manager_vibushan SET password = '$password' WHERE email = '$email'";

    // Execute the query
    if ($conn->query($sql) === TRUE) {
        echo "Password reset successfully!";
    } else {
        echo "Error updating record: " . $conn->error;
    }

    // Close connection
    $conn->close();
} else {
    // If form is not submitted, redirect to forgot password page
    header("Location: forgot_pass_man.html");
    exit(); // Exit PHP script
}
?>
