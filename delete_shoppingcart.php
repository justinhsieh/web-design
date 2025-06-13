<?php
include("db.php");
header('Content-Type: application/json');

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["id"])) {
    $id = intval($_POST["id"]);
    $stmt = $conn->prepare("DELETE FROM shoppingcart WHERE id = ?");
    $stmt->bind_param("i", $id);
    if ($stmt->execute()) {
        echo json_encode(["status" => "SUCCESS", "message" => "購物車刪除成功"]);
    } else {
        echo json_encode(["status" => "ERROR", "message" => "購物車刪除失敗"]);
    }
}
$conn->close();
?>
