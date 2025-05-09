<?php include'config.php';
    header('Content-Type: application/json');

    $email = $_POST['email'] ?? '';
    $status = "BAD";
    if($email){
        $stmt = $conn->prepare('SELECT COUNT(*) AS total FROM subscriber WHERE email = ?');
        $stmt->bind_param("s",$email);
        $stmt->execute();
        $result = $stmt->get_result();
        $count = $result->fetch_assoc()['total'];
        if($count > 0){
            $status = "EXIST";
        }else{
            $stmt_insert = $conn->prepare('INSERT INTO subscriber (email) VALUES(?)');
            $stmt_insert->bind_param("s",$email);
            $stmt_insert->execute();
            $stmt_insert->close();
            $status = "OK";
        }
        $stmt->close();
    }
    echo json_encode([
        'status' => $status
    ]);
    $conn->close();
?>