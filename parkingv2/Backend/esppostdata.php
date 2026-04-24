<?php
require "../includes/db.php";

$api_key_data = 'esp3212345';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $api_key = test_input($_POST["api_key"]);
  if ($api_key_data == $api_key) {
    $RFid = test_input($_POST["id"]);
    $car = test_input($_POST["car"]);

    $sql = "INSERT INTO `vehicle_info` (`ID`,`RegistrationNumber`) VALUES ('$RFid', '$car')";

    if (mysqli_query($con, $sql)) {
      echo "1";
    } else {
      echo "Error: " . $sql . "<br>" . mysqli_error($con);
    }
    $con->close();
  } else {
    echo "Wrong API Key";
  }
} else {
  echo "no data";
}

function test_input($data)
{
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

?>