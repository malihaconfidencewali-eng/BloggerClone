<?php
// Load configuration
require_once 'config.php';

// Fetch blogs from database
$query = "SELECT * FROM blogs ORDER BY created_at DESC";
$result = $conn->query($query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>BloggerClone - Home</title>
<style>
:root {
    --primary: #2563eb;
    --accent: #e74c3c;
    --bg: #f4f6fa;
    --card: #ffffff;
    --text: #1e293b;
    --shadow: 0 6px 18px rgba(0,0,0,0.08);
}

body {
    font-family: 'Poppins', sans-serif;
    background: var(--bg);
    margin: 0;
    color: var(--text);
}

header {
    background: var(--primary);
    color: white;
    padding: 1.2rem 2rem;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

header h1 {
    font-size: 1.8rem;
    margin: 0;
}

.add-btn {
    background: var(--accent);
    color: white;
    padding: 0.7rem 1.5rem;
    text-decoration: none;
    border-radius: 8px;
    font-weight: 600;
    transition: 0.3s;
}

.add-btn:hover {
    background: #c0392b;
}

.container {
    max-width: 900px;
    margin: 2rem auto;
    padding: 0 1rem;
}

.blog-card {
    background: var(--card);
    border-radius: 15px;
    box-shadow: var(--shadow);
    padding: 2rem;
    margin-bottom: 2rem;
    transition: transform 0.3s;
}

.blog-card:hover {
    transform: translateY(-5px);
}

.blog-card h2 {
    color: var(--primary);
    margin-bottom: 0.8rem;
}

.blog-card p {
    color: #6b7280;
    line-height: 1.6;
}

.read-btn {
    display: inline-block;
    margin-top: 1rem;
    background: var(--primary);
    color: white;
    padding: 0.6rem 1.4rem;
    text-decoration: none;
    border-radius: 6px;
    font-weight: 500;
    transition: 0.3s;
}

.read-btn:hover {
    background: #1d4ed8;
}
</style>
</head>
<body>

<header>
    <h1>BloggerClone 📝</h1>
    <a href="add_blog.php" class="add-btn">+ Add Blog</a>
</header>

<div class="container">
    <?php while ($row = $result->fetch_assoc()): ?>
    <div class="blog-card">
        <h2><?= htmlspecialchars($row['title']) ?></h2>
        <p><?= nl2br(substr(htmlspecialchars($row['content']), 0, 200)) ?>...</p>
        <a href="view_blog.php?id=<?= $row['id'] ?>" class="read-btn">Read More</a>
    </div>
    <?php endwhile; ?>
</div>

</body>
</html>
