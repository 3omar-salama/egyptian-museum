<?php
include "../../db.php";

// Check if an article ID is provided
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Fetch the article to delete associated image and video files
    $sql = "SELECT file FROM events WHERE id = $id";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $files = explode(',', $row['file']);
        $image = $files[0];
        $video = $files[1];

        // Delete image and video files from the uploads directory
        if (file_exists('../../uploads/' . $image)) {
            unlink('../../uploads/' . $image);
        }
        if (file_exists('../../uploads/' . $video)) {
            unlink('../../uploads/' . $video);
        }

        // Delete the article from the database
        $sql = "DELETE FROM events WHERE id = $id";
        if ($conn->query($sql) === TRUE) {
            header('Location: add-event.php');
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "Article not found.";
    }

    $conn->close();
} else {
    echo "Invalid article ID.";
}
?>