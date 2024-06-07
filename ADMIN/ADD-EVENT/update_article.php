<?php
include "../../db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $title = $_POST['title'];
    $content = $_POST['content'];
    $new_image = $_FILES['image']['name'];
    $new_video = $_FILES['video']['name'];

    // Fetch current file data
    $sql = "SELECT file FROM events WHERE id = $id";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $files = explode(',', $row['file']);
    $current_image = $files[0];
    $current_video = $files[1];

    // Handle image upload
    if ($new_image) {
        $image = $new_image;
        move_uploaded_file($_FILES['image']['tmp_name'], '../../EVENTS/uploads/' . $image);
    } else {
        $image = $current_image;
    }

    // Handle video upload
    if ($new_video) {
        $video = $new_video;
        move_uploaded_file($_FILES['video']['tmp_name'], '../../EVENTS/uploads/' . $video);
    } else {
        $video = $current_video;
    }

    // Combine file names
    $files = $image . ',' . $video;

    // Update article in the database
    $sql = "UPDATE events SET title = '$title', content = '$content', file = '$files' WHERE id = $id";
    if ($conn->query($sql) === TRUE) {
        header('Location: add-event.php');
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>