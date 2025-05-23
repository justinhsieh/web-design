<?php
include("db.php");
header('Content-Type: application/json');

$reviewID = $_POST['reviewid'] ?? '';

if ($reviewID) {
    $sql = "DELETE FROM reviews WHERE review_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $reviewID);
    
    if ($stmt->execute()) {
        echo json_encode(["status" => "SUCCESS", "message" => "留言刪除成功"]);
    } else {
        echo json_encode(["status" => "ERROR", "message" => "留言刪除失敗：" . $stmt->error]);
    }
    
    $stmt->close();
} else {
    echo json_encode(["status" => "ERROR", "message" => "留言ID無效"]);
}

$conn->close();
?>