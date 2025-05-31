<?php
include("db.php");
header('Content-Type: application/json');

$subscriberID = $_POST['id'] ?? '';

if ($subscriberID) {
    $sql = "DELETE FROM subscriber WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $subscriberID);
    
    if ($stmt->execute()) {
        echo json_encode(["status" => "SUCCESS", "message" => "訂閱者刪除成功"]);
    } else {
        echo json_encode(["status" => "ERROR", "message" => "訂閱者刪除失敗：" . $stmt->error]);
    }
    
    $stmt->close();
} else {
    echo json_encode(["status" => "ERROR", "message" => "訂閱者ID無效"]);
}

$conn->close();
