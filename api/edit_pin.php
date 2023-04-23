<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Content-Type: x-www-form-urlencoded, application/json");


$conn = mysqli_connect("localhost", "root", "", "angular");

$json = file_get_contents('php://input'); // $_POST does not work when sending json strings
$array = json_decode($json, true);


// frontend validation is not enough as user can change html from inspect
$userId = isset($array["userId"]) ? $array["userId"] : -1; 
$origPin = isset($array["origPin"]) ? $array["origPin"] : -1;
$pinNum = isset($array["pinNum"]) ? $array["pinNum"] : -1;

//echo $userId, $origPin, $pinNum;

$sql = "SELECT pinnum FROM devices WHERE pinnum='$pinNum'";
$result = mysqli_query($conn, $sql);

if(mysqli_num_rows($result) == 0)
{
    if ($userId >= 1 && $origPin >= 1 && $pinNum >= 1)
    {
        echo $userId, $origPin, $pinNum;
        $sql = "UPDATE devices SET pinnum='$pinNum' WHERE userid='$userId' and pinnum='$origPin'";
        $result = mysqli_query($conn, $sql);
    }
}

mysqli_close($conn);

?>