<?php
require_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $content = $_POST['content'];

    // Insert blog into database (without image)
    $stmt = $conn->prepare("INSERT INTO blogs (title, content, created_at) VALUES (?, ?, NOW())");
    $stmt->bind_param("ss", $title, $content);

    if ($stmt->execute()) {
        header("Location: index.php");
        exit;
    } else {
        echo "Error adding blog!";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Add Blog</title>
<style>
body {
    font-family: 'Poppins', sans-serif;
    background: #f4f6fa;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
}
form {
    background: #fff;
    padding: 2rem;
    border-radius: 15px;
    box-shadow: 0 6px 18px rgba(0,0,0,0.1);
    width: 400px;
}
h2 {
    text-align: center;
    color: #2563eb;
}
input, textarea {
    width: 100%;
    padding: 10px;
    margin: 8px 0;
    border: 1px solid #ccc;
    border-radius: 6px;
}
button {
    width: 100%;
    background: #2563eb;
    color: white;
    padding: 10px;
    border: none;
    border-radius: 6px;
    font-size: 16px;
    font-weight: 600;
    cursor: pointer;
}
button:hover {
    background: #1d4ed8;
}
a {
    display: block;
    text-align: center;
    margin-top: 1rem;
    text-decoration: none;
    color: #2563eb;
}
</style>
</head>
<body>

<form action="" method="post">
    <h2>Add New Blog</h2>
    <input type="text" name="title" placeholder="Enter blog title" required>
    <textarea name="content" rows="6" placeholder="Write your blog content here..." required></textarea>
    <button type="submit">Add Blog</button>
    <a href="index.php">← Back to Home</a>
</form>

</body>
</html>
