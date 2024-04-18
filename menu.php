
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="refresh" content="10">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu</title>
    <link rel="stylesheet" href="manager_view.css">
    <link rel="icon" href=
"logo.png"
          type="image/x-icon">
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

// Check if the dishes array exists in the session, if not, initialize it
if (!isset($_SESSION['selected_dishes'])) {
    $_SESSION['selected_dishes'] = array();
}

include 'dbconnection.php';

$html = "<html><table style='width:100%' border='1px solid black'><tr>
    <th>dishname</th>
    <th>cuisine</th>
    <th>ingredients</th>
    <th>veg_or_nonveg</th>
    <th>image</th>
    <th>quantity</th>
    <th>price</th>
</tr>";

$sql = "SELECT dish_id, dish_name, cuisine, ingredients, veg_or_nonveg, price, quantity FROM alldishes WHERE available = 'Available'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) {
        $imageFolder = 'foodimages/';
        $image = $row['dish_id'] . ".jpg"; // Assuming the image file name is constructed using dish id
        $html .= "<tr>
                    <td>".$row['dish_name']."</td>
                    <td>".$row['cuisine']."</td>
                    <td>".$row['ingredients']."</td>
                    <td>".$row['veg_or_nonveg']."</td>
                    <td><img src='" . $imageFolder . $image . "' alt='" . $row['dish_name'] . "' width='200' height='200'></td>
                    <td>
                        <span id='quantity_".$row['dish_id']."'>".$row['quantity']."</span>
                        <button onclick='updateQuantity(\"".$row['dish_id']."\", -1)'>-</button>
                        <button onclick='updateQuantity(\"".$row['dish_id']."\", 1)'>+</button>
                    </td>
                    <td>".$row['price']."</td>
                </tr>";
    }
} else {
    $html .= "<tr><td colspan='7'>No dishes available</td></tr>";
}

$html .= "</table>";

// Checkout button
$html .= "<form action='checkout.php' method='post'>";
$html .= "<button type='submit' name='checkoutButton' id='checkoutButton'>Checkout</button>";
$html .= "</form>";

$html .= "</html>";
echo $html;
mysqli_close($conn);
?>

<script>
function updateQuantity(dishId, change) {
    // Check if the change will result in a quantity less than 0
    if(parseInt(document.getElementById('quantity_' + dishId).innerText) + change < 0) {
        alert("Error: Quantity cannot go below 0");
        return;
    }

    // AJAX request to update quantity in session variable
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            // Update quantity display
            document.getElementById('quantity_' + dishId).innerText = parseInt(document.getElementById('quantity_' + dishId).innerText) + change;
        }
    };
    xhr.open("POST", "update_quantity_session.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.send("dish_id=" + dishId + "&change=" + change);
}
</script>

</div>
</body>
</html>