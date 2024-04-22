<?php
 echo "Your password has been reset.";
// Include database connection
include 'dbconnection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $new_password = $_POST["new_password"];
    $confirm_password = $_POST["confirm_password"];

    // Check if passwords match
    if ($new_password !== $confirm_password) {
        // Passwords do not match, redirect back to reset password page with error message
        header("Location: reset_password.html?error=password_mismatch");
        exit();
    }

    // Hash the new password
    $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

    // Update the password in the database
    $update_query = "UPDATE customers SET password = '$hashed_password' WHERE username = '$username'";
    if (mysqli_query($conn, $update_query)) {
        // Password updated successfully, redirect to a success page
        echo "Your password has been reset.";
        header("Location: customer_sign_in.html");
        exit();
    } else {
        // Error updating password, redirect back to reset password page with error message
        header("Location: reset_password.html?error=update_failed");
        exit();
    }
}
?>
