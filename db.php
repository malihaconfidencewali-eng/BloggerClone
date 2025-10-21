<?php
$host = 'localhost';  // Database host
$dbname = 'db3iwjvztnuofx';  // Database name
$username = 'uzgpnkt9wxate';  // Database username
$password = 'honz3tmme2th';  // Database password

// Enable error reporting for this file as well
error_reporting(E_ALL);
ini_set('display_errors', 1);

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // If there's a database connection error, show it
    die("Connection failed: " . $e->getMessage());
}
?>
