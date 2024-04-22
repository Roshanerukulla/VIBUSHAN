<?php
session_start();
if (!isset($_SESSION['manager_email'])) {
    header("Location: manager_sigin_reg.html");
    exit;
}
?>
// Clear the logged_out session variable (optional)
unset($_SESSION['logged_out']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
<meta http-equiv="Pragma" content="no-cache">
<meta http-equiv="Expires" content="0">

    <title>Welcome Manager</title>
    <link rel="stylesheet" href="manager_view.css">
    <link rel="icon" href=
"logo.png"
          type="image/x-icon">
          <script>
            // Disable back button functionality after logging out
            window.addEventListener('beforeunload', function(event) {
                // Clear the session and redirect to the login page
                window.location.href = "logoutm.php";
            });
            
            function checkLoginStatus() {
            <?php
            // Check if the session variable indicating logout exists
            if (isset($_SESSION['logged_out']) && $_SESSION['logged_out']) {
                // Clear the session variable
                unset($_SESSION['logged_out']);
                // Redirect to the login page
                echo 'window.location.href = "manager_sigin_reg.html";';
            }
            ?>
        }

        // Call the function on page load
        checkLoginStatus();

        // Disable back navigation after logout
        window.addEventListener("popstate", function(event) {
            // Revert the history change to prevent back navigation
            history.pushState(null, document.title, location.href);
        });
    
        </script>
</head>
<body>
    <header>
        <nav class="navbar">
          <div class="container">
            <img src="logo.png" alt="" class="logo">
            <ul class="nav-links">
              <li><a href="manager_view.html">Home</a></li>
              <li><a href="#">About</a></li>
              <li><a href="#">Services</a></li>
              <li><a href="logoutm.php">Logout</a></li>
            </ul>
          </div>
        </nav>
      </header>

      <div class="content">
        <!-- Your content here -->
        <p>Hello, What you want to do today!</p>
        <div class="buttons">
          <a href="check_orders.php" class="btn">Check Orders</a>
          <a href="update_menu.php" class="btn">Update Menu</a>
        </div>
      </div>

</body>
</html>