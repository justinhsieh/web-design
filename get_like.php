<?php include'config.php'; 
    header('Content-Type: application/json');

    $review_id = intval($_GET['review_id'] ?? 0);
    $like_unlike = intval($_GET['like_unlike'] ?? 0);
    $select = intval($_GET['select'] ?? 0);
    $stmt = $conn->prepare('SELECT `like_cnt`,`unlike_cnt` FROM `reviews` WHERE `review_id`= ? ');
    $stmt->bind_param('i',$review_id);
    $stmt->execute();
    $result = $stmt->get_result();
    if($row = $result->fetch_assoc()){
        $like_cnt = 0;
        $unlike_cnt = 0;
        $like_cnt = $row['like_cnt'];
        $unlike_cnt = $row['unlike_cnt'];
        
        if($like_unlike === 1){
            if($select === 1) $like_cnt++;
            else $like_cnt--;
            $conn->query("UPDATE `reviews` SET `like_cnt` = $like_cnt WHERE `review_id` = $review_id ");
        }
        else{
            if($select === 1) $unlike_cnt++;
            else $unlike_cnt--;
            $conn->query("UPDATE `reviews` SET `unlike_cnt` = $unlike_cnt WHERE `review_id` = $review_id ");   
        }
    }

    $stmt->close();
    echo json_encode([
        'like_cnt' => $like_cnt
     ]);
     $conn->close();
?>