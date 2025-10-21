<?php
// Database Configuration
$host = 'localhost'; // Your database host
$username = 'uzgpnkt9wxate'; // Your database username
$password = 'honz3tmme2th'; // Your database password
$database = 'db3iwjvztnuofx'; // Your database name

// Establishing MySQL Connection
$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}
?>
