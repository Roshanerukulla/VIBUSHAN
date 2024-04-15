<?php
// Include database connection file
include 'dbconnection.php';

// Query to fetch all dishes from the database
$sql = "SELECT * FROM alldishes";
$result = $conn->query($sql);

// Check if there are any dishes
if ($result->num_rows > 0) {
    // Output the dishes in a grid view
    echo '<div class="grid-container">';
    while ($row = $result->fetch_assoc()) {
        echo '<div class="grid-item">';
        echo '<img src="' . $row['image'] . '" alt="' . $row['dish_name'] . '">';
        echo '<h3>' . $row['dish_name'] . '</h3>';
        echo '<p>' . $row['cuisine'] . '</p>';
        echo '<p>' . $row['ingredients'] . '</p>';
        echo '<p>' . $row['veg_or_nonveg'] . '</p>';
        echo '<p>$' . $row['price'] . '</p>';
        echo '<p>' . $row['available'] . '</p>';
        echo '</div>';
    }
    echo '</div>';
} else {
    // If no dishes are found
    echo "No dishes found";
}

// Close the database connection
$conn->close();
?>
