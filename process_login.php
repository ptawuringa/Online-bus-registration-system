<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include 'includes/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Check for parent login
    $stmt = $pdo->prepare("SELECT * FROM parents WHERE email = ?");
    $stmt->execute([$email]);
    $parent = $stmt->fetch();

    if ($parent && password_verify($password, $parent['password'])) {
        // Parent login successful
        $_SESSION['user_id'] = $parent['id'];
        $_SESSION['role'] = 'parent';
        header("Location: parent_dashboard.php");
        exit;
    }

    // Check for admin login
    $stmt = $pdo->prepare("SELECT * FROM administrators WHERE email = ?");
    $stmt->execute([$email]);
    $admin = $stmt->fetch();

    if ($admin && password_verify($password, $admin['password'])) {
        // Admin login successful
        $_SESSION['admin_id'] = $admin['id'];
        $_SESSION['role'] = 'admin';
        header("Location: admin_dashboard.php");
        exit;
    }

    // Invalid login
    $_SESSION['error'] = 'Invalid email or password';
    header("Location: login.php");
    exit;
}
?>
