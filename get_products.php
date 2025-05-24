<?php
    include 'config.php';
    
    header('Content-Type: application/json');

    $itemsPerPage = 12;
    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    if ($page < 1) $page = 1;
    $category = isset($_GET['category']) ? $_GET['category'] : 'all';
    $subcategory = isset($_GET['subcategory']) ? $_GET['subcategory'] : 'all';
    $keyword = isset($_GET['keyword'])? $_GET['keyword'] : '';

    if ($category === '手機/平板'){
        $where = "cate = '手機/平板'";  // 查詢手機/平板的商品
    }elseif ($category === '相機/相機配件'){
        $where = "cate = '相機/相機配件'";  // 查詢相機/相機配件的商品 
    }elseif ($category === '電腦/筆電'){
        $where = "cate = '電腦/筆電'";  // 查詢電腦/筆電的商品 
    }else{
        $where = "1";
    }    
    if($subcategory !== 'all')
        $where .= " AND sub_cate = '$subcategory'";

    if($keyword !== ''){
        $where .= " AND (`name` LIKE '%$keyword%' OR `brand` LIKE '%$keyword%')";
    }
    $total = $conn->query("SELECT COUNT(*) as c FROM product WHERE $where")->fetch_assoc()['c'];
    $totalPages = ceil($total / $itemsPerPage);
    $offset = ($page - 1) * $itemsPerPage;
    $result = $conn->query("SELECT * FROM product WHERE $where ORDER BY pid LIMIT $itemsPerPage OFFSET $offset");

    $html = '';
    while ($row = $result->fetch_assoc()) {
    $html .= '<div class="col-12 col-sm-6 col-md-4 d-flex justify-content-center mt-4">
            <div class="card" style="width: 18rem;">
                <a href="#"><img src="'.$row['pic'].'" class="card-img-top"></a>
                <div class="card-body">
                    <span class="fs-5">'.$row['name'].'</span>
                    <h5 class="card-title">售價<span class="price text-danger fs-3">'.number_format($row['price']).'</span>元</h5>
                    <div class="d-flex flex-column flex-xl-row gap-1 gap-xl-3 justify-content-center">
                        <button type="button" class="btn btn-danger flex-grow-1">直接購買</button>
                        <button type="button" class="btn btn-primary flex-grow-1">加入購物車</button>
                    </div>
                </div>
            </div>
        </div>';
    }
    $page_html = '';

    if($totalPages > 0){
    $page_html .= '<li class="page-item page_f '. (($page === 1) ? 'disabled' : '') .'">
        <a class="page-link text-dark" href="#" data-page="1" aria-label="First">
        <span aria-hidden="true">&laquo;</span>
        </a>
    </li>';
    }
    
    for ($i = 1; $i <= $totalPages; $i++) {
    $page_html .= '<li class="page-item page_ '. (($i === $page) ? 'active' : '') .'">
        <a class="page-link text-dark" href="#" data-page="'.$i.'">'.$i.'</a>
    </li>';
    }
    if($totalPages > 0){
    $page_html .= '<li class="page-item page_e '. (($page === $totalPages) ? 'disabled' : '').'">
        <a class="page-link text-dark" href="#" data-page="'.$totalPages.'" aria-label="Last">
        <span aria-hidden="true">&raquo;</span>
        </a>
    </li>';
    }
    

    echo json_encode([
        'products_html' => $html,
        'page_html' => $page_html,
        'total_pages' => $totalPages
    ]);
$conn->close();
?>
