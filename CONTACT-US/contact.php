<?php
include '../db.php';
ini_set('display_errors', 1);
error_reporting(E_ALL);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $message = $_POST['message'];

    // Insert user information
    $sql = "INSERT INTO user (name, email) VALUES ('$name', '$email')";
    if ($conn->query($sql) === TRUE) {
        $user_id = $conn->insert_id;

        // Insert phone number
        $sql = "INSERT INTO phone (user_id, phone) VALUES ('$user_id', '$phone')";
        if ($conn->query($sql) === TRUE) {
            // Insert message
            $sql = "INSERT INTO contact_us (message, user_id) VALUES ('$message', '$user_id')";
            if ($conn->query($sql) === TRUE) {
                echo "Message sent successfully";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
