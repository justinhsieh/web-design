<?php
include "db.php";

$limit = 10;
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
$keyword = $_GET['keyword'] ?? '';
$offset = ($page - 1) * $limit;

$params = [];
$where = "";

if ($keyword !== '') {
    $where = "WHERE m.name LIKE ? OR o.payment_status LIKE ? OR o.shipping_status LIKE ?";
    $kw = "%$keyword%";
    $params = [$kw, $kw, $kw];
}

// 總筆數
$count_sql = "SELECT COUNT(*) AS total FROM orders o JOIN member m ON o.user_id = m.id $where";
$stmt = $conn->prepare($count_sql);
if (!empty($params)) {
    $stmt->bind_param("sss", ...$params);
}
$stmt->execute();
$total = $stmt->get_result()->fetch_assoc()['total'];
$stmt->close();

$total_pages = ceil($total / $limit);

// 查詢訂單資料
$sql = "SELECT o.*, m.name AS member_name 
        FROM orders o 
        JOIN member m ON o.user_id = m.id 
        $where 
        ORDER BY o.order_date DESC 
        LIMIT ? OFFSET ?";
$params[] = $limit;
$params[] = $offset;
$stmt = $conn->prepare($sql);
$types = str_repeat("s", count($params) - 2) . "ii";
$stmt->bind_param($types, ...$params);
$stmt->execute();
$result = $stmt->get_result();

$data = [];
while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}

echo json_encode([
    "records" => $data,
    "total_pages" => $total_pages
]);

$stmt->close();
$conn->close();
?>
