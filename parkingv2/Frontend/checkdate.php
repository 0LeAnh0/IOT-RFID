<?php
// Replace 'YourTableName' with the actual table name in your database
$servername = "localhost";
$username = "root";
$password = "";
$database = "parking";

// Create a connection
$conn = new mysqli($servername, $username, $password, $database);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the current date and time
$currentDateTime = date('Y-m-d H:i:s');

// Calculate the date and time 30 days ago
$thirtyDaysAgo = date('Y-m-d H:i:s', strtotime('-30 days', strtotime($currentDateTime)));

// Update the payment_status to 0 for rows where latest_action_time is over 30 days old
$sql = "UPDATE vehicle_info SET payment_status = 0 WHERE latest_action_time < '$thirtyDaysAgo'";
$result = $conn->query($sql);

if ($result) {
    $updatedRows = $conn->affected_rows;
    echo "Updated $updatedRows cars expired. ";
} else {
    echo "Error updating rows: " . $conn->error;
}

// Close the connection
$conn->close();
?>