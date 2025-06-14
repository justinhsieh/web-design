<?php 
    session_start();
    include 'db.php';
    header('Content-Type:application/json');

    $oper = $_POST['oper'] ?? '';
    $pid = intval($_POST['pid'] ?? 0);
    $member_id = intval($_SESSION['id'] ?? 0);
    $price = intval($_POST['price'] ?? 0);
    $quantity = intval($_POST['quantity'] ?? 0);
    $color = $_POST['color'] ?? '';
    $status = 'success';

    if(!$member_id){
        echo json_encode([
            'status' => "unauthorized"
        ]);
        exit;
    }
    if($oper !== '' && $pid !== 0 && $price !== '' && $color !== ''){
        $stmt = $conn->prepare("SELECT * FROM `shoppingcart` WHERE `user_id`= ? AND `product_id` = ? AND `color` = ? ");
        $stmt->bind_param('iis',$member_id,$pid,$color);
        $stmt->execute();
        $result = $stmt->get_result();
        $count = $result->num_rows;
        if($oper === "add_goods"){
            if($count){
                $row = $result->fetch_assoc();
                $q = $row['quantity'] + 1;
                $stmt = $conn->prepare("UPDATE `shoppingcart` SET `quantity`= $q WHERE `user_id`= ? AND `product_id` = ? AND `color` = ? ");
                $stmt->bind_param('iis',$member_id,$pid,$color);
                $stmt->execute();
            }else{
                $stmt = $conn->prepare("INSERT INTO `shoppingcart`(`user_id`, `product_id`, `quantity`, `price`, `color` ) VALUES (?,?,1,?,?)");
                $stmt->bind_param('iiis',$member_id,$pid,$price,$color);
                $stmt->execute();
            }
        }else if($oper === "add_shop"){
            
            if($count){
                $row = $result->fetch_assoc();
                $q = $row['quantity'] + $quantity;
                $stmt->prepare("UPDATE `shoppingcart` SET `quantity` = $q WHERE `user_id`= ? AND `product_id` = ? AND `color` = ? ");
                $stmt->bind_param('iis',$member_id,$pid,$color);
                $stmt->execute();
            }else{
                $stmt = $conn->prepare("INSERT INTO `shoppingcart`(`user_id`, `product_id`, `quantity`, `price`, `color`) VALUES (?,?,?,?,?)");
                $stmt->bind_param('iiiis',$member_id,$pid,$quantity,$price,$color);
                $stmt->execute();
            }
        }
        $stmt->close();
    }else{
        $status = 'bad';
    }
    echo json_encode([
        'status' => $status
    ]);
    $conn->close();
?>