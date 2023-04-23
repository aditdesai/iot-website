<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Content-Type: x-www-form-urlencoded, application/json");


$conn = mysqli_connect("localhost", "root", "", "angular");

$json = file_get_contents('php://input'); // $_POST does not work when sending json strings
$array = json_decode(trim($json), true);

$userId = isset($array["userId"]) ? $array["userId"] : -1; 

if ($userId >= 1)
{

  $sql = "SELECT pinnum, state FROM devices WHERE userid = '$userId'";
  $result = mysqli_query($conn, $sql);

  $arr = array();
  if (mysqli_num_rows($result) > 0) {
      // output data of each row
      while($row = mysqli_fetch_assoc($result)) {
        $arr[$row["pinnum"]] = $row["state"];
      }
  }

  echo json_encode($arr);
}

mysqli_close($conn);

?>