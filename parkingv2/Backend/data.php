<?php
session_start();
require "../includes/db.php";

$api_key_data = 'esp3212345';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $api_key = test_input($_POST["api_key"]);
  if ($api_key_data == $api_key) {
    $RFid = test_input($_POST["id"]);

    $sql = "SELECT * FROM `vehicle_info` WHERE `ID` = '$RFid'";
    if ($result = mysqli_query($con, $sql)) {
      $row = mysqli_fetch_assoc($result);
      $currenttime = new DateTime('now');
      $previoustime = new DateTime($row['InTime']);
      $output = $currenttime->diff($previoustime);
      echo $output->format('%m months %d days %h hours %i minutes %s seconds');


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
  //$_SESSION['RFID']='33333';
  return $data;
}
?>