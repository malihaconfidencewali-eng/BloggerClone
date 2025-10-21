<?php
// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Load configuration
$configFile = 'config.php';
if (!file_exists($configFile)) {
    die("Error: config.php file missing!");
}
require_once $configFile;

// Get blog ID
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("Invalid Blog ID!");
}

$id = intval($_GET['id']);
$stmt = $conn->prepare("SELECT * FROM blogs WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$blog = $result->fetch_assoc();

if (!$blog) {
    die("Blog not found!");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?= htmlspecialchars($blog['title']) ?> - BloggerClone</title>
<style>
:root {
    --primary: #2563eb;
    --accent: #e74c3c;
    --bg: #f4f6fa;
    --card: #ffffff;
    --text: #1e293b;
    --text-light: #6b7280;
    --shadow: 0 6px 18px rgba(0,0,0,0.08);
}

body {
    font-family: 'Poppins', sans-serif;
    background: var(--bg);
    margin: 0;
    color: var(--text);
}

.container {
    max-width: 900px;
    margin: 3rem auto;
    background: var(--card);
    border-radius: 15px;
    box-shadow: var(--shadow);
    padding: 3rem;
}

h1 {
    color: var(--primary);
    font-size: 2.5rem;
    margin-bottom: 1rem;
    line-height: 1.3;
}

p {
    font-size: 1.1rem;
    color: var(--text-light);
    line-height: 1.8;
}

.back-btn {
    display: inline-block;
    background: var(--accent);
    color: white;
    padding: 0.8rem 1.8rem;
    border-radius: 50px;
    text-decoration: none;
    font-weight: 600;
    margin-top: 2rem;
    transition: 0.3s;
}

.back-btn:hover {
    background: #c0392b;
    transform: scale(1.05);
}

footer {
    text-align: center;
    padding: 2rem;
    background: #1e293b;
    color: white;
    margin-top: 3rem;
}
</style>
</head>
<body>

<div class="container">
    <h1><?= htmlspecialchars($blog['title']) ?></h1>
    <p><?= nl2br(htmlspecialchars($blog['content'])) ?></p>
    <a href="index.php" class="back-btn">← Back to Home</a>
</div>

<footer>
    © <?= date("Y") ?> BloggerClone — Made with ❤️ in Pakistan
</footer>

</body>
</html>
