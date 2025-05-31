<?php
session_start();
require 'db.php';

if (!isset($_SESSION['id'])) {
    http_response_code(403);
    echo "未登入";
    exit;
}

$user_id = $_SESSION['user_id'];
$pid = $_POST['pid'] ?? null;
$quantity = $_POST['quantity'] ?? null;
$color = $_POST['color'] ?? null;

if ($pid && is_numeric($quantity) && $quantity > 0) {
    if ($color) {
        // 更新數量與顏色
        $stmt = $conn->prepare("UPDATE shoppingcart SET quantity = ?, color = ?, update_at = NOW() WHERE user_id = ? AND product_id = ?");
        $stmt->bind_param("ssii", $quantity, $color, $user_id, $pid);
    } else {
        // 僅更新數量
        $stmt = $conn->prepare("UPDATE shoppingcart SET quantity = ?, update_at = NOW() WHERE user_id = ? AND product_id = ?");
        $stmt->bind_param("iii", $quantity, $user_id, $pid);
    }
    $stmt->execute();
    echo "success";
} else {
    http_response_code(400);
    echo "資料錯誤";
}
?>
