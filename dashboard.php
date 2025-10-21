<?php
// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Database credentials
$host = 'localhost';  // Database host
$dbname = 'db3iwjvztnuofx';  // Database name
$username = 'uzgpnkt9wxate';  // Database username
$password = 'honz3tmme2th';  // Database password

// Create PDO instance
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);  // Enable error reporting for PDO
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

// Handle form submission for adding a new blog post
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_blog'])) {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $image = ''; // You can handle file upload if needed

    // Insert the blog post into the database
    $stmt = $pdo->prepare("INSERT INTO blogs (title, content, image) VALUES (?, ?, ?)");
    $stmt->execute([$title, $content, $image]);

    echo "Blog post added successfully!";
}

// Handle editing a blog post
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit_blog'])) {
    $id = $_POST['id'];
    $title = $_POST['title'];
    $content = $_POST['content'];
    
    // Update the blog post
    $stmt = $pdo->prepare("UPDATE blogs SET title = ?, content = ? WHERE id = ?");
    $stmt->execute([$title, $content, $id]);

    echo "Blog post updated successfully!";
}

// Handle deleting a blog post
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];

    // Delete the blog post from the database
    $stmt = $pdo->prepare("DELETE FROM blogs WHERE id = ?");
    $stmt->execute([$id]);

    echo "Blog post deleted successfully!";
}

// Fetch all blog posts
$stmt = $pdo->query("SELECT * FROM blogs");
$blogs = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <style>
        /* Internal CSS for the dashboard */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 80%;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        h2 {
            color: #333;
        }
        .blog-list {
            list-style: none;
            padding: 0;
        }
        .blog-list li {
            background-color: #e9e9e9;
            margin: 10px 0;
            padding: 10px;
            border-radius: 5px;
        }
        .blog-list li a {
            text-decoration: none;
            color: #333;
        }
        .blog-list li a:hover {
            color: #007bff;
        }
        .button {
            padding: 10px 20px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .button:hover {
            background-color: #218838;
        }
        .form-group {
            margin-bottom: 15px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Dashboard</h2>

        <!-- Add Blog Form -->
        <h3>Add New Blog</h3>
        <form method="POST" action="dashboard.php">
            <div class="form-group">
                <label for="title">Title:</label>
                <input type="text" name="title" id="title" required>
            </div>
            <div class="form-group">
                <label for="content">Content:</label>
                <textarea name="content" id="content" rows="4" required></textarea>
            </div>
            <div class="form-group">
                <button type="submit" name="add_blog" class="button">Add Blog</button>
            </div>
        </form>

        <hr>

        <!-- Displaying Blog Posts -->
        <h3>Existing Blogs</h3>
        <ul class="blog-list">
            <?php foreach ($blogs as $blog): ?>
                <li>
                    <h4><?php echo htmlspecialchars($blog['title']); ?></h4>
                    <p><?php echo htmlspecialchars(substr($blog['content'], 0, 100)); ?>...</p>
                    <a href="edit_blog.php?id=<?php echo $blog['id']; ?>">Edit</a> | 
                    <a href="dashboard.php?delete=<?php echo $blog['id']; ?>" onclick="return confirm('Are you sure you want to delete this blog?')">Delete</a>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</body>
</html>
