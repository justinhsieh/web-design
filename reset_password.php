<?php 
    session_start();
    include 'config.php';
    header('Content-Type: application/json');

    $password = $_POST['password'] ?? '';
    $status = "BAD";
    if($password && isset($_SESSION['verify_email'])){
        $hash = password_hash($password,PASSWORD_DEFAULT);
        $stmt = $conn->prepare('UPDATE member SET `password` = ? WHERE email = ?');
        $stmt->bind_param("ss",$hash,$_SESSION['verify_email']);
        $stmt->execute();
        $stmt->close();
        $status = "SUCCESS";
    }
    echo json_encode([
        'status' => $status
    ]);
    $conn->close();
?>