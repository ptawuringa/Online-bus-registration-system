<?php
$conn = new mysqli('localhost', 'root', '', 'bus_registration');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $route_name = $_POST['route_name'];
    $start_location = $_POST['start_location'];
    $end_location = $_POST['end_location'];
    $distance = $_POST['distance'];

    $sql = "INSERT INTO routes (route_name, start_location, end_location, distance)
            VALUES ('$route_name', '$start_location', '$end_location', '$distance')";

    if ($conn->query($sql) === TRUE) {
        echo "Route added successfully!";
    } else {
        echo "Error: " . $conn->error;
    }
}

$routes = $conn->query("SELECT * FROM routes");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manage Routes</title>
</head>
<body>
    <h1>Route Management</h1>
    <form method="post" action="">
        <label for="route_name">Route Name:</label><br>
        <input type="text" id="route_name" name="route_name" required><br><br>

        <label for="start_location">Start Location:</label><br>
        <input type="text" id="start_location" name="start_location" required><br><br>

        <label for="end_location">End Location:</label><br>
        <input type="text" id="end_location" name="end_location" required><br><br>

        <label for="distance">Distance (km):</label><br>
        <input type="number" step="0.01" id="distance" name="distance" required><br><br>

        <input type="submit" value="Add Route">
    </form>

    <h2>Existing Routes</h2>
    <table border="1">
        <tr>
            <th>Route Name</th>
            <th>Start Location</th>
            <th>End Location</th>
            <th>Distance (km)</th>
        </tr>
        <?php while ($row = $routes->fetch_assoc()): ?>
            <tr>
                <td><?= $row['route_name'] ?></td>
                <td><?= $row['start_location'] ?></td>
                <td><?= $row['end_location'] ?></td>
                <td><?= $row['distance'] ?></td>
            </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>
