<?php
include '../../db.php';
session_start();
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Admin authentication (ensure admin is logged in)
// if (!isset($_SESSION['admin_id'])) {
//     header('Location: ../ADMIN/admin.php'); // Redirect to admin login page if not logged in
//     exit();
// }

// $admin_id = $_SESSION['admin_id'];

// Get the current month and year
$currentMonth = date('m');
$currentYear = date('Y');

// Query to get monthly data for user messages
$sqlMessages = "SELECT contact_us.id, contact_us.message, user.name, user.email, contact_us.created_at
                FROM contact_us 
                JOIN user ON contact_us.user_id = user.id
                WHERE MONTH(contact_us.created_at) = '$currentMonth' AND YEAR(contact_us.created_at) = '$currentYear'
                ORDER BY contact_us.created_at ASC";
$resultMessages = $conn->query($sqlMessages);

// Query to get monthly data for reservations
$sqlReservations = "SELECT reservations.id, reservations.price, reservations.visit_date, reservations.quantity, reservations.created_at, user.name, user.email
                    FROM reservations
                    JOIN user ON reservations.user_id = user.id
                    WHERE MONTH(reservations.visit_date) = '$currentMonth' AND YEAR(reservations.visit_date) = '$currentYear'
                    ORDER BY reservations.visit_date ASC";
$resultReservations = $conn->query($sqlReservations);

// Query to get monthly data for events
$sqlEvents = "SELECT events.id, events.title, events.content, events.created_at, admin.email
              FROM events
              JOIN admin ON events.admin_id = admin.id
              WHERE MONTH(events.created_at) = '$currentMonth' AND YEAR(events.created_at) = '$currentYear'
              ORDER BY events.created_at ASC";
$resultEvents = $conn->query($sqlEvents);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Report</title>
    <link rel="stylesheet" href="report-style.css">
    <style>
        @media print {
            button {
                display: none;
            }
            nav {
                display: none;
            }
        }
    </style>
</head>
<body>
    <nav>
        <a href="../MESSAGE/user-message.php">Messages</a>
        <a href="../ADD-EVENT/add-event.php">Add Event</a>
        <a href="monthly_report.php" class="activ">Report</a>
    </nav>
    <section>
        <h2>Monthly Report for <?php echo date('F Y'); ?></h2>

        <h3>User Messages</h3>
        <?php
        if ($resultMessages->num_rows > 0) {
            echo "<table>";
            echo "<tr><th>ID</th><th>User Name</th><th>Email</th><th>Message</th><th>Date</th></tr>";
            while ($row = $resultMessages->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['id'] . "</td>";
                echo "<td>" . $row['name'] . "</td>";
                echo "<td>" . $row['email'] . "</td>";
                echo "<td>" . $row['message'] . "</td>";
                echo "<td>" . $row['created_at'] . "</td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "<p>No user messages found for this month.</p>";
        }
        ?>

        <h3>Reservations</h3>
        <?php
        if ($resultReservations->num_rows > 0) {
            echo "<table>";
            echo "<tr><th>ID</th><th>User Name</th><th>Email</th><th>Price</th><th>Visit Date</th><th>Quantity</th><th>Date</th></tr>";
            while ($row = $resultReservations->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['id'] . "</td>";
                echo "<td>" . $row['name'] . "</td>";
                echo "<td>" . $row['email'] . "</td>";
                echo "<td>" . $row['price'] . "</td>";
                echo "<td>" . $row['visit_date'] . "</td>";
                echo "<td>" . $row['quantity'] . "</td>";
                echo "<td>" . $row['created_at'] . "</td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "<p>No reservations found for this month.</p>";
        }
        ?>

        <h3>Events</h3>
        <?php
        if ($resultEvents->num_rows > 0) {
            echo "<table>";
            echo "<tr><th>ID</th><th>Title</th><th>Content</th><th>Admin Email</th><th>Date</th></tr>";
            while ($row = $resultEvents->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['id'] . "</td>";
                echo "<td>" . $row['title'] . "</td>";
                echo "<td>" . $row['content'] . "</td>";
                echo "<td>" . $row['email'] . "</td>";
                echo "<td>" . $row['created_at'] . "</td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "<p>No events found for this month.</p>";
        }
        ?>

        <button onclick="window.print()">Print Report</button>
    </section>
</body>
</html>

<?php
$conn->close();
?>
