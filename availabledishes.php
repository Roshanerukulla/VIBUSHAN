<?php
include 'dbconnection.php';

// Start the session to store the cart items
session_start();

// Handle adding dishes to cart
if (isset($_POST['add_to_cart'])) {
    $dish_id = $_POST['dish_id'];
    // Check if the dish is already in the cart
    if (!isset($_SESSION['cart'][$dish_id])) {
        // Add the dish to the cart
        $_SESSION['cart'][$dish_id] = 1;
    } else {
        // Increment the quantity if the dish is already in the cart
        $_SESSION['cart'][$dish_id]++;
    }
}

// Filter dishes based on vegetarian or non-vegetarian
$filter = "";
if (isset($_GET['filter'])) {
    $filter = $_GET['filter'];
}

$sql = "SELECT * FROM alldishes WHERE available = 'Available'";
if ($filter == "vegetarian") {
    $sql .= " AND veg_or_nonveg = 'Vegetarian'";
} elseif ($filter == "nonvegetarian") {
    $sql .= " AND veg_or_nonveg = 'Non-Vegetarian'";
}

$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurant Menu</title>
    <link rel="stylesheet" href="availabledishes.css">
    <link rel="icon" href=
"logo.png"
          type="image/x-icon">
</head>
<body>
    <header class="header">
        <nav class="navbar">
            <img src="logo.png" alt="" class="smalllogo">
            <ul class="nav-links">
                <li><a href= "home.html">Home</a></li>
                <li><a href="#">About</a></li>
                <li><a href="#">Contact</a></li>
                <li><a href="customer_sign_in.html">Logout</a></li>
            </ul>
        </nav>
    </header>
    <div class="content">

        <div class="filters">
            <a href="availabledishes.php" <?php if (empty($filter)) echo 'class="active"'; ?>>All</a>
            <a href="availabledishes.php?filter=vegetarian" <?php if ($filter === "vegetarian") echo 'class="active"'; ?>>Vegetarian</a>
            <a href="availabledishes.php?filter=nonvegetarian" <?php if ($filter === "nonvegetarian") echo 'class="active"'; ?>>Non-Vegetarian</a>
        </div>

        

        <div class="grid-container">
            <?php
            // Display dishes in a grid view
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo '<div class="grid-item">';
                    echo '<img src="' . $row["image"] . '" alt="' . $row["dish_name"] . '">';
                    echo '<h3>' . $row["dish_name"] . '</h3>';
                    echo '<p>' . $row["cuisine"] . '</p>';
                    echo '<p>' . $row["ingredients"] . '</p>';
                    echo '<p>' . $row["veg_or_nonveg"] . '</p>';
                    echo '<p>$' . $row["price"] . '</p>';
                    echo '<form method="post">';
                    echo '<input type="hidden" name="dish_id" value="' . $row["dish_id"] . '">';
                    echo '<input type="submit" name="add_to_cart" value="Add to Cart">';
                    echo '</form>';
                    echo '</div>';
                }
            } else {
                echo "<p>No dishes available.</p>";
            }
            ?>
        </div>
    </div>
</body>
</html>