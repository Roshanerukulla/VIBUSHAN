<?php
// Include database connection
include 'dbconnection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $new_password = $_POST["new_password"];
    $confirm_password = $_POST["confirm_password"];

    // Check if new password and confirm password match
    if ($new_password !== $confirm_password) {
        // Passwords don't match, redirect back to reset password page with error message
        header("Location: reset_password.html?error=password_mismatch");
        exit();
    }

    // Update the password in the database using prepared statement
    $sql = "UPDATE customers SET password = ? WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $new_password, $username);
    if ($stmt->execute()) {
        // Password updated successfully, redirect to sign-in page or display a success message
        header("Location: customer_sign_in.html");
        exit();
    } else {
        // Error updating password, redirect back to reset password page with error message
        header("Location: reset_password.html?error=update_failed");
        exit();
    }
}

// If form is not submitted, redirect to reset password page
header("Location: reset_password.html");
exit();
?>
