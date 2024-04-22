<?php
session_start(); // Start the session

// Include database connection file
include 'dbconnection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve values from form
    $email = $_POST['username'];
    $password = $_POST['password'];

    // SQL query to check if email and password exist in the database
    $sql = "SELECT customer_id, username, password FROM customers WHERE username = '$email' AND password = '$password'";
    $result = mysqli_query($conn, $sql);

    // If user exists, set session variables and redirect to home page
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result); // Fetch the row from the result set

        // Set session variable
        $_SESSION['customer_id'] = $row['customer_id'];

        // Redirect to home page
        header("Location: custome_query_page.php");
        exit();
    } else {
        echo "Invalid email or password"; // Show error message
        echo "<meta http-equiv='refresh' content='2;url=customer_sign_in.html'>";
    exit; // Stop further execution
    }
}
?>
