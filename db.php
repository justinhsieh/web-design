<?php
$host = "localhost";
$user = "root";
$password = "root123456";
$dbname = "group_11";
$conn = new mysqli($host, $user, $password, $dbname);
if ($conn->connect_error) {
    die("連線失敗：" . $conn->connect_error);
}
mysqli_set_charset($conn, "utf8mb4");
?>