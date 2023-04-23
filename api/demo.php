<?php

$conn = mysqli_connect("localhost", "root", "", "angular");
$pw = password_hash("12345", PASSWORD_DEFAULT);
$sql = "UPDATE users SET pw='$pw' WHERE userid=7";
$result = mysqli_query($conn, $sql);
mysqli_close($conn);
?>