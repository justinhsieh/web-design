<?php
header('Content-Type: application/json');
include "db.php";

$keyword = isset($_POST["keyword"]) ? trim($_POST["keyword"]) : "";

$sql = "SELECT o.order_id, 
               m.name AS member_name,
               o.total_amount,
               o.payment_status,
               o.shipping_status,
               o.shipping_address
        FROM orders o
        JOIN member m ON o.user_id = m.id
        WHERE m.name LIKE ? 
           OR o.payment_status LIKE ? 
           OR o.shipping_status LIKE ?
        ORDER BY o.order_date DESC";

$stmt = $conn->prepare($sql);
$searchTerm = "%" . $keyword . "%";
$stmt->bind_param("sss", $searchTerm, $searchTerm, $searchTerm);
$stmt->execute();
$result = $stmt->get_result();

$data = [];
while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}
echo json_encode($data);
$conn->close();
?>