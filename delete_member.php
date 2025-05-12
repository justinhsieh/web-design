<?php
include("db.php");
header('Content-Type: application/json');

$customerID = $_POST['id'] ?? '';

if ($customerID) {
    $sql = "DELETE FROM member WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $customerID);
    
    if ($stmt->execute()) {
        echo json_encode(["status" => "SUCCESS", "message" => "會員刪除成功"]);
    } else {
        echo json_encode(["status" => "ERROR", "message" => "會員刪除失敗：" . $stmt->error]);
    }
    
    $stmt->close();
} else {
    echo json_encode(["status" => "ERROR", "message" => "會員ID無效"]);
}

$conn->close();
