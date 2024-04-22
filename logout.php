<?php
session_start();
session_destroy(); // Clear the session
header("Location: customer_sign_in.html"); // Redirect to the login page
exit;
