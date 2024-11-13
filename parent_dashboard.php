<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include 'header.php';
include 'includes/db.php';

// Ensure the user is logged in
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'parent') {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];

// Fetch learners associated with the parent
$stmt = $pdo->prepare("SELECT * FROM learners WHERE parent_id = ?");
$stmt->execute([$user_id]);
$learners = $stmt->fetchAll();
?>

<div class="container mt-5">
    <h2>Welcome to Your Dashboard</h2>

    <h3>Your Learners</h3>
    <ul>
        <?php foreach ($learners as $learner): ?>
            <li><?php echo $learner['learner_name']; ?></li>
        <?php endforeach; ?>
    </ul>

    <a href="add_learner.php" class="btn btn-primary">Add Learner</a>
    <a href="apply_bus.php" class="btn btn-success">Apply for Bus Transport</a>
</div>

<?php include 'footer.php'; ?>
