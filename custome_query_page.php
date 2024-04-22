<?php
session_start();
if (!isset($_SESSION['customer_id'])) {
    echo "Error: Customer ID not found in session.";
    echo "<meta http-equiv='refresh' content='2;url=customer_sign_in.html'>";
    exit;
}

// Retrieve customer_id from the session
$customer_id = $_SESSION['customer_id'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Query Page</title>
    <link rel="icon" href="logo.png" type="image/x-icon">
    <link rel="stylesheet" href="customer_query_page.css">
    <script>
        // Disable back button functionality after logging out
        window.addEventListener('beforeunload', function(event) {
            // Clear the session and redirect to the login page
            window.location.href = "logout.php";
        });
    </script>
</head>
<body>
    <header>
        <nav class="navbar">
            <img src="logo.png" alt="" class="smalllogo">
            <ul class="nav-links">
                <li><a href="custome_query_page.php">Home</a></li>
                <li><a href="#">About</a></li>
                <li><a href="#">Contact</a></li>
                <li><a href="logout.php">Logout</a></li>
                <!-- <li><a href="customer_sign_in.html" onclick="window.onunload();">Logout</a></li> -->
            </ul>
        </nav>
    </header>
    <div class="container">
        <h2>What do you want to do today?</h2>
        <div class="buttons">
            <a href="menu.php" class="button order-now">Order Now</a>
            <a href="past_orders.php" class="button see-past-orders">See Past Orders</a>
        </div>
    </div>
</body>
</html>
