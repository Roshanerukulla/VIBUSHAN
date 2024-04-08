<?php
$server = "localhost";
$username = "bshelke";
$password = "Goodluck@123456";
$database = "bshelke_db";


// Create connection
$conn = new mysqli($server, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
else
{ 
	
}

?>