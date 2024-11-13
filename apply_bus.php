<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Check if the parent is logged in and parent_id is set
if (!isset($_SESSION['parent_id'])) {
    // Redirect to login page if not logged in
    header("Location: login.php");
    exit();
}

// Now that the session is active, fetch the parent ID
$parent_id = $_SESSION['parent_id'];

// Include the database connection
include('includes/db.php');

try {
    $stmt = $pdo->prepare("SELECT * FROM learners WHERE parent_id = :parent_id");
    $stmt->execute([':parent_id' => $parent_id]);
    $learners = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    // Fetch available bus routes
    $bus_stmt = $pdo->query("SELECT * FROM bus_routes");
    $bus_routes = $bus_stmt->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Apply for Bus Transport</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h1>Apply for Bus Transport</h1>
    
    <form action="process_apply_bus.php" method="POST">
        <div class="form-group mb-3">
            <label for="learner_id">Select Learner:</label>
            <select name="learner_id" class="form-control" required>
                <option value="">Select Learner</option>
                <?php foreach ($learners as $learner): ?>
                    <option value="<?= $learner['id'] ?>"><?= $learner['learner_name'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-group mb-3">
            <label for="bus_route_id">Select Bus Route:</label>
            <select name="bus_route_id" class="form-control" required>
                <option value="">Select Bus Route</option>
                <?php foreach ($bus_routes as $route): ?>
                    <option value="<?= $route['id'] ?>"><?= $route['route_name'] ?> (Capacity: <?= $route['capacity'] ?>)</option>
                <?php endforeach; ?>
            </select>
        </div>

        <input type="hidden" name="year" value="2025">
        
        <button type="submit" class="btn btn-primary">Apply for Bus Transport</button>
    </form>
</div>
</body>
</html>
