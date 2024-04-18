<?php
session_start();
if (!isset($_SESSION['customer_id'])) {
    echo "Error: Customer ID not found in session.";
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
</head>
<body>
    <header>
        <nav class="navbar">
            <img src="logo.png" alt="" class="smalllogo">
            <ul class="nav-links">
                <li><a href="#">Home</a></li>
                <li><a href="#">About</a></li>
                <li><a href="#">Contact</a></li>
                <li><a href="customer_sign_in.html">Logout</a></li>
            </ul>
        </nav>
    </header>
    <div class="container">
        <h2>What do you want to do today? <?php echo $_SESSION['customer_id']; ?></h2>
        <div class="buttons">
            <a href="menu.php" class="button order-now">Order Now</a>
            <a href="#" class="button see-past-orders">See Past Orders</a>
        </div>
    </div>
</body>
</html>
