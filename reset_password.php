<?php
// Include database connection
include 'dbconnection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $new_password = $_POST["new_password"];
    $confirm_password = $_POST["confirm_password"];

    // Check if the username exists in the database
    $sql_check_username = "SELECT * FROM customers WHERE username = ?";
    $stmt_check_username = $conn->prepare($sql_check_username);
    $stmt_check_username->bind_param("s", $username);
    $stmt_check_username->execute();
    $result = $stmt_check_username->get_result();

    

    if ($result->num_rows == 0) {
        // Email does not exist in the database
        echo "Incorrect email/Username. Please try again.";
        echo '<script>
                setTimeout(function(){
                    window.location.href = "reset_password.html";
                }, 2000); // 2000 milliseconds = 2 seconds
              </script>';
        exit(); // Exit PHP script
    }

    // Check if new password and confirm password match
    if ($new_password !== $confirm_password) {
        // Passwords don't match, redirect back to reset password page with error message
        header("Location: reset_password.html?error=password_mismatch");
        exit();
    }

    // Hash the new password
    $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

    // Update the hashed password in the database using prepared statement
    $sql = "UPDATE customers SET password = ? WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $hashed_password, $username);
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
