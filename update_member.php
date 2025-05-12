<?php
    include("db.php");
    header('Content-Type: application/json');

    $customerID = $_POST['customerID'] ?? '';
    $name = $_POST['name'] ?? '';
    $birth = $_POST['birth'] ?? '';
    $gender = $_POST['sex'] ?? '';
    $account = $_POST['account'] ?? '';
    $phone_number = $_POST['phone_number'] ?? '';
    $email = $_POST['email'] ?? '';
    $location = $_POST['location'] ?? '';
    $role = $_POST['role'] ?? '';

    if ($customerID && $name && $birth && $gender && $account && $phone_number && $email && $location && $role) {
        $sql = "UPDATE member SET name = ?, birthdate = ?, gender = ?, username = ?, phone = ?, email = ?, address = ?, role = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssssssi", $name, $birth, $gender, $account, $phone_number, $email, $location, $role, $customerID);
        if ($stmt->execute()) {
            echo json_encode(["status" => "SUCCESS", "message" => "會員資料更新成功"]);
        } else {
            echo json_encode(["status" => "ERROR", "message" => "會員資料更新失敗：" . $stmt->error]);
        }
        $stmt->close();
    } else {
        echo json_encode(["status" => "ERROR", "message" => "請填寫所有必要欄位"]);
    }
    $conn->close();
    // header("Location: admin.php");
?>