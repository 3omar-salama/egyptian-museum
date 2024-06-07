<?php
include '../../db.php';
session_start();
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Admin authentication (ensure admin is logged in)
// if (!isset($_SESSION['admin_id'])) {
//     header('Location: ../../ADMIN/admin.php'); // Redirect to admin login page if not logged in
//     exit();
// }

// $admin_id = $_SESSION['admin_id'];

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    $message_id = $_GET['id'];

    // Start transaction
    $conn->begin_transaction();

    try {
        // Fetch user ID based on message ID
        $sql = "SELECT user_id FROM contact_us WHERE id = '$message_id'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $user_id = $result->fetch_assoc()['user_id'];

            // Delete phone entry associated with the user
            $sql = "DELETE FROM phone WHERE user_id = '$user_id'";
            $conn->query($sql);

            // Delete message from the contact_us table
            $sql = "DELETE FROM contact_us WHERE id = '$message_id'";
            $conn->query($sql);

            // Delete user from the user table
            $sql = "DELETE FROM user WHERE id = '$user_id'";
            $conn->query($sql);

            // Commit transaction
            $conn->commit();

            echo "Message and user deleted successfully";
        } else {
            echo "No user found for the given message ID.";
        }
    } catch (Exception $e) {
        // Rollback transaction in case of error
        $conn->rollback();
        echo "Error: " . $conn->error;
    }

    $conn->close();
    header('Location: user-message.php'); // Redirect back to the messages page
    exit();
} else {
    echo "Invalid request";
}
?>
