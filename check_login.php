<?php  
    session_start();
    include 'config.php';
    header('Content-Type: application/json');

    $account = $_POST['account'] ?? '';
    $pwd = $_POST['pwd'] ?? '';
    $status = "NOTFOUND";
    $redirect = "index.php";

    $stmt = $conn->prepare('SELECT * FROM `member` WHERE `username` = ?');
    $stmt->bind_param("s",$account);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    if($row && password_verify($pwd,$row['password'])){
        $_SESSION['user_email'] = $row['email'];
        $status = "SUCCESS";
        if($row['role'] === "admin"){
            $redirect = "admin.php";
        }
    }
    $stmt->close();
    echo json_encode([
        'status' => $status,
        'redirect' => $redirect
    ]);
    $conn->close();
?>