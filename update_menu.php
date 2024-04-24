
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
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
            padding: 8px 16px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 14px;
            margin: 2px 2px;
            cursor: pointer;
            border-radius: 4px;
        }
        .available {
            background-color: #4CAF50;
            border: none;
            color: white;
        }
        .not-available {
            background-color: #FF5733;
            border: none;
            color: white;
        }
    </style>
</head>
<body>
    <header>
        <nav class="navbar">
          <div class="container">
          <a href="home.html">
              <img src="logo.png" alt="" class="logo">
          </a>
            <ul class="nav-links">
              <li><a href="manager_view.php">Home</a></li>
              <li><a href="aboutus.html">About</a></li>
              >
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
    <th>dishname</th>
    <th>cuisine</th>
    <th>ingredients</th>
    <th>veg_or_nonveg</th>
    <th>dish_id</th>
    <th>dish availability</th>
    <th>is_available</th>
  </tr>";

# $sql = "SELECT dish_name, cuisine, ingredients, veg_or_nonveg, dish_id, quantity, is_available FROM vibushan_menu";
$sql = "SELECT dish_name, cuisine, ingredients, veg_or_nonveg, dish_id, available FROM alldishes";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) {
        // Assuming the image file name is constructed using dish id
        $html .= "<tr>
                    <td>".$row['dish_name']."</td>
                    <td>".$row['cuisine']."</td>
                    <td>".$row['ingredients']."</td>
                    <td>".$row['veg_or_nonveg']."</td>
                    <td>".$row['dish_id']."</td>
                    <td>".$row['available']."</td>
                    <td>
                    <span>".$row['is_available']."</span>
                    <button class='update-button not-available' onclick='updateAvailability(\"".$row['dish_id']."\", \"Not Available\")'>Not Available</button>
                    <button class='update-button available' onclick='updateAvailability(\"".$row['dish_id']."\", \"Available\")'>Available</button>

                    
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
function updateAvailability(dishId, availability) {
    // AJAX request to update availability in SQL data
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            // Reload the page after successful update
            location.reload();
        }
    };
    xhr.open("POST", "update_menu_ava.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.send("dish_id=" + dishId + "&availability=" + availability);
}


</script>

</div>
</body>
</html>