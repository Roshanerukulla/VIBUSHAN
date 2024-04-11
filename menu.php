
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
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
include 'dbconnection.php';

$html = "<html><table style='width:100%' border='1px solid black'><tr>
    <th>dishname</th>
    <th>cuisine</th>
    <th>ingredients</th>
    <th>veg_or_nonveg</th>
    <th>image</th>
    <th>quantity</th>
  </tr>";

$sql = "SELECT dish_name, cuisine, ingredients, veg_or_nonveg, dish_id, quantity FROM vibushan_menu";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) {
        $image = $row['dish_id'] . ".jpg"; // Assuming the image file name is constructed using dish id
        $html .= "<tr>
                    <td>".$row['dish_name']."</td>
                    <td>".$row['cuisine']."</td>
                    <td>".$row['ingredients']."</td>
                    <td>".$row['veg_or_nonveg']."</td>
                    <td><img src='$image' alt='".$row['dish_name']."' width='200' height='200'></td>
                    <td>
                        <span>".$row['quantity']."</span>
                        <button onclick='updateQuantity(\"".$row['dish_id']."\", -1)'>-</button>
                        <button onclick='updateQuantity(\"".$row['dish_id']."\", 1)'>+</button>
                    </td>
                </tr>";
    }
} else {
    $html .= "<tr><td colspan='6'>No results</td></tr>";
}

$html .= "</table></html>";
echo $html;
mysqli_close($conn);
?>


<script>
function updateQuantity(dishId, change) {
    // AJAX request to update quantity in SQL data
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            // Reload the page after successful update
            location.reload();
        }
    };
    xhr.open("POST", "update_quantity.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.send("dish_id=" + dishId + "&change=" + change);
}


</script>

</div>
</body>
</html>