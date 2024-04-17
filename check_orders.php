
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
              <li><a href="manager_sigin_reg.html">Logout</a></li>
            </ul>
          </div>
        </nav>
      </header>

      
<div class="container content-container">
    <?php
    include 'dbconnection.php';
    
    $html = "<html><table style='width:100%' border='1px solid black'><tr>
        <th>customer_id</th>
        <th>username</th>
        <th>address</th>
        <th>dish_id</th>
        <th>dish_name</th>
        <th>cuisine</th>
        <th>ingredients</th>
        <th>veg_or_nonveg</th>
        <th>price</th>
        <th>quantity</th>
      </tr>";
    
    $sql = "SELECT dish_id, dish_name, cuisine, ingredients, veg_or_nonveg, price, quantity FROM alldishes WHERE quantity > 0";
    $sql1 = "SELECT customer_id, username, address FROM customers";
    $result = mysqli_query($conn, $sql);
    $result1 = mysqli_query($conn, $sql1);

    if (mysqli_num_rows($result1) > 0) {
        while($row = mysqli_fetch_assoc($result1)) {
            // Assuming the image file name is constructed using dish id
            $html .= "<tr>
                        <td>".$row['customer_id']."</td>
                        <td>".$row['username']."</td>
                        <td>".$row['address']."</td>
                        
                    </tr>";
        }
    }
    else {
        $html .= "<tr><td colspan='6'>No results</td></tr>";
    }
    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            // Assuming the image file name is constructed using dish id
            $html .= "<tr>
                        <td>".$row['dish_id']."</td>
                        <td>".$row['dish_name']."</td>
                        <td>".$row['cuisine']."</td>
                        <td>".$row['ingredients']."</td>
                        <td>".$row['veg_or_nonveg']."</td>
                        <td>".$row['price']."</td>
                        <td>".$row['quantity']."</td>
                        
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