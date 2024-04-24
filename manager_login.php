<?php
// Start session
// Start session
session_start();

// Database connection
include 'dbconnection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve values from form
    $email = $_POST['email'];
    $password = $_POST['password'];

    // SQL query to retrieve hashed password based on email
    $sql = "SELECT email, password FROM manager_vibushan WHERE email = '$email'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        // Fetch the hashed password
        $row = mysqli_fetch_assoc($result);
        $hashedPassword = $row['password'];

        // Verify password
        if (password_verify($password, $hashedPassword)) {
            // Password is correct, set session variable and redirect to home page
            $_SESSION['manager_email'] = $email;
            header("Location: manager_view.php");
            exit();
        } else {
            // Password is incorrect
            echo "Invalid email or password";
            echo "<meta http-equiv='refresh' content='2;url=manager_sigin_reg.html'>";
            exit();
        }
    } else {
        // No user found with the given email
        echo "Invalid email or password";
        echo "<meta http-equiv='refresh' content='2;url=manager_sigin_reg.html'>";
        exit();
    }
}

$conn->close();

?>
