<?php
include("db.php");
header('Content-Type: application/json');

$keyword = $_GET['keyword'] ?? '';

if ($keyword) {
    $sql = "SELECT * FROM subscriber WHERE email LIKE ?";
    $stmt = $conn->prepare($sql);
    $searchTerm = "%$keyword%";
    $stmt->bind_param("s", $searchTerm);
    $stmt->execute();
    $result = $stmt->get_result();
    
    $subscribers = [];
    while ($row = $result->fetch_assoc()) {
        $subscribers[] = $row;
    }
    echo json_encode($subscribers);
    $stmt->close();
} else {
    echo json_encode([]);
}

$conn->close();
?>
