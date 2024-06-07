<?php
require "../db.php";

// Start session
session_start();

if (isset($_POST["submit"])) {
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Use prepared statement to prevent SQL injection
    $stmt = $conn->prepare("SELECT * FROM admin WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        // Verify password
        if (password_verify($password, $row["password"])) {
            // Password correct, set session variables
            $_SESSION["login"] = true;
            $_SESSION["id"] = $row["id"];
            // Redirect to admin panel
            header("Location: MESSAGE/user-message.php");
            exit(); // Ensure script stops executing after redirect
        } else {
            // Wrong password
            echo "<script>alert('Wrong Password');</script>";
        }
    } else {
        // User not found
        echo "<script>alert('User not found');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Meta tags -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- Favicon -->
    <link rel="icon" href="../Photos/GEM_Logo.png" type="image/x-icon">
    <!-- CSS -->
    <link rel="stylesheet" href="ADstyle.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Briem+Hand:wght@600&family=Kaushan+Script&family=Lugrasimo&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <!-- Animation -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
</head>
<body>
    <img src="../Photos/GEM_Logo.png" alt="">
    <div class="tex">
        <h1>Admin Login</h1><br>
        <p>The Control page for the Grand Egyptian Museum system</p>
    </div>
    <div class="log">
        <form class="" action="" method="post" autocomplete="off">
            <label for="email">Email</label>
            <input type="text" name="email" id="email" required value=""><br>
            <label for="password">Password</label>
            <input type="password" name="password" id="password" required value=""><br>
            <button type="submit" name="submit">Login</button>
        </form>
    </div>
</body>
</html>
