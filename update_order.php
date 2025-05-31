<?php
require "db.php";

$order_id = $_POST['order_id'];
$payment_status = $_POST['payment_status'];
$shipping_status = $_POST['shipping_status'];
$shipping_address = $_POST['shipping_address'];

$stmt = $conn->prepare("UPDATE orders SET payment_status = ?, shipping_status = ?, shipping_address = ?, updated_at = NOW() WHERE order_id = ?");
$stmt->bind_param("sssi", $payment_status, $shipping_status, $shipping_address, $order_id);
$stmt->execute();

header("Location: order.php");
exit;
?>
