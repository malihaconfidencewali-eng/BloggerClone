<?php
include "../includes/db.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Delete the blog
    $stmt = $pdo->prepare("DELETE FROM blogs WHERE id = ?");
    $stmt->execute([$id]);

    echo "<p>Blog deleted successfully! <a href='home.php'>Go back</a></p>";
}
?>
