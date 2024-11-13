<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include 'includes/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $learner_id = $_POST['learner_id'];
    $bus_route_id = $_POST['bus_route_id'];
    $year = 2025;

    // Check bus availability
    $stmt = $pdo->prepare("SELECT available_seats FROM bus_routes WHERE id = ?");
    $stmt->execute([$bus_route_id]);
    $bus = $stmt->fetch();

    if ($bus['available_seats'] > 0) {
        // Approve application
        $stmt = $pdo->prepare("INSERT INTO bus_applications (learner_id, bus_route_id, year, status) VALUES (?, ?, ?, 'approved')");
        $stmt->execute([$learner_id, $bus_route_id, $year]);

        // Decrease available seats
        $stmt = $pdo->prepare("UPDATE bus_routes SET available_seats = available_seats - 1 WHERE id = ?");
        $stmt->execute([$bus_route_id]);

        $_SESSION['success'] = 'Application approved. Bus seat confirmed!';
    } else {
        // Add to waiting list
        $stmt = $pdo->prepare("INSERT INTO waiting_list (learner_id, bus_route_id, year) VALUES (?, ?, ?)");
        $stmt->execute([$learner_id, $bus_route_id, $year]);

        $_SESSION['info'] = 'Bus is full. Learner added to waiting list.';
    }

    header("Location: parent_dashboard.php");
    exit;
}
?>
