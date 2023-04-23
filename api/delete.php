<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Content-Type: x-www-form-urlencoded, application/json");


$conn = mysqli_connect("localhost", "root", "", "angular");

$json = file_get_contents('php://input'); // $_POST does not work when sending json strings
$array = json_decode($json, true);

$userId = isset($array["userId"]) ? $array["userId"] : -1; 
$pinNum = isset($array["pinNum"]) ? $array["pinNum"] : -1;

if ($userId >= 1 && $pinNum >= 1)
{
    $sql = "DELETE FROM devices WHERE userid='$userId' and pinnum='$pinNum'";
    $result = mysqli_query($conn, $sql);
}

mysqli_close($conn);

?>