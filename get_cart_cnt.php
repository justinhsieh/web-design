<?php 
    session_start();
    include 'config.php';
    header('Content-Type:application/json');

    $member_id = intval($_SESSION['id'] ?? 0);
    $cnt = 0;

    if(!$member_id){
        $cnt = 0;
    }else{
        $stmt = $conn->prepare("SELECT Count(*) AS c FROM shoppingcart WHERE user_id= ?");
        $stmt->bind_param('i',$member_id);
        $stmt->execute();
        $cnt = $stmt->get_result()->fetch_assoc()['c'];
        $stmt->close();
    }
    echo json_encode([
        'count' => $cnt
    ]);
    $conn->close();
?>