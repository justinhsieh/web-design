<?php
include("db.php");

$limit = 10;
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
$keyword = $_GET['keyword'] ?? '';
$offset = ($page - 1) * $limit;

$params = [];
$whereClause = '';

if ($keyword !== '') {
    $whereClause = "WHERE name LIKE ? OR username LIKE ? OR email LIKE ?";
    $kw = "%$keyword%";
    $params = [$kw, $kw, $kw];
}

// 總筆數
$count_sql = "SELECT COUNT(*) AS total FROM member $whereClause";
$stmt = $conn->prepare($count_sql);
if (!empty($params)) {
    $stmt->bind_param(str_repeat('s', count($params)), ...$params);
}
$stmt->execute();
$total = $stmt->get_result()->fetch_assoc()['total'];
$stmt->close();

$total_pages = ceil($total / $limit);

// 查詢會員資料
$sql = "SELECT * FROM member $whereClause ORDER BY id DESC LIMIT ? OFFSET ?";
$params[] = $limit;
$params[] = $offset;

$stmt = $conn->prepare($sql);
$types = str_repeat('s', count($params) - 2) . "ii";
$stmt->bind_param($types, ...$params);
$stmt->execute();
$result = $stmt->get_result();

$members = [];
while ($row = $result->fetch_assoc()) {
    $members[] = $row;
}

echo json_encode([
    "members" => $members,
    "total_pages" => $total_pages
]);

$stmt->close();
$conn->close();
?>
