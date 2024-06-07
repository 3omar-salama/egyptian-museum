<?php
include "../db.php";
$password = '123';
$email = 'team@three';
$hashed_password = password_hash($password, PASSWORD_DEFAULT);
// Insert reservation
        $sql = "INSERT INTO admin (password, email) VALUES ('$hashed_password', '$email')";
        if ($conn->query($sql) === TRUE) {
            echo "Ticket booked successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    $conn->close();