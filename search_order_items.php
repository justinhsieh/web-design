<?php
require "db.php";

$keyword = $_GET['keyword'] ?? '';
$page = intval($_GET['page'] ?? 1);
$limit = 10;
$offset = ($page - 1) * $limit;

$where = "";
if (!empty($keyword)) {
    $keyword = "%$keyword%";
    $where = "WHERE oi.order_id LIKE ? OR m.username LIKE ?";
}

// 查詢總數
$total_sql = "SELECT COUNT(*) FROM order_items oi 
              JOIN orders o ON oi.order_id = o.order_id
              JOIN member m ON o.user_id = m.id
              $where";
$stmt = $conn->prepare($total_sql);

if (!empty($where)) {
    $stmt->bind_param("ss", $keyword, $keyword);
}

$stmt->execute();
$stmt->bind_result($total_records);
$stmt->fetch();
$stmt->close();

$total_pages = ceil($total_records / $limit);

// 查詢資料
$sql = "SELECT oi.*, m.username FROM order_items oi 
        JOIN orders o ON oi.order_id = o.order_id
        JOIN member m ON o.user_id = m.id
        $where
        ORDER BY oi.created_at DESC
        LIMIT $limit OFFSET $offset";

$stmt = $conn->prepare($sql);
if (!empty($where)) {
    $stmt->bind_param("ss", $keyword, $keyword);
}
$stmt->execute();
$result = $stmt->get_result();

$records = [];
while ($row = $result->fetch_assoc()) {
    $records[] = $row;
}

echo json_encode([
    "records" => $records,
    "total_pages" => $total_pages
]);
?>
