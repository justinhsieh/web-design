<?php
include("db.php");
header('Content-Type: application/json');

$name = $_POST['name'] ?? '';
$birth = $_POST['birth'] ?? '';
$gender = $_POST['sex'] ?? '';
$account = $_POST['account'] ?? '';
$password_raw = $_POST['password'] ?? '';
$phone_number = $_POST['phone_number'] ?? '';
$email = $_POST['email'] ?? '';
$location = $_POST['location'] ?? '';
$role = $_POST['role'] ?? '';

if ($password_raw === '') {
    echo json_encode(['status' => 'ERROR', 'message' => '密碼欄位是必要的']);
    exit;
}

$password = password_hash($password_raw, PASSWORD_DEFAULT);

if ($name && $gender && $birth && $account && $password && $phone_number && $email && $location && $role) {
    $sql = "INSERT INTO member (name, gender, birthdate, username, password, phone, email, address, role)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssssss", $name, $gender, $birth, $account, $password, $phone_number, $email, $location, $role);

    if ($stmt->execute()) {
        // 新增成功，查詢總會員筆數
        $result = $conn->query("SELECT COUNT(*) AS total FROM member");
        $totalRows = $result->fetch_assoc()['total'];
        $rowsPerPage = 10;
        $lastPage = ceil($totalRows / $rowsPerPage);

        $response = ['status' => 'SUCCESS', 'message' => '會員新增成功', 'lastPage' => $lastPage];
    } else {
        $response = ['status' => 'ERROR', 'message' => '會員新增失敗: ' . $stmt->error];
    }

    $stmt->close();
} else {
    $response = ['status' => 'ERROR', 'message' => '請填寫所有必要欄位'];
}

$conn->close();
echo json_encode($response);
?>