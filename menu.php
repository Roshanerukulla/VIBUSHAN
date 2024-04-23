<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!-- <meta http-equiv="refresh" content="10"> -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu</title>
    <link rel="stylesheet" href="manager_view.css">
    <link rel="icon" href="logo.png" type="image/x-icon">
    <style>
        .content-container {
            margin-top: 80px; /* Adjust this value to increase/decrease the gap between the navbar and the container */
            padding: 20px;
            background-color: #f9f9f9;
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
        }
        .dish-card {
            width: 300px;
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 10px;
            margin: 10px;
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
            transition: 0.3s;
            text-align: center;
        }
        .dish-card:hover {
            box-shadow: 0 8px 16px 0 rgba(0, 0, 0, 0.2);
        }
        .dish-card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }.filter-buttons {
            padding-top: 70px;
    display: flex;
    justify-content: center;
    margin-bottom: 20px;
}

.filter-buttons a {
    padding: 10px 20px;
    margin: 0 10px;
    border-radius: 20px;
    text-decoration: none;
    color: #fff;
    background-color: #333;
    transition: background-color 0.3s ease;
}

.filter-buttons a.active {
    background-color: #666;
}

.filter-buttons a:hover {
    background-color: #555;
}

        .content-container {
            margin-top: 50px; /* Adjust as needed */
            padding: 20px;
            background-color: #f9f9f9;
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
        }
        .dish-card {
            width: 300px;
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 10px;
            margin: 10px;
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
            transition: 0.3s;
            text-align: center;
        }
        .dish-card:hover {
             -webkit-transform: scale(1.2);
    -ms-transform: scale(1.2);
    transform: scale(1.2);
    transition: 0.4s ;
        }
        .dish-card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }
        #checkoutButton {
            position: fixed;
            top: 80px; /* Adjust as needed */
            right: 20px; /* Adjust as needed */
            z-index: 1000;
            padding: 10px 20px;
            background-color: #333;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
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
              <li><a href="aboutus.html">About</a></li>
              <li><a href="checkout.php">Your Cart</a></li>
              <li><a href="logout.php">Logout</a></li>
            </ul>
          </div>
        </nav>
      </header>

      <div class="filter-buttons">
    <a href="menu.php" <?php if (empty($filter)) echo 'class="active"'; ?>>All</a>
    <a href="menu.php?filter=vegetarian" <?php if ($filter === "vegetarian") echo 'class="active"'; ?>>Vegetarian</a>
    <a href="menu.php?filter=nonvegetarian" <?php if ($filter === "nonvegetarian") echo 'class="active"'; ?>>Non-Vegetarian</a>
</div>



      <div class="container content-container">
      <?php
session_start(); // Start the session
include 'dbconnection.php';

// Retrieve the filter parameter from the URL query string
$filter = isset($_GET['filter']) ? $_GET['filter'] : "";

// Check if the customer ID is set in the session
if (!isset($_SESSION['customer_id'])) {
    echo "Error: Customer ID not found in session.";
    echo "<meta http-equiv='refresh' content='2;url=customer_sign_in.html'>";
    exit;
}

// Retrieve customer_id from the session
$customer_id = $_SESSION['customer_id'];

// Check if the session variable for selected dishes is set
if (!isset($_SESSION['selected_dishes'])) {
    $_SESSION['selected_dishes'] = array();
}

// Filter dishes based on vegetarian or non-vegetarian
$filter = isset($_GET['filter']) ? $_GET['filter'] : "";

// Define the SQL query with conditional filtering
$sql = "SELECT 
            dish_id, 
            dish_name, 
            cuisine, 
            ingredients, 
            veg_or_nonveg, 
            price, 
            0 AS quantity 
        FROM 
            alldishes 
        WHERE 
            available = 'Available'";

// Apply conditional filtering based on the $filter value
if ($filter == "vegetarian") {
    $sql .= " AND veg_or_nonveg = 'Vegetarian'";
} elseif ($filter == "nonvegetarian") {
    $sql .= " AND veg_or_nonveg = 'Non-Vegetarian'";
}

// Execute the SQL query
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $imageFolder = 'foodimages/';
        $image = $row['dish_id'] . ".jpg"; // Assuming the image file name is constructed using dish id
        echo '<div class="dish-card">
                <img src="' . $imageFolder . $image . '" alt="' . $row['dish_name'] . '">
                <h3>' . $row['dish_name'] . '</h3>
                <p>Cuisine: ' . $row['cuisine'] . '</p>
                <p>Ingredients: ' . $row['ingredients'] . '</p>
                <p>Type: ' . $row['veg_or_nonveg'] . '</p>
                <p>Price: ' . $row['price'] . '</p>
                <p>
                    Quantity: <span id="quantity_' . $row['dish_id'] . '">' . $row['quantity'] . '</span>
                    <button onclick="updateQuantity(\'' . $row['dish_id'] . '\', -1)">-</button>
                    <button onclick="updateQuantity(\'' . $row['dish_id'] . '\', 1)">+</button>
                </p>
            </div>';
    }
} else {
    echo "<p>No dishes available</p>";
}

mysqli_close($conn);
?>


<form action="checkout.php" method="post">
    <button type="submit" name="checkoutButton" id="checkoutButton">Checkout</button>
</form>

<script>
    function updateQuantity(dishId, change) {
        // Check if the change will result in a quantity less than 0
        if (parseInt(document.getElementById('quantity_' + dishId).innerText) + change < 0) {
            alert("Error: Quantity cannot go below 0");
            return;
        }

        // Retrieve the customer_id from the session
        var customerId = <?php echo $customer_id; ?>;

        // AJAX request to update quantity and customer_info
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && xhr.status == 200) {
                // Update quantity display
                document.getElementById('quantity_' + dishId).innerText = parseInt(document.getElementById('quantity_' + dishId).innerText) + change;
            }
        };
        xhr.open("POST", "update_customer_info.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.send("dish_id=" + dishId + "&change=" + change + "&customer_id=" + customerId);
    }

    function filterDishes(filter) {
            var dishCards = document.getElementsByClassName("dish-card");
            for (var i = 0; i < dishCards.length; i++) {
                var dishType = dishCards[i].querySelector("p:nth-child(3)").innerText.trim();
                dishType = dishType.replace("Type: ", "");
                if (filter === "all" || dishType.toLowerCase() === filter.toLowerCase()) {
                    dishCards[i].style.display = "block";
                } else {
                    dishCards[i].style.display = "none";
                }
            }
    }
    // Update active state of filter buttons
    var filterLinks = document.querySelectorAll(".filter-buttons a");
            filterLinks.forEach(function(link) {
                link.classList.remove("active");
                if (link.getAttribute("href").includes(filter)) {
                    link.classList.add("active");
                }
            });
        
</script>
</body>
</html>