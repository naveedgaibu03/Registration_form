<?php
// Database configuration
$db_host = "localhost"; // Hostname of my MySQL server
$db_user = "root"; // MySQL username
$db_password = "PHW#84#jeor"; // MySQL password
$db_name = "user_registration"; // Name of my MySQL database

// Create a database connection
$connection = new mysqli($db_host, $db_user, $db_password, $db_name);

// Check the connection
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

// Set character set to UTF-8 (if needed)
if (!$connection->set_charset("utf8")) {
    printf("Error loading character set utf8: %s\n", $connection->error);
    exit();
}
?>
