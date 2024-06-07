<?php
include "../db.php";
ini_set('display_errors', 1);
error_reporting(E_ALL);

session_start();

if (!isset($_SESSION['ticket'])) {
    echo "No ticket found.";
    exit();
}

$ticket = $_SESSION['ticket'];
$name = htmlspecialchars($ticket['name']);
$email = htmlspecialchars($ticket['email']);
$type = htmlspecialchars($ticket['type']);
$quantity = htmlspecialchars($ticket['quantity']);
$visit_date = htmlspecialchars($ticket['visit_date']);
$total = htmlspecialchars($ticket['total']);
$reservation_id = htmlspecialchars($ticket['reservation_id']);

// Generate QR code data (could be a URL or reservation ID, etc.)
// For this example, we'll just use the reservation details
$qr_data = urlencode("Name: $name, Type: $type, Date: $visit_date, Quantity: $quantity, ID: $reservation_id");
$qr_code_url = "https://api.qrserver.com/v1/create-qr-code/?data=$qr_data&size=150x150";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ticket</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        .ticket {
            border: 2px solid #000;
            padding: 20px;
            width: 300px;
            margin: 0 auto;
            text-align: center;
        }
        .qr-code {
            margin-top: 20px;
        }
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
    <h1>Your Ticket</h1>
    <div class="ticket">
        <p><strong>Name:</strong> <?php echo $name; ?></p>
        <p><strong>Email:</strong> <?php echo $email; ?></p>
        <p><strong>Type:</strong> <?php echo $type; ?></p>
        <p><strong>Quantity:</strong> <?php echo $quantity; ?></p>
        <p><strong>Visit Date:</strong> <?php echo $visit_date; ?></p>
        <p><strong>Total:</strong> $<?php echo $total; ?></p>
        <div class="qr-code">
            <img src="<?php echo $qr_code_url; ?>" alt="QR Code">
        </div>
    </div>
    <br>

    <button onclick="window.print()">Print Ticket</button>
</body>
</html>
