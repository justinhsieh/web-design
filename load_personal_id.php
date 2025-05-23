<?php
    include 'db.php';
    session_start();
    //驗證用戶是否登入
    if(!isset($_SESSION['username'])){
        header("Location: login.php");
        exit;
    }
    $username = $_SESSION['username'];
    $user = [];
    if($username){
        $sql = "SELECT name, birthdate, username, phone, email, address, role, gender FROM member WHERE username = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();
        $stmt->close();
    }
?>