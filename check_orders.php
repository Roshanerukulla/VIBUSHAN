
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
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
        }
        .content-container {
            margin-top: 80px; /* Adjust this value to increase/decrease the gap between the navbar and the container */
            padding: 20px;
            background-color: #f9f9f9;
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        tr:hover {
            background-color: #f5f5f5;
        }
        .no-results {
            text-align: center;
            color: #777;
        }
        .update-button {
            background-color: #4CAF50;
            border: none;
            color: white;
            padding: 8px 16px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 14px;
            margin: 2px 2px;
            cursor: pointer;
            border-radius: 4px;
        }
        .update-button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <header>
        <nav class="navbar">
          <div class="container">
            <img src="logo.png" alt="" class="logo">
            <ul class="nav-links">
              <li><a href="manager_view.php">Home</a></li>
              <li><a href="aboutus.html">About</a></li>
              
              <li><a href="logoutm.php">Logout</a></li>
            </ul>
          </div>
        </nav>
      </header>

      
<div class="container content-container">
    <?php
    include 'dbconnection.php';
    
session_start();
if (!isset($_SESSION['manager_email'])) {
    header("Location: manager_sigin_reg.html");
    exit;
}

    $html = "<html><table style='width:100%' border='1px solid black'><tr>
        
        <th>customer_id</th>
        <th>username</th>
        <th>dish_id</th>
        <th>dish_name</th>
        <th>quantity_selected</th>
        <th>date</th>
        <th>address</th>
        <th>status</th>
        <th>Update Status</th>
      </tr>";
    
    //$sql = "SELECT dish_id, dish_name, cuisine, ingredients, veg_or_nonveg, price, quantity FROM alldishes WHERE quantity > 0";
    $sql = "SELECT ci.customer_id, c.username, ci.dish_id, ad.dish_name, ci.quantity_selected, ci.date, c.address, ci.status FROM customer_info ci 
    JOIN customers c ON ci.customer_id = c.customer_id 
    JOIN alldishes ad ON ci.dish_id = ad.dish_id WHERE ci.status = 'In progress'";

    $result = mysqli_query($conn, $sql);
    

    
    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            // Assuming the image file name is constructed using dish id
            $html .= "<tr>
                        <td>".$row['customer_id']."</td>
                        <td>".$row['username']."</td>
                        <td>".$row['dish_id']."</td>
                        <td>".$row['dish_name']."</td>
                        <td>".$row['quantity_selected']."</td>
                        <td>".$row['date']."</td>
                        <td>".$row['address']."</td>
                        <td>".$row['status']."</td>
                        <td><button onclick='updateStatus(".$row['customer_id'].")'>Mark as Done</button></td>
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
    function updateStatus(customerId) {
    // AJAX request to update status in the database
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            // Reload the page after successful update
            location.reload();
        }
    };
    xhr.open("POST", "update_status.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.send("customer_id=" + customerId);
}
    
    </script>
    
    </div>
</body>
</html>