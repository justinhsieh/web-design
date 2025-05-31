<?php
include "db.php";

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["order_id"])) {
    $order_id = intval($_POST["order_id"]);

    // 安全刪除訂單（可視需求加上刪除 order_items）
    $sql = "DELETE FROM orders WHERE order_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $order_id);

    if ($stmt->execute()) {
        echo "success";
    } else {
        http_response_code(500);
        echo "刪除失敗：" . $stmt->error;
    }

    $stmt->close();
    $conn->close();
} else {
    http_response_code(400);
    echo "無效的請求";
}
