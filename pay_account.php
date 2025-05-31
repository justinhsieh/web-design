<?php
session_start();
require 'db.php';

if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['id'];
$name = $_POST['name'] ?? '';
$address = $_POST['address'] ?? '';
$phone = $_POST['phone'] ?? '';
$total_amount = $_POST['total'] ?? '';

// 訂單金額計算
$sql = "SELECT SUM(p.price * sc.quantity) AS total
        FROM shoppingcart sc
        JOIN product p ON sc.product_id = p.pid
        WHERE sc.user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$total = $stmt->get_result()->fetch_assoc()['total'] ?? 0;

// 寫入訂單
$stmt = $conn->prepare("INSERT INTO orders (user_id, order_date, payment_status, shipping_status, shipping_address, total_amount)
                        VALUES (?, NOW(), 'paid', 'pending', ?, ?)");
$stmt->bind_param("iss", $user_id, $address, $total_amount);
$stmt->execute();

$order_id = $conn->insert_id; // 取得新訂單 ID

// 取得購物車商品資料
$stmt = $conn->prepare("SELECT sc.product_id, sc.quantity, sc.color, sc.price, p.name
                        FROM shoppingcart sc
                        JOIN product p ON sc.product_id = p.pid
                        WHERE sc.user_id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

// 寫入訂單明細
$now = date('Y-m-d H:i:s');
while ($item = $result->fetch_assoc()) {
    $subtotal = $item['price'] * $item['quantity'];
    $insertItem = $conn->prepare("INSERT INTO order_items (order_id, product_id, product_name, price, quantity, color, subtotal, created_at, updated_at)
                                  VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $insertItem->bind_param("iisdisdss", $order_id, $item['product_id'], $item['name'], $item['price'], $item['quantity'], $item['color'], $subtotal, $now, $now);
    $insertItem->execute();
}

// 清空購物車
$stmt = $conn->prepare("DELETE FROM shoppingcart WHERE user_id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();

echo "success";

exit;
?>
