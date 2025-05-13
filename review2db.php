<?php include 'config.php';

    header('Content-Type: application/json');
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $rating = intval($_POST['rating']?? 0);
        $comment = $_POST['comment']?? '';
        $product = $_POST['productName']?? '';

        $stmt = $conn->prepare("SELECT pid FROM `product` WHERE `name` = ?");
        $stmt->bind_param("s", $product);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($row = $result->fetch_assoc()) {
            $pid = $row['pid'];

            $stmt = $conn->prepare("INSERT INTO `reviews` (`time`, `comment`, `pid`, `rating`) VALUES (CURRENT_TIMESTAMP, ?, ?, ?)");
            $stmt->bind_param("sii", $comment, $pid, $rating);
            $stmt->execute();
        }
        $last_id = $conn->insert_id;
        $stmt->close();
    }
    echo json_encode([
        'id' => $last_id
     ]);
    $conn->close();
?>
