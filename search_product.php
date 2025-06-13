<?php
include "db.php";

$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$keyword = isset($_GET['keyword']) ? "%" . $_GET['keyword'] . "%" : "%%";
$limit = 5;
$offset = ($page - 1) * $limit;

// 查總數
$countSql = "SELECT COUNT(*) FROM product WHERE name LIKE ? OR brand LIKE ? OR cate LIKE ?";
$countStmt = $conn->prepare($countSql);
$countStmt->bind_param("sss", $keyword, $keyword, $keyword);
$countStmt->execute();
$countResult = $countStmt->get_result()->fetch_row()[0];
$totalPages = ceil($countResult / $limit);
$countStmt->close();

// 查資料
$sql = "SELECT * FROM product WHERE name LIKE ? OR brand LIKE ? OR cate LIKE ? ORDER BY pid LIMIT ?, ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sssii", $keyword, $keyword, $keyword, $offset, $limit);
$stmt->execute();
$result = $stmt->get_result();

$products_html = "";
while ($row = $result->fetch_assoc()) {
    $products_html .= "<tr>
        <td>{$row['pid']}</td><td>{$row['name']}</td><td>{$row['brand']}</td><td>{$row['color']}</td>
        <td>{$row['price']}</td><td>{$row['function']}</td><td>{$row['cate']}</td><td>{$row['type']}</td>
        <td>{$row['description']}</td><td>{$row['sub_cate']}</td><td>{$row['stock']}</td>
        <td>
            <button class='btn btn-warning btn-sm edit-product' data-bs-toggle='modal' data-bs-target='#editProductModal'
                data-pid='{$row['pid']}' data-time='{$row['time']}' data-name='{$row['name']}' data-brand='{$row['brand']}'
                data-color='{$row['color']}' data-price='{$row['price']}' data-function='{$row['function']}'
                data-cate='{$row['cate']}' data-type='{$row['type']}' data-description='{$row['description']}'
                data-sub_cate='{$row['sub_cate']}' data-stock='{$row['stock']}' data-pic-link='{$row['pic']}'>編輯</button>
            <button class='btn btn-danger btn-sm delete-product' data-pid='{$row['pid']}'>刪除</button>
        </td>
    </tr>";
}
$stmt->close();

// 分頁 HTML
$pagination_html = "";
for ($i = 1; $i <= $totalPages; $i++) {
    $active = ($i == $page) ? "active" : "";
    $pagination_html .= "<li class='page-item $active'>
                            <a class='page-link' href='#' data-page='$i'>$i</a>
                         </li>";
}

echo json_encode([
    "products_html" => $products_html,
    "pagination_html" => $pagination_html
]);

$conn->close();
?>
