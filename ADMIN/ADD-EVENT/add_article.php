<?php
include "../../db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $image = $_FILES['image']['name'];
    $video = $_FILES['video']['name'];
    $files = $image . ',' . $video; // Combine image and video file names
    $admin_id = 1; // Assuming the admin ID is 1 for simplicity

    // Upload image and video files
    move_uploaded_file($_FILES['image']['tmp_name'], '../../uploads/' . $image);
    move_uploaded_file($_FILES['video']['tmp_name'], '../../uploads/' . $video);

    // Insert article into database
    $sql = "INSERT INTO events (title, content, file, admin_id) VALUES ('$title', '$content', '$files', '$admin_id')";
    if ($conn->query($sql) === TRUE) {
        header('Location: add-event.php');
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
