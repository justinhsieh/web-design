<?php 
    include 'db.php';
    header('Content-Type: application/json');

    $username = $_POST['account'] ?? '';
    $password = $_POST['password'] ?? '';
    $email = $_POST['email'] ?? '';
    $status = "SUCCESS";
    if(($email) && ($password) && ($username)){
        $stmt = $conn->prepare('SELECT COUNT(*) AS total FROM member WHERE email = ? OR username = ?');
        $stmt->bind_param("ss",$email,$username);
        $stmt->execute();
        $result = $stmt->get_result();
        $count = $result->fetch_assoc()['total'];
        if($count > 0){
            $status = "BAD";
        }else{
            $hash = password_hash($password,PASSWORD_DEFAULT);
            $stmt_insert = $conn->prepare('INSERT INTO member (`username`,`password`,`email`)VALUES(?,?,?)');
            $stmt_insert->bind_param("sss",$username,$hash,$email);
            $stmt_insert->execute();
        }
        $stmt->close();
        $stmt_insert->close();
    }
    echo json_encode([
        'status' => $status
    ]);
    $conn->close();
?>