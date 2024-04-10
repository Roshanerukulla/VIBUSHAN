<?php
// Database connection
include 'dbconnection.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
// Retrieve values from form
$email = $_POST['email'];
$password = $_POST['password'];

// SQL query to check if email and password exist in the database
$sql = "SELECT email, password FROM manager_vibushan WHERE email = '$email' AND password = '$password'";
$result = mysqli_query($conn, $sql);

// If user exists, redirect to home page, else show error message
if (mysqli_num_rows($result) > 0) {
    header("Location: manager_view.html"); // Redirect to home page
    exit();
} else {
    echo "Invalid email or password"; // Show error message
}
}
else{
    
}
$conn->close();
?>
