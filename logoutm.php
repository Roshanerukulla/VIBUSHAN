<?php
session_start();
session_destroy(); // Clear the session
header("Location: manager_sigin_reg.html"); // Redirect to the login page
exit;
