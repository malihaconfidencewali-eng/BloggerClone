<?php
// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Database credentials
$host = 'localhost';  
$dbname = 'db3iwjvztnuofx';  
$username = 'uzgpnkt9wxate';  
$password = 'honz3tmme2th';  

// Create PDO instance
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

// Fetch blog to edit
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $pdo->prepare("SELECT * FROM blogs WHERE id = ?");
    $stmt->execute([$id]);
    $blog = $stmt->fetch();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit_blog'])) {
    $title = $_POST['title'];
    $content = $_POST['content'];
    
    // Update blog post in the database
    $stmt = $pdo->prepare("UPDATE blogs SET title = ?, content = ? WHERE id = ?");
    $stmt->execute([$title, $content, $id]);

    echo "Blog post updated successfully!";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Blog</title>
    <style>
        /* Same CSS as in dashboard.php */
    </style>
</head>
<body>
    <div class="container">
        <h2>Edit Blog</h2>
        <form method="POST" action="edit_blog.php?id=<?php echo $blog['id']; ?>">
            <div class="form-group">
                <label for="title">Title:</label>
                <input type="text" name="title" id="title" value="<?php echo htmlspecialchars($blog['title']); ?>" required>
            </div>
            <div class="form-group">
                <label for="content">Content:</label>
                <textarea name="content" id="content" rows="4" required><?php echo htmlspecialchars($blog['content']); ?></textarea>
            </div>
            <div class="form-group">
                <button type="submit" name="edit_blog" class="button">Update Blog</button>
            </div>
        </form>
    </div>
</body>
</html>
