<?php
// Set session parameters before session_start()
ini_set('session.gc_maxlifetime', 3600); // 1 hour
ini_set('session.cookie_lifetime', 3600); // 1 hour

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Ensure the user is logged in and is a parent
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'parent') {
    header("Location: login.php");
    exit;
}

// Fetch the parent ID from session
$parent_id = $_SESSION['user_id'];

// Include the database connection
include('includes/db.php');

try {
    // Fetch learners associated with this parent
    $stmt = $pdo->prepare("SELECT * FROM learners WHERE parent_id = :parent_id");
    $stmt->execute([':parent_id' => $parent_id]);
    $learners = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Fetch available bus routes
    $bus_stmt = $pdo->query("SELECT * FROM bus_routes");
    $bus_routes = $bus_stmt->fetchAll(PDO::FETCH_ASSOC);

    // Handle form submission
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Retrieve form data
        $learner_id = $_POST['learner_id'] ?? null;
        $bus_route_id = $_POST['bus_route_id'] ?? null;
        $year = $_POST['year'] ?? 2025;

        // Validate input
        if ($learner_id && $bus_route_id) {
            // Insert the application into the database
            $apply_stmt = $pdo->prepare("INSERT INTO bus_applications (learner_id, bus_route_id, year) VALUES (:learner_id, :bus_route_id, :year)");
            $apply_stmt->execute([
                ':learner_id' => $learner_id,
                ':bus_route_id' => $bus_route_id,
                ':year' => $year
            ]);
            echo "<div class='alert alert-success'>Bus transport application submitted successfully!</div>";
        } else {
            echo "<div class='alert alert-danger'>Please select both a learner and a bus route.</div>";
        }
    }

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

    <form action="apply_bus.php" method="POST">
        <div class="form-group mb-3">
            <label for="learner_id">Select Learner:</label>
            <select name="learner_id" class="form-control" required>
                <option value="">Select Learner</option>
                <?php foreach ($learners as $learner): ?>
                    <option value="<?= htmlspecialchars($learner['id']) ?>"><?= htmlspecialchars($learner['learner_name']) ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-group mb-3">
            <label for="bus_route_id">Select Bus Route:</label>
            <select name="bus_route_id" class="form-control" required>
                <option value="">Select Bus Route</option>
                <?php foreach ($bus_routes as $route): ?>
                    <option value="<?= htmlspecialchars($route['id']) ?>"><?= htmlspecialchars($route['route_name']) ?> (Capacity: <?= htmlspecialchars($route['capacity']) ?>)</option>
                <?php endforeach; ?>
            </select>
        </div>

        <input type="hidden" name="year" value="2025">
        
        <button type="submit" class="btn btn-primary">Apply for Bus Transport</button>
    </form>
</div>
</body>
</html>

