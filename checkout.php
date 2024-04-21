<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="refresh" content="10">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu</title>
    <link rel="stylesheet" href="manager_view.css">
    <link rel="icon" href="logo.png" type="image/x-icon">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
       
        .container {
            width: 90%;
            margin: 0 auto;
            overflow: hidden;
        }
        
        .content-container {
            padding: 20px;
            background-color: #f9f9f9;
            margin-top: 80px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .total {
            font-weight: bold;
        }
        button {
            background-color: #333;
            color: #fff;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            border-radius: 5px;
        }
        button:hover {
            background-color: #555;
        }
        a {
            text-decoration: none;
            color: #333;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <header>
        <nav class="navbar">
          <div class="container">
            <img src="logo.png" alt="" class="logo">
            <ul class="nav-links">
              <li><a href="custome_query_page.php">Home</a></li>
              <li><a href="#">About</a></li>
              <li><a href="checkout.php">Your Cart</a></li>
              <li><a href="customer_sign_in.html">Logout</a></li>
            </ul>
          </div>
        </nav>
      </header>

      <div class="container content-container">
        <?php
        session_start(); // Start the session
        include 'dbconnection.php';

        // Get the customer_id from the session
        $customer_id = isset($_SESSION['customer_id']) ? $_SESSION['customer_id'] : 0;
        echo "Selected Dishes: ";

        // Check if the dishes array exists in the session and is not empty
        if (isset($_SESSION['selected_dishes']) && !empty($_SESSION['selected_dishes'])) {
            $selectedDishes = $_SESSION['selected_dishes'];
            
            echo "<table>";
            echo "<thead><tr><th>Dish Name</th><th>Quantity</th><th>Price</th><th>Total</th><th>Action</th></tr></thead>";
            echo "<tbody>";
            $grandTotal = 0;
            $selectedDishes = array_filter($_SESSION['selected_dishes'], function($value) {
                return !is_null($value) && $value !== '';
            });
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

            // Place Order form
            echo "<form id='placeOrderForm' method='post' action='update_customer_info.php'>";
            echo "<input type='hidden' name='placeOrder' value='1'>";
            echo "<input type='hidden' name='customer_id' value='$customer_id'>";
            echo "<button type='submit'>Place Order</button>";
            echo "</form>";
        } else {
            echo "<p>No dishes selected for checkout.</p>";
            echo "<a href='menu.php'><button>Back to Menu</button></a>";
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