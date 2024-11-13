<?php
include 'includes/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $phone_number = $_POST['phone_number'];

    // Insert into the database
    $stmt = $pdo->prepare("INSERT INTO parents (username, email, password, phone_number) VALUES (?, ?, ?, ?)");
    $stmt->execute([$username, $email, $password, $phone_number]);

    $_SESSION['success'] = 'Registration successful. You can now login.';
    header("Location: login.php");
    exit;
}
?>
