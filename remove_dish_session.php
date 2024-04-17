<?php
session_start(); // Start the session
include 'dbconnection.php';
// Check if the dishes array exists in the session and the dish ID is provided
if (isset($_SESSION['selected_dishes']) && isset($_POST['dish_id'])) {
    $dishId = $_POST['dish_id'];

    // Remove the dish from the session
    if (isset($_SESSION['selected_dishes'][$dishId])) {
        unset($_SESSION['selected_dishes'][$dishId]);
    }
}
?>