<?php
include("db.php");
header('Content-Type: application/json');

$keyword = $_GET['keyword'] ?? '';

if ($keyword) {
    $sql = "SELECT * FROM reviews WHERE username LIKE ? OR rating LIKE ? OR  comment LIKE ?";
    $stmt = $conn->prepare($sql);
    $searchTerm = "%$keyword%";
    $stmt->bind_param("sss", $searchTerm, $searchTerm, $searchTerm);
    $stmt->execute();
    $result = $stmt->get_result();
    
    $reviews = [];
    while ($row = $result->fetch_assoc()) {
        $reviews[] = $row;
    }
    echo json_encode($reviews);
    $stmt->close();
} else {
    echo json_encode([]);
}

$conn->close();
?>
