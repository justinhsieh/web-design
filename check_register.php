<?php 
    include 'config.php';

    $field = $_POST['field'] ?? '';
    $value = $_POST['value'] ?? '';
    $status = true;
    if($field && $value){
        if(in_array($field,["username","email"])){
            $stmt = $conn->prepare("SELECT COUNT(*) AS total FROM member WHERE $field = ?");
            $stmt->bind_param("s",$value);
            $stmt->execute();
            $result = $stmt->bind_result($count);
            $stmt->fetch();
            if($count > 0){
                $status = false;
            }
            $stmt->close();
        }
    }
    echo $status? 'true':'false';
    $conn->close();
?>