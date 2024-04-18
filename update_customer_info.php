<?php
session_start();
include 'dbconnection.php';

// Get the dish_id, change, and customer_id from the AJAX request
$dish_id = $_POST['dish_id'];
$change = $_POST['change'];
$customer_id = $_POST['customer_id'];

// Update the quantity in the session variable
if (isset($_SESSION['selected_dishes'][$dish_id])) {
    $_SESSION['selected_dishes'][$dish_id] += $change;
} else {
    $_SESSION['selected_dishes'][$dish_id] = $change;
}

// Check if the user has clicked the "Place Order" button
if (isset($_POST['placeOrder'])) {
    // Get the current date
    $date = date('Y-m-d');

    // Loop through the selected dishes and insert into the customer_info table
    foreach ($_SESSION['selected_dishes'] as $dish_id => $quantity) {
        if ($quantity > 0) {
            $sql = "INSERT INTO customer_info (customer_id, dish_id, quantity_selected, date) VALUES ($customer_id, $dish_id, $quantity, '$date')";
            mysqli_query($conn, $sql);
            sleep(3);
            header("Location: custome_query_page.php");
        }
    }

    // Clear the selected dishes session variable
    unset($_SESSION['selected_dishes']);
}

mysqli_close($conn);
?>