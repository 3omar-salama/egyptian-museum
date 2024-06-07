<?php
include "../../db.php";

// Get the article ID from the URL
$id = $_GET['id'];

// Fetch the article from the database
$sql = "SELECT * FROM events WHERE id = $id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $title = $row['title'];
    $content = $row['content'];
    $files = explode(',', $row['file']);
    $image = $files[0];
    $video = $files[1];
} else {
    echo "Article not found.";
    exit;
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit EVENT</title>
</head>
<body>
    <h2>Edit Article</h2>
    <form action="update_article.php" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        
        <label for="title">Title:</label>
        <input type="text" id="title" name="title" value="<?php echo htmlspecialchars($title); ?>" required><br><br>
        
        <label for="content">Content:</label>
        <textarea id="content" name="content" required><?php echo htmlspecialchars($content); ?></textarea><br><br>
        
        <label for="image">Current Image:</label><br>
        <img src="../../uploads/<?php echo htmlspecialchars($image); ?>" alt="<?php echo htmlspecialchars($title); ?>" style="max-width: 100%; height: auto;"><br><br>
        <label for="image">New Image (optional):</label>
        <input type="file" id="image" name="image" accept="image/*"><br><br>
        
        <label for="video">Current Video:</label><br>
        <video controls style="max-width: 100%; height: auto;">
            <source src="../../uploads/<?php echo htmlspecialchars($video); ?>" type="video/mp4">
            Your browser does not support the video tag.
        </video><br><br>
        <label for="video">New Video (optional):</label>
        <input type="file" id="video" name="video" accept="video/*"><br><br>
        
        <input type="submit" value="Update">
    </form>
</body>
</html>
