<?php include "../includes/db.php"; ?>

<!DOCTYPE html>
<html>
<head>
    <title>My Blogger</title>
    <style>
        body { font-family: Arial, sans-serif; }
        .blog { border: 1px solid #ddd; padding: 15px; margin: 15px 0; }
        .blog h2 { margin: 0 0 10px; }
        .blog p { color: #555; }
    </style>
</head>
<body>
    <h1>My Blogger</h1>
    <?php
    $stmt = $pdo->query("SELECT * FROM blogs ORDER BY created_at DESC");
    while ($row = $stmt->fetch()) {
        echo "<div class='blog'>
                <h2>" . htmlspecialchars($row['title']) . "</h2>
                <p>By " . htmlspecialchars($row['author']) . "</p>
                <p>" . substr(htmlspecialchars($row['content']), 0, 100) . "...</p>
                <a href='view.php?id=" . $row['id'] . "'>Read More</a>
              </div>";
    }
    ?>
</body>
</html>
