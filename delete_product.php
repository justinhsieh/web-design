<?php
include("db.php");
header('Content-Type: application/json');

$prodID = $_POST['pid'] ?? '';

if ($prodID) {
    $sql = "DELETE FROM product WHERE pid = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $prodID);
    
    if ($stmt->execute()) {
        echo json_encode(["status" => "SUCCESS", "message" => "商品刪除成功"]);
    } else {
        echo json_encode(["status" => "ERROR", "message" => "商品刪除失敗：" . $stmt->error]);
    }
    
    $stmt->close();
} else {
    echo json_encode(["status" => "ERROR", "message" => "商品ID無效"]);
}

$conn->close();
?>