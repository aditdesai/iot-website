<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Content-Type: x-www-form-urlencoded, application/json");


$conn = mysqli_connect("localhost", "root", "", "angular");

$json = file_get_contents('php://input'); // $_POST does not work when sending json strings
$array = json_decode($json, true);

if(isset($array["uname"]) && isset($array["pw1"]) && isset($array["pw2"]))
{
    $uname = htmlspecialchars(stripslashes(trim($array["uname"])));
    $pw1 = htmlspecialchars(stripslashes(trim($array["pw1"])));
    $pw2 = htmlspecialchars(stripslashes(trim($array["pw2"])));
    
    if(!empty($uname) && !empty($pw1) && !empty($pw2) && $pw1 == $pw2)
    {
        $pw = password_hash($pw1, PASSWORD_DEFAULT);
        $sql = "INSERT INTO users (uname, pw) VALUES ('$uname', '$pw')";
        
        $result = mysqli_query($conn, $sql);
        
    }
    else
        echo "-1";
    
}


mysqli_close($conn);
?>