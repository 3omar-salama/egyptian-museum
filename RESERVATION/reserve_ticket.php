<?php
include "../db.php";
ini_set('display_errors', 1);
error_reporting(E_ALL);

session_start();
require 'paypal.php';
require 'config.php';
require '../vendor/autoload.php';

use PayPal\Api\Amount;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $quantity = $_POST['quantity'];
    $type = $_POST['type'];
    $nationality = $_POST['nationality'];
    $visit_date = $_POST['visit_date'];

    // Calculate the ticket price
    if ($nationality == 'Egyptian') {
        if ($type == 'Adult') {
            $price = 50; // Example price for Egyptian Adult
        } elseif ($type == 'Student') {
            $price = 30; // Example price for Egyptian Student
        } else {
            $price = 20; // Example price for Egyptian Child
        }
    } else {
        if ($type == 'Foreigner') {
            $price = 100; // Example price for Foreigner Adult
        } elseif ($type == 'Student') {
            $price = 70; // Example price for Foreigner Student
        } else {
            $price = 50; // Example price for Foreigner Child
        }
    }
    $total = $price * $quantity;

    // Store data in session for later use
    $_SESSION['ticket'] = [
        'name' => $name,
        'email' => $email,
        'quantity' => $quantity,
        'type' => $type,
        'nationality' => $nationality,
        'visit_date' => $visit_date,
        'total' => $total
    ];

    // Insert user information
    $sql = "INSERT INTO user (name, email, type, nationality) VALUES ('$name', '$email', '$type', '$nationality')";
    if ($conn->query($sql) === TRUE) {
        $user_id = $conn->insert_id;

        // Insert reservation
        $sql = "INSERT INTO reservations (price, visit_date, quantity, user_id) VALUES ('$total', '$visit_date', '$quantity', '$user_id')";
        if ($conn->query($sql) === TRUE) {
            $_SESSION['ticket']['reservation_id'] = $conn->insert_id;
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    $conn->close();

    // PayPal payment
    $payer = new Payer();
    $payer->setPaymentMethod("paypal");

    $amount = new Amount();
    $amount->setTotal($total);
    $amount->setCurrency("USD");

    $transaction = new Transaction();
    $transaction->setAmount($amount);
    $transaction->setDescription("Egyptian Museum Ticket");

    $redirectUrls = new RedirectUrls();
    $redirectUrls->setReturnUrl('http://localhost/egyptian-museum/RESERVATION/ticket.php')
        ->setCancelUrl('https://localhost/museum/execute-payment.php?success=false');

    $payment = new Payment();
    $payment->setIntent("sale")
        ->setPayer($payer)
        ->setTransactions([$transaction])
        ->setRedirectUrls($redirectUrls);

    try {
        $payment->create($apiContext);
        header("Location: " . $payment->getApprovalLink());
        exit();
    } catch (Exception $ex) {
        die($ex);
    }
}
?>
