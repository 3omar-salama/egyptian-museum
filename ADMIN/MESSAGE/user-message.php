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

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['reply'])) {
    $message_id = $_POST['message_id'];
    $reply = $_POST['reply'];

    // Fetch user's email based on message_id
    $sql = "SELECT user.email FROM contact_us 
            JOIN user ON contact_us.user_id = user.id 
            WHERE contact_us.id = '$message_id'
            ORDER BY contact_us.id DESC";
    $result = $conn->query($sql);
    $user_email = $result->fetch_assoc()['email'];

    // Send reply via email (assuming you have a mail function configured)
    mail($user_email, "Reply from Egyptian Museum", $reply);

    echo "Reply sent successfully";
}

// Fetch messages from the database
$sql = "SELECT contact_us.id, contact_us.message, contact_us.user_id, user.name, user.email, phone.phone 
        FROM contact_us 
        JOIN user ON contact_us.user_id = user.id 
        LEFT JOIN phone ON user.id = phone.user_id
        ORDER BY user.name DESC";
$result = $conn->query($sql);   

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Messages</title>
    <link rel="stylesheet" href="message-style.css">
</head>
<body>
    <header>
        <nav>
            <a href="user-message.php" class="activ">messages</a>
            <a href="../ADD-EVENT/add-event.php">add event</a>
            <a href="../REPORT/monthly_report.php">Report</a>
        </nav>
    </header>
    <section>
        <h2>Messages from Users</h2>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<div class='message'>";
                echo "<p><strong>Name:</strong> " . $row['name'] . "</p>";
                echo "<p><strong>Email:</strong> " . $row['email'] . "</p>";
                echo "<p><strong>Phone:</strong> " . $row['phone'] . "</p>";
                echo "<p><strong>Message:</strong> " . $row['message'] . "</p>";
                echo "<form method='post' action='user-message.php'>";
                echo "<input type='hidden' name='message_id' value='" . $row['id'] . "'>";
                echo "<a class='button' href='mailto:$row[email]'><p>Send Replay</p> </a>";
                echo "<a class='button' href='delete_message.php?id=" . $row['id'] . "' onclick='return confirm(\"Are you sure you want to delete this article?\");'>Delete</a>";
                echo "</form>";
                echo "</div>";
            }
        } else {
            echo "<p>No messages found.</p>";
        }
        $conn->close();
        ?>
    </section>
</body>
</html>
