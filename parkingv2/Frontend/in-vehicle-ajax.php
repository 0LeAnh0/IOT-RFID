<?php
require '../includes/db.php';

$sql = "SELECT * FROM vehicle_info WHERE Status='' ORDER BY InTime DESC";
$result = mysqli_query($con, $sql);
$data = array();
while ($row = mysqli_fetch_array($result)) {
    $data[] = $row;
}

header("Content-Type: application/json");
echo json_encode(array("data" => $data));
?>