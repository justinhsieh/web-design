<?php
    include("db.php");
    header('Content-Type: application/json');

    $productID = $_POST['productID'] ?? '';
    $productTime = $_POST['productTime'] ?? '';
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
    if($productID && $productTime && $productName && $productBrand && $productColor && $productPrice && $productFunction 
    && $productClassifier && $productSubCate && $productType && $productDescription && $productCount && $productPicLocation){
        $sql = "UPDATE product SET name = ?, brand = ?, color = ?, price = ?, function = ?, cate = ?, sub_cate = ?, type = ?, description = ?, stock = ?, pic = ? WHERE pid = ?";
        $stmt = $conn->prepare($sql);

        $stmt->bind_param("sssisssssisi",  $productName, $productBrand, $productColor, $productPrice, $productFunction, 
                                $productClassifier, $productSubCate, $productType, $productDescription, $productCount, $productPicLocation, $productID);
        
        if($stmt->execute()){
            $response = ['status' => 'SUCCESS', 'message' => '商品更新成功'];
        }else{
            $response = ['status' => 'ERROR1', 'message' => '商品更新失敗:' . $stmt->error];
        }
        $stmt->close();
    }else{
        $response = ['status' => 'ERROR2', 'message' => '請填寫所有必要欄位'];
    }
    $conn->close();
    echo json_encode($response);
    header("Location: admin.php");
?>