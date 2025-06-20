<?php
include("db.php");
header('Content-Type: application/json');

$productName = $_POST['productName'] ?? '';
$productBrand = $_POST['productBrand'] ?? '';
$productColor = $_POST['productColor'] ?? '';
$productPrice = $_POST['product_price'] ?? '';
$productFunction = $_POST['productFunction'] ?? '';
$productClassifier = $_POST['productClassifier'] ?? '';
$productSubCate = $_POST['product_sub_cate'] ?? '';
$productType = $_POST['productType'] ?? '';
$productDescription = $_POST['product_description'] ?? '';
$productCount = $_POST['product_count'] ?? '';
$productPicLocation = $_POST['product_pic_location'] ?? '';

if ($productName && $productBrand && $productColor && $productPrice && $productFunction &&
    $productClassifier && $productSubCate && $productType && $productDescription && $productCount && $productPicLocation) {

    $productPrice = intval($productPrice);
    $productCount = intval($productCount);

    if ($productClassifier == "phone") {
        $productClassifier = "手機/平板";
    } elseif ($productClassifier == "camera") {
        $productClassifier = "相機/相機配件";
    } else {
        $productClassifier = "電腦/筆電";
    }

    $sql = "INSERT INTO product (name, brand, color, price, function, cate, sub_cate, type, description, stock, pic)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssisssssis", $productName, $productBrand, $productColor, $productPrice, $productFunction,
                      $productClassifier, $productSubCate, $productType, $productDescription, $productCount, $productPicLocation);

    if ($stmt->execute()) {
        // 查詢商品總筆數
        $countResult = $conn->query("SELECT COUNT(*) AS total FROM product");
        $totalRows = $countResult->fetch_assoc()['total'];
        $rowsPerPage = 5; // 假設每頁顯示 5 筆
        $totalPages = ceil($totalRows / $rowsPerPage);

        $response = [
            'status' => 'SUCCESS',
            'message' => '商品新增成功',
            'lastPage' => $totalPages
        ];
    } else {
        $response = ['status' => 'ERROR1', 'message' => '商品新增失敗: ' . $stmt->error];
    }

    $stmt->close();
} else {
    $response = ['status' => 'ERROR2', 'message' => '請填寫所有必要欄位'];
}

$conn->close();
echo json_encode($response);
?>
