<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="refresh" content="10">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu</title>
    <link rel="stylesheet" href="manager_view.css">
    <style>
        .content-container {
            margin-top: 80px; /* Adjust this value to increase/decrease the gap between the navbar and the container */
            padding: 20px;
            background-color: #f9f9f9;
        }
    </style>
</head>
<body>
    <header>
        <nav class="navbar">
          <div class="container">
            <img src="logo.png" alt="" class="logo">
            <ul class="nav-links">
              <li><a href="#">Home</a></li>
              <li><a href="#">About</a></li>
              <li><a href="#">Your Cart</a></li>
              <li><a href="#">Contact</a></li>
            </ul>
          </div>
        </nav>
      </header>

      

<div class="container content-container">

<?php
session_start(); // Start the session
include 'dbconnection.php';

// Check if the dishes array exists in the session and is not empty
if (isset($_SESSION['selected_dishes']) && !empty($_SESSION['selected_dishes'])) {
    $selectedDishes = $_SESSION['selected_dishes'];
    echo "<h2>Checkout</h2>";
    echo "<table>";
    echo "<thead><tr><th>Dish Name</th><th>Quantity</th><th>Price</th><th>Total</th><th>Action</th></tr></thead>";
    echo "<tbody>";
    $grandTotal = 0;
    foreach ($selectedDishes as $dishId => $quantity) {
        // Fetch dish details from the database
        $sql = "SELECT dish_name, price, quantity FROM alldishes WHERE dish_id = $dishId and quantity > 0";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        $dishName = $row['dish_name'];
        $price = $row['price'];
        $currentQuantity = $row['quantity'];
        $total = $quantity * $price;
        $grandTotal += $total;
        echo "<tr>
                <td>$dishName</td>
                <td>$currentQuantity</td>
                <td>$price</td>
                <td>$total</td>
                <td><button onclick='removeDish($dishId)'>Remove</button></td>
              </tr>";
    }
    echo "<tr class='total'>
            <td colspan='3'>Grand Total</td>
            <td>$grandTotal</td>
            <td></td>
          </tr>";
    echo "</tbody></table>";

    // Button to go back to menu.php
    echo "<a href='menu.php'><button>Back to Menu</button></a>";
} else {
    echo "<p>No dishes selected for checkout.</p>";
}
mysqli_close($conn);
?>

<script>
function updateQuantity(dishId, quantity) {
    // AJAX request to update quantity in session variable
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            // Reload the page to reflect the changes
            location.reload();
        }
    };
    xhr.open("POST", "update_quantity_session.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.send("dish_id=" + dishId + "&change=" + (quantity - <?php echo isset($_SESSION['selected_dishes'][$dishId]) ? $_SESSION['selected_dishes'][$dishId] : 0; ?>));
}

function removeDish(dishId) {
    // AJAX request to remove dish from session variable
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            // Reload the page to reflect the changes
            location.reload();
        }
    };
    xhr.open("POST", "remove_dish_session.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.send("dish_id=" + dishId);
}
</script>

</div>
</body>
</html>