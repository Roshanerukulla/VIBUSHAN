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

    // Check if the email exists in the database
    $sql_check_email = "SELECT * FROM manager_vibushan WHERE email = ?";
    $stmt_check_email = $conn->prepare($sql_check_email);
    $stmt_check_email->bind_param("s", $email);
    $stmt_check_email->execute();
    $result = $stmt_check_email->get_result();

    if ($result->num_rows == 0) {
        // Email does not exist in the database
        echo "Incorrect email. Please try again.";
        echo '<script>
                setTimeout(function(){
                    window.location.href = "forgot_pass_man.html";
                }, 2000); // 2000 milliseconds = 2 seconds
              </script>';
        exit(); // Exit PHP script
    }

    // Hash the password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Prepare SQL statement to update password in the database
    $sql = "UPDATE manager_vibushan SET password = ? WHERE email = ?";

    // Prepare and bind parameters
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $hashedPassword, $email);

    // Execute the statement
    if ($stmt->execute()) {
        echo "Password reset successfully!";
        sleep(3);
        header("Location: manager_sigin_reg.html");
    } else {
        echo "Error updating record: " . $conn->error;
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();
} else {
    // If form is not submitted, redirect to forgot password page
    header("Location: forgot_pass_man.html");
    exit(); // Exit PHP script
}
?>
