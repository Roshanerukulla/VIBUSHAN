<?php
session_start(); // Start the session

// Include database connection file
include 'dbconnection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve values from form
    $email = $_POST['username'];
    $password = $_POST['password'];

    // SQL query to retrieve hashed password from database
    $sql = "SELECT customer_id, username, password FROM customers WHERE username = '$email'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result); // Fetch the row from the result set

        // Verify the password
        if (password_verify($password, $row['password'])) {
            // Password is correct, set session variable and redirect to home page
            $_SESSION['customer_id'] = $row['customer_id'];
            header("Location: custome_query_page.php");
            exit();
        } else {
            // Password is incorrect, show error message
            echo "Invalid email or password";
            echo "<meta http-equiv='refresh' content='2;url=customer_sign_in.html'>";
            exit;
        }
    } else {
        // User does not exist, show error message
        echo "Invalid email or password";
        echo "<meta http-equiv='refresh' content='2;url=customer_sign_in.html'>";
        exit;
    }
}

?>
