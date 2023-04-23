<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Content-Type: x-www-form-urlencoded, application/json");


$conn = mysqli_connect("localhost", "root", "", "angular");

$json = file_get_contents('php://input'); // $_POST does not work when sending json strings
$array = json_decode($json, true);

if(isset($array["uname"]) && isset($array["pw"]))
{
    $uname = htmlspecialchars(stripslashes(trim($array["uname"])));
    $pw = htmlspecialchars(stripslashes(trim($array["pw"])));
    if(!empty($uname) && !empty($pw))
    {
        $sql = "SELECT * FROM users WHERE uname='$uname'";
        
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) === 1) {
            
            $row = mysqli_fetch_assoc($result);
            
            if (password_verify($pw, $row['pw']))
                echo json_encode($row);
            else
                echo "-1";

        }
        else
            echo "-1";
    }
    else
        echo "-1";
}

mysqli_close($conn);
?>