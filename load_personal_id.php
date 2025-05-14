<?php
    include 'db.php';
    session_start();
    //驗證用戶是否登入
    if(!isset($_SESSION['user_email'])){
        header("Location: login.php");
        exit;
    }
    $email = $_SESSION['user_email'];
    $sql = "SELECT name, birthdate, username, phone, email, address FROM member WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
    $stmt->close();
?>