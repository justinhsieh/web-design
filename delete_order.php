<?php
include "db.php";

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["order_id"])) {
    $order_id = intval($_POST["order_id"]);

    // 開始交易（可確保刪除成功與否能一起處理）
    $conn->begin_transaction();

    try {
        // 先刪除對應的訂單明細
        $stmt_items = $conn->prepare("DELETE FROM order_items WHERE order_id = ?");
        $stmt_items->bind_param("i", $order_id);
        $stmt_items->execute();
        $stmt_items->close();

        // 再刪除訂單主資料
        $stmt_order = $conn->prepare("DELETE FROM orders WHERE order_id = ?");
        $stmt_order->bind_param("i", $order_id);
        $stmt_order->execute();
        $stmt_order->close();

        // 提交交易
        $conn->commit();
        echo json_encode(["status" => "SUCCESS", "message" => "訂單刪除成功"]);
    } catch (Exception $e) {
        $conn->rollback(); // 發生錯誤就回滾
        echo json_encode(["status" => "ERROR", "message" => "訂單刪除失敗"]);
    }

    $conn->close();
} else {
    echo json_encode(["status" => "ERROR", "message" => "訂單ID無效"]);
}
