<?php
$servername = "localhost";
$username = "omar";
$password = "omar12345";
$dbname = "egyptian_museum";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>