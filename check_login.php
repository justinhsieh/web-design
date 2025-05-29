<?php  
    session_start();
    include 'config.php';
    header('Content-Type: application/json');

    $account = $_POST['account'] ?? '';
    $pwd = $_POST['pwd'] ?? '';
    $status = "BAD";

    $stmt = $conn->prepare('SELECT * FROM `member` WHERE `username` = ?');
    $stmt->bind_param("s",$account);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    if($row && password_verify($pwd,$row['password'])){
        if($row['role'] === "admin"){
            $status = "ADMIN";
        }else{
            $status = "USER";
        }
        $_SESSION['username'] = $row['username'];
        $_SESSION['id'] = $row['id'];
        $_SESSION['role'] = $row['role'];
    }
    $stmt->close();
    echo json_encode([
        'status' => $status
    ]);
    $conn->close();
?>