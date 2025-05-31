<?php
header('Content-Type: application/json');
include "db.php";

$keyword = isset($_POST["keyword"]) ? trim($_POST["keyword"]) : "";

$sql = "SELECT sc.*, 
               m.name AS member_name, 
               p.name AS product_name 
        FROM shoppingcart sc
        JOIN member m ON sc.user_id = m.id
        JOIN product p ON sc.product_id = p.pid
        WHERE m.name LIKE ? 
           OR p.name LIKE ?
        ORDER BY sc.created_at DESC";

$stmt = $conn->prepare($sql);
$searchTerm = "%" . $keyword . "%";
$stmt->bind_param("ss", $searchTerm, $searchTerm);
$stmt->execute();
$result = $stmt->get_result();

$data = [];
while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}
echo json_encode($data);
$conn->close();
?>
