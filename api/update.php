<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Content-Type: x-www-form-urlencoded, application/json");



$conn = mysqli_connect("localhost", "root", "", "angular");

$json = file_get_contents('php://input'); // $_POST does not work when sending json strings
$array = json_decode($json, true);


// frontend validation is not enough as user can change html from inspect
$userId = isset($array["userId"]) ? $array["userId"] : -1; 
$pinNum = isset($array["pinNum"]) ? $array["pinNum"] : -1;
$state = isset($array["state"]) ? $array["state"] : '';


if ($userId >= 1 && $pinNum >= 1)
{
    $sql = "SELECT * FROM devices WHERE userid = '$userId' and pinnum = '$pinNum'";
    $result = mysqli_query($conn, $sql);
    $rows = mysqli_num_rows($result);

    if ($rows == 0)
    {
        if ($state == "ON")
            $sql = "INSERT INTO devices (userid, pinnum, state) VALUES ('$userId', '$pinNum', 1)";
        if ($state == "OFF")
            $sql = "INSERT INTO devices (userid, pinnum, state) VALUES ('$userId', '$pinNum', 0)";
    }
    else
    {
        if ($state == "ON")
            $sql = "UPDATE devices SET state=1 WHERE userid = '$userId' and pinnum = '$pinNum'";
        if ($state == "OFF")
            $sql = "UPDATE devices SET state=0 WHERE userid = '$userId' and pinnum = '$pinNum'";
    }



    $result = mysqli_query($conn, $sql);
}

mysqli_close($conn);

?>