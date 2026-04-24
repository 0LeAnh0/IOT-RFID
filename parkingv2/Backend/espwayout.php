<?php
session_start();
require "../includes/db.php";


$api_key_data = 'esp3212345';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $api_key = test_input($_POST["api_key"]);
  if ($api_key_data == $api_key) {
    $RFid = test_input($_POST["id"]);

    $car = test_input($_POST["car"]);
    $sql = "SELECT * FROM `vehicle_info` WHERE `ID` = '$RFid'";
    if ($result = mysqli_query($con, $sql)) {
      if (mysqli_num_rows($result) > 0) {
        $_SESSION['RFID'] = '33333';
        $row = mysqli_fetch_array($result);

        $_SESSION['RFID'] = '33333';
        if ($row['ID'] == $RFid && $row['RegistrationNumber'] == $car) {
          $currenttime = new DateTime('now', new DateTimeZone('Asia/Ho_Chi_Minh'));
          $previoustime = new DateTime('2023-5-9 12:22:12');
          $output = $currenttime->diff($previoustime);
          //echo $output->format('%m months %d days %h hours %i minutes %s seconds');
          if ($output->format('%m') == 0) {
            if ($output->format('%d') == 0) {
              echo 'true ' . $output->format('%h hours %i minutes %s seconds');
            } else {
              echo 'true ' . $output->format('%d days %h hours %i minutes %s seconds');
            }
          } else {
            echo 'true ' . $output->format('%m months %d days %h hours %i minutes %s seconds');
          }

          //echo 'true ' . $output->format('%m months %d days %h hours %i minutes %s seconds');    
        } else {
          //echo "Error: " . $sql . "<br>" . mysqli_error($con);
          $response = false;
          header('Content-Type: application/json');
          echo json_encode($response);
        }

      } else {
        $response = false;
        header('Content-Type: application/json');
        echo json_encode($response);
      }

    } else {
      echo "false";
    }

    $con->close();
  } else {
    echo "Wrong API Key";
  }

} else {

  var_dump($_SESSION["RFID"]);
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