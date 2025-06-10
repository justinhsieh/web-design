<?php
    session_start();
    include'db.php'; 
    header('Content-Type: application/json');

    $status = "BAD";
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $email = $_POST['email']?? '';
        if($email){
            $stmt = $conn->prepare("SELECT COUNT(*) AS total FROM `member` WHERE `email` = ?");
            $stmt->bind_param("s",$email);
            $stmt->execute();
            $result = $stmt->get_result();
            $count = $result->fetch_assoc()['total'];
            if($count > 0){
                $code = substr(str_shuffle('ABCDEFGHJKLMNPQRSTUVWXYZ23456789'), 0, 8); //8位數驗證碼

                $_SESSION['verify_email'] = $email;
                $_SESSION['verify_code'] = $code;
                $_SESSION['verify_time'] = time();
                
                $to = $email; // 收件者
                $subject = "[3C用品店]以下是驗證碼用來重置密碼"; // 主旨
                $verificationCode = $code;  // 驗證碼
                $message = "您好，您的驗證碼是：$verificationCode"; // 信件內容
                $headers = "From:3C用品店<S1254010@gm.ncue.edu.tw>";
                if (mail($to, $subject, $message, $headers)) {
                    $status = "OK";
                } else {
                    $status = "WRONG";
                }
            }
            $stmt->close();
        }
    }
    echo json_encode([
        'status' => $status
    ]);
    $conn->close();
?>