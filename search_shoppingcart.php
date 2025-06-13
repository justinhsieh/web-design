<?php
include "db.php";

$limit = 10;
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
$keyword = $_GET['keyword'] ?? '';
$offset = ($page - 1) * $limit;

$params = [];
$where = "";

if ($keyword !== '') {
    $where = "WHERE m.name LIKE ? OR p.name LIKE ?";
    $kw = "%$keyword%";
    $params = [$kw, $kw];
}

// 計算總筆數
$count_sql = "SELECT COUNT(*) AS total 
              FROM shoppingcart sc 
              JOIN member m ON sc.user_id = m.id 
              JOIN product p ON sc.product_id = p.pid 
              $where";
$stmt = $conn->prepare($count_sql);
if (!empty($params)) {
    $stmt->bind_param("ss", ...$params);
}
$stmt->execute();
$total = $stmt->get_result()->fetch_assoc()['total'];
$stmt->close();

$total_pages = ceil($total / $limit);

// 查詢資料
$sql = "SELECT sc.*, m.name AS member_name, p.name AS product_name 
        FROM shoppingcart sc 
        JOIN member m ON sc.user_id = m.id 
        JOIN product p ON sc.product_id = p.pid 
        $where 
        ORDER BY sc.created_at DESC 
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
