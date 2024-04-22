<?php
session_start();
if (!isset($_SESSION['customer_id'])) {
    echo "Error: Customer ID not found in session.";
    echo "<meta http-equiv='refresh' content='2;url=customer_sign_in.html'>";
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
<style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
        }
        .container {
            width: 80%;
            margin: 0 auto;
            padding: 20px;
        }
        
        .content-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-top: 80px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
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
        .back-button {
            display: inline-block;
            background-color: #333;
            color: #fff;
            border: none;
            padding: 10px 20px;
            margin-top: 20px;
            text-decoration: none;
            border-radius: 5px;
        }
        .back-button:hover {
            background-color: #555;
        }
    </style>
<body>
    <header>
        <nav class="navbar">
            <img src="logo.png" alt="" class="smalllogo">
            <ul class="nav-links">
                <li><a href="custome_query_page.php">Home</a></li>
                <li><a href="#">About</a></li>
                <li><a href="#">Contact</a></li>
                <li><a href="logout.php">Logout</a></li>
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
    <a href="custome_query_page.php" class="back-button">Back</a>
    </div>
</body>
</html>
