<?php  
    include 'config.php';
    header('Content-Type: application/json');

    $account = $_POST['account'] ?? '';
    $pwd = $_POST['pwd'] ?? '';
    $status = "NOTFOUND";

    $stmt = $conn->prepare('SELECT * FROM `member` WHERE `username` = ?');
    $stmt->bind_param("s",$account);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    if($row && password_verify($pwd,$row['password'])){
        $status = "SUCCESS";
    }
    $stmt->close();
    echo json_encode([
        'status' => $status
    ]);
    $conn->close();
?>