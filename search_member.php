<?php
include("db.php");
header('Content-Type: application/json');

$keyword = $_GET['keyword'] ?? '';

if ($keyword) {
    $sql = "SELECT * FROM member WHERE name LIKE ? OR username LIKE ? OR email LIKE ?";
    $stmt = $conn->prepare($sql);
    $searchTerm = "%$keyword%";
    $stmt->bind_param("sss", $searchTerm, $searchTerm, $searchTerm);
    $stmt->execute();
    $result = $stmt->get_result();
    
    $members = [];
    while ($row = $result->fetch_assoc()) {
        $members[] = $row;
    }
    echo json_encode($members);
    $stmt->close();
} else {
    echo json_encode([]);
}

$conn->close();
?>
