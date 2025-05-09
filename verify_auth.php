<?php 
    session_start();
    header('Content-Type: application/json');

    $user_input = $_POST['code'] ?? '';
    $status = '';

    if(isset($_SESSION['verify_code'],$_SESSION['verify_time'])){
        $expire_time = 180;
        $valid_time = $_SESSION['verify_time'];
        if(time() - $valid_time > $expire_time){
            $status = "EXPIRE";
        }else if($user_input === $_SESSION['verify_code']){
            $status = "SUCCESS";
        }else{
            $status = "WRONG";
        }
    }

    echo json_encode([
        'status' => $status
    ]);
?>