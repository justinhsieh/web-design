<?php
include("db.php");
header('Content-Type: application/json');

$keyword = $_GET['keyword'] ?? '';

if ($keyword) {
    $sql = "SELECT * FROM product WHERE name LIKE ? OR brand LIKE ? OR cate LIKE ?";
    $stmt = $conn->prepare($sql);
    $searchTerm = "%$keyword%";
    $stmt->bind_param("sss", $searchTerm, $searchTerm, $searchTerm);
    $stmt->execute();
    $result = $stmt->get_result();
    
    $products = [];
    while ($row = $result->fetch_assoc()) {
        $products[] = $row;
    }
    echo json_encode($products);
    $stmt->close();
} else {
    echo json_encode([]);
}

$conn->close();
?>
