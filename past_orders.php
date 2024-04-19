<?php
session_start();
if (!isset($_SESSION['customer_id'])) {
    echo "Error: Customer ID not found in session.";
    exit;
}

// Retrieve customer_id from the session
$customer_id = $_SESSION['customer_id'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Query Page</title>
    <link rel="icon" href="logo.png" type="image/x-icon">
    <link rel="stylesheet" href="customer_query_page.css">
</head>
<body>
    <header>
        <nav class="navbar">
            <img src="logo.png" alt="" class="smalllogo">
            <ul class="nav-links">
                <li><a href="#">Home</a></li>
                <li><a href="#">About</a></li>
                <li><a href="#">Contact</a></li>
                <li><a href="customer_sign_in.html">Logout</a></li>
            </ul>
        </nav>
    </header>
    <div class="container">
        <h2>Your Previous Orders <?php echo $_SESSION['customer_id']; ?></h2>
        <div class="container content-container">
    <?php
    include 'dbconnection.php';
    
    $html = "<html><table style='width:100%' border='1px solid black'><tr>
        
        
        <th>dish_name</th>
        <th>quantity_selected</th>
        <th>date</th>
        <th>address</th>
        
      </tr>";
    
    //$sql = "SELECT dish_id, dish_name, cuisine, ingredients, veg_or_nonveg, price, quantity FROM alldishes WHERE quantity > 0";
    $sql = "SELECT ad.dish_name, ci.quantity_selected, ci.date, c.address FROM customer_info ci 
    JOIN customers c ON ci.customer_id = c.customer_id 
    JOIN alldishes ad ON ci.dish_id = ad.dish_id WHERE ci.status = 'Done' AND ci.customer_id = '".$_SESSION['customer_id']."'";

    $result = mysqli_query($conn, $sql);
    

    
    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            // Assuming the image file name is constructed using dish id
            $html .= "<tr>
                        
                        <td>".$row['dish_name']."</td>
                        <td>".$row['quantity_selected']."</td>
                        <td>".$row['date']."</td>
                        <td>".$row['address']."</td>
                
                    </tr>";
        }
    } else {
        $html .= "<tr><td colspan='6'>No results</td></tr>";
    }
    
    $html .= "</table></html>";
    echo $html;
    mysqli_close($conn);
    ?>
    
    
    </script>
    
    </div>
    </div>
</body>
</html>
