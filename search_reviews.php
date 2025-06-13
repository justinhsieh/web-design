<?php
include "db.php";

$limit = 10;
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
$keyword = $_GET['keyword'] ?? '';
$offset = ($page - 1) * $limit;

$params = [];
$where = '';

if ($keyword !== '') {
    $where = "WHERE username LIKE ? OR comment LIKE ? OR rating LIKE ?";
    $kw = "%$keyword%";
    $params = [$kw, $kw, $kw];
}

// 計算總筆數
$count_sql = "SELECT COUNT(*) AS total FROM reviews $where";
$stmt = $conn->prepare($count_sql);
if (!empty($params)) {
    $stmt->bind_param("sss", ...$params);
}
$stmt->execute();
$total = $stmt->get_result()->fetch_assoc()['total'];
$stmt->close();

$total_pages = ceil($total / $limit);

// 查詢留言
$sql = "SELECT * FROM reviews $where ORDER BY time DESC LIMIT ? OFFSET ?";
$params[] = $limit;
$params[] = $offset;
$stmt = $conn->prepare($sql);
$types = str_repeat('s', count($params) - 2) . "ii";
$stmt->bind_param($types, ...$params);
$stmt->execute();
$result = $stmt->get_result();

$reviews = [];
while ($row = $result->fetch_assoc()) {
    $reviews[] = $row;
}

echo json_encode([
    "reviews" => $reviews,
    "total_pages" => $total_pages
]);

$stmt->close();
$conn->close();
?>
