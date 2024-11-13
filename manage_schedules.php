<?php
$conn = new mysqli('localhost', 'root', '', 'bus_registration');

// Add schedule
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $bus_id = $_POST['bus_id'];
    $route_id = $_POST['route_id'];
    $departure_time = $_POST['departure_time'];
    $arrival_time = $_POST['arrival_time'];
    $day_of_week = $_POST['day_of_week'];

    $sql = "INSERT INTO schedules (bus_id, route_id, departure_time, arrival_time, day_of_week)
            VALUES ('$bus_id', '$route_id', '$departure_time', '$arrival_time', '$day_of_week')";

    if ($conn->query($sql) === TRUE) {
        echo "Schedule added successfully!";
    } else {
        echo "Error: " . $conn->error;
    }
}

$buses = $conn->query("SELECT * FROM buses");
$routes = $conn->query("SELECT * FROM routes");
$schedules = $conn->query("SELECT * FROM schedules");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manage Schedules</title>
</head>
<body>
    <h1>Bus Schedule Management</h1>
    <form method="post" action="">
        <label for="bus_id">Bus:</label><br>
        <select id="bus_id" name="bus_id" required>
            <?php while ($bus = $buses->fetch_assoc()): ?>
                <option value="<?= $bus['bus_id'] ?>"><?= $bus['bus_number'] ?></option>
            <?php endwhile; ?>
        </select><br><br>

        <label for="route_id">Route:</label><br>
        <select id="route_id" name="route_id" required>
            <?php while ($route = $routes->fetch_assoc()): ?>
                <option value="<?= $route['route_id'] ?>"><?= $route['route_name'] ?></option>
            <?php endwhile; ?>
        </select><br><br>

        <label for="departure_time">Departure Time:</label><br>
        <input type="time" id="departure_time" name="departure_time" required><br><br>

        <label for="arrival_time">Arrival Time:</label><br>
        <input type="time" id="arrival_time" name="arrival_time" required><br><br>

        <label for="day_of_week">Day of Week:</label><br>
        <input type="text" id="day_of_week" name="day_of_week" required><br><br>

        <input type="submit" value="Add Schedule">
    </form>

    <h2>Current Schedules</h2>
    <table border="1">
        <tr>
            <th>Bus</th>
            <th>Route</th>
            <th>Departure Time</th>
            <th>Arrival Time</th>
            <th>Day of Week</th>
        </tr>
        <?php while ($row = $schedules->fetch_assoc()): ?>
            <tr>
                <td><?= $row['bus_id'] ?></td>
                <td><?= $row['route_id'] ?></td>
                <td><?= $row['departure_time'] ?></td>
                <td><?= $row['arrival_time'] ?></td>
                <td><?= $row['day_of_week'] ?></td>
            </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>
