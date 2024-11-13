<?php
include 'db.php';

$route_id = $_GET['route_id'];

// Fetch pick-up points
$pickup_points = $conn->query("SELECT * FROM pickup_points WHERE route_id = $route_id");
$dropoff_points = $conn->query("SELECT * FROM dropoff_points WHERE route_id = $route_id");

echo '<option value="">Select Pick-up Point</option>';
while ($pickup = $pickup_points->fetch_assoc()) {
    echo '<option value="' . $pickup['point_id'] . '">' . $pickup['point_name'] . ' (' . $pickup['point_time'] . ')</option>';
}

echo '<option value="">Select Drop-off Point</option>';
while ($dropoff = $dropoff_points->fetch_assoc()) {
    echo '<option value="' . $dropoff['point_id'] . '">' . $dropoff['point_name'] . ' (' . $dropoff['point_time'] . ')</option>';
}
?>
