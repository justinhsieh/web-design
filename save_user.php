<?php
include("db.php"); // 連接資料庫

// 檢查是否是 POST 請求
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // 取得 POST 資料，並防範 SQL Injection
    $name = $conn->real_escape_string($_POST['name']);
    $birth = $conn->real_escape_string($_POST['birth']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // 加密密碼
    $gender = $conn->real_escape_string($_POST['gender']);
    $phone = $conn->real_escape_string($_POST['phone_number']);
    $email = $conn->real_escape_string($_POST['email']);
    $location = $conn->real_escape_string($_POST['location']);
    
    // 檢查 email 是否存在
    $check_sql = "SELECT COUNT(*) AS count FROM member WHERE email = ?";
    $check_stmt = $conn->prepare($check_sql);
    $check_stmt->bind_param("s", $email);
    $check_stmt->execute();
    $check_result = $check_stmt->get_result()->fetch_assoc();
    
    if ($check_result['count'] == 0) {
        // Email 不存在，返回錯誤
        echo "<script>
                alert('找不到該 Email 的會員資料！');
                window.history.back();
              </script>";
        exit;
    }
    
    // 更新資料庫
    $sql = "UPDATE member 
            SET name = ?, birthdate = ?, password = ?, phone = ?, address = ?, gender = ?
            WHERE email = ?";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssss", $name, $birth, $password, $phone, $location, $gender, $email);
    
    // 執行 SQL
    if ($stmt->execute()) {
        // 成功訊息並跳轉
        echo "<script>
                alert('會員資料更新成功！');
                window.location.href = 'personal_id.php'; // 導向到個人資料頁
              </script>";
    } else {
        // 錯誤訊息
        echo "<script>
                alert('發生錯誤：" . $stmt->error . "');
                window.history.back();
              </script>";
    }
    
    // 關閉連線
    $stmt->close();
    $conn->close();
}
?>
