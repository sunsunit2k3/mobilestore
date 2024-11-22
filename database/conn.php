<?php
function getDbConnection() {
    $server = "localhost";
    $username = "root";
    $password = "";
    $db = "mobilestore";
    $conn = mysqli_connect($server, $username, $password, $db);
    if (!$conn) {
        die("Kết nối không thành công: " . mysqli_connect_error());
    }
    return $conn;
}
?>