<?php
// Start session
session_start();

// Database connection
include 'dbconnection.php';

// Prevent caching
header("Cache-Control: no-cache, no-store, must-revalidate");
header("Pragma: no-cache");
header("Expires: 0");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: max-age=0, no-cache, no-store, must-revalidate");
header("Pragma: no-cache");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve values from form
    $email = $_POST['email'];
    $password = $_POST['password'];

    // SQL query to check if email and password exist in the database
    $sql = "SELECT email, password FROM manager_vibushan WHERE email = '$email' AND password = '$password'";
    $result = mysqli_query($conn, $sql);

    // If user exists, set session variables and redirect to home page
    if (mysqli_num_rows($result) > 0) {
        // Set session variables
        $_SESSION['manager_email'] = $email;
        
        // Redirect to home page
        header("Location: manager_view.html");
        exit();
    } else {
        echo "Invalid email or password"; // Show error message
        echo "<meta http-equiv='refresh' content='2;url=manager_sigin_reg.html'>";
        exit; // Stop further execution
    }
}

$conn->close();
?>
