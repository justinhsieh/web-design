<?php
    $conn = new mysqli("localhost", "root", "root123456", "group_11");
        if ($conn->connect_error) {
            die("連線失敗：" . $conn->connect_error);
        }
    mysqli_set_charset($conn, "utf8mb4");
?>