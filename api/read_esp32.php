<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json;");



$conn = mysqli_connect("localhost", "root", "", "angular");

if(isset($_GET["userId"]))
{
  $userId = $_GET["userId"];
  $sql = "SELECT pinnum, state FROM devices WHERE userid='$userId'";

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