<?php
session_start();
require 'db.php';

if (!isset($_SESSION['id'])) {
    http_response_code(403);
    echo "未登入";
    exit;
}

$user_id = $_SESSION['id'];
$id = $_POST['id'] ?? null;

if ($id && is_numeric($id)) {
    $stmt = $conn->prepare("DELETE FROM shoppingcart WHERE id = ? AND user_id = ?");
    $stmt->bind_param("is", $id, $user_id);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        echo "success";
    } else {
        echo "not_found";
    }
} else {
    http_response_code(400);
    echo "資料錯誤";
}
?>
