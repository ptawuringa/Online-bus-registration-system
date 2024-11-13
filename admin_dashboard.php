<?php
session_start();
include '../header.php';
include '../includes/db.php';

// Ensure the user is logged in as admin
if (!isset($_SESSION['admin_id']) || $_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit;
}

// Fetch bus applications and waiting list
$applications = $pdo->query("SELECT * FROM bus_applications WHERE year = 2025")->fetchAll();
$waiting_list = $pdo->query("SELECT * FROM waiting_list WHERE year = 2025")->fetchAll();
?>

<div class="container mt-5">
    <h2>Admin Dashboard</h2>

    <h3>Bus Applications for 2025</h3>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Learner Name</th>
                <th>Bus Route</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($applications as $application): ?>
                <tr>
                    <td><?php echo $application['learner_name']; ?></td>
                    <td><?php echo $application['bus_route_id']; ?></td>
                    <td><?php echo $application['status']; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <h3>Waiting List for 2025</h3>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Learner Name</th>
                <th>Bus Route</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($waiting_list as $wait): ?>
                <tr>
                    <td><?php echo $wait['learner_name']; ?></td>
                    <td><?php echo $wait['bus_route_id']; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php include '../footer.php'; ?>
