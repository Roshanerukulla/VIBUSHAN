<?php
session_start(); // Start the session

include 'dbconnection.php';

// Check if the dishes array exists in the session and is not empty
if (isset($_SESSION['selected_dishes']) && !empty($_SESSION['selected_dishes'])) {
    $selectedDishes = $_SESSION['selected_dishes'];

    echo "<h2>Checkout</h2>";
    echo "<table>";
    echo "<thead><tr><th>Dish Name</th><th>Quantity</th><th>Price</th><th>Total</th></tr></thead>";
    echo "<tbody>";

    $grandTotal = 0;

    foreach ($selectedDishes as $dishId => $quantity) {
        // Fetch dish details from the database
        $sql = "SELECT dish_name, price FROM alldishes WHERE dish_id = $dishId";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);

        $dishName = $row['dish_name'];
        $price = $row['price'];
        $total = $quantity * $price;
        $grandTotal += $total;

        echo "<tr>
                <td>$dishName</td>
                <td>$quantity</td>
                <td>$price</td>
                <td>$total</td>
            </tr>";
    }

    echo "<tr class='total'>
            <td colspan='3'>Grand Total</td>
            <td>$grandTotal</td>
        </tr>";

    echo "</tbody></table>";
} else {
    echo "<p>No dishes selected for checkout.</p>";
}

mysqli_close($conn);
?>
