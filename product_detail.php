<?php
    include 'config.php';

    $product_name = htmlspecialchars($_GET['product_name']);
    $where = "name = '$product_name'";

    $result = $conn->query("SELECT * FROM product WHERE $where");

    $html = '';
    $row = $result->fetch_assoc();
    $html .= '<div class="row pt-3">
          <div class="col-12 col-md-4">
            <img src="'.$row['pic'].'" alt="" class="w-100 border border-3 border-black"/>
          </div>
          <div class="col-12 col-md-8">
            <h4 class="p-3">'
              .$row['name'].'
            </h4>
            <ul>';
    $function = explode("\n",$row['function']);
    for($i = 0; $i < count($function); $i++){
      $html .= '<li class="text-body-secondary">'.$function[$i].'</li>';
    }
    $html .='</ul>
            <p class="border-top border-bottom p-3">售價<span class="price text-danger fs-3">'.number_format($row['price']).'</span>元</p>
            <p>品牌名稱:'.$row['brand'].'</p>
            <div class="d-flex align-items-center">
              <p>顏色:</p>
              <ul class="list-group list-group-horizontal text-center shop-color ms-2 pb-3">';
    $color = explode(' ',$row['color']);
    for($i = 0; $i < count($color); $i++){
      $html .= '<button type="button" class="list-group-item list-group-item-action item-color'.(($i == 0)?' active':'').'">
                  '.$color[$i].'
              </button>';
    }
    $html .= '</ul>
            </div>
            <div class="mb-3">
              <span>數量：</span>
              <select
                class="form-select-sm"
                aria-label="Default select example"
              >';
    for($i = 1; $i <= (int)$row['stock']; $i++){
      $html .= '<option value="'.$i.'">'.$i.'</option>';
    }
    $html .= '</select>
            </div>
            <div class="d-flex gap-3">
              <button type="button" class="btn btn-danger">直接購買</button>
              <button type="button" class="btn btn-primary">加入購物車</button>
            </div>
          </div>
        </div>
        <div class="row mt-3">
          <div class="mt-1 w-100">
            <ul class="list-group list-group-horizontal text-center w-50 pb-3">
              <button type="button"class="list-group-item list-group-item-action spec-comment spec-btn active"aria-current="true">
                商品規格
              </button>
              <button type="button" class="list-group-item list-group-item-action spec-comment comment-btn">
                商品評價
              </button>
            </ul>
          </div>
          <div class="intro">
            <table class="table w-75 border border-2">
              <tbody>
                <tr>
                  <th scope="row" class="w-25 border-end border-2">品牌名稱</th>
                  <td>'.$row['brand'].'</td>
                </tr>
                <tr>
                  <th scope="row" class="w-25 border-end border-2">款式</th>
                  <td>'.$row['cate'].'</td>
                </tr>
                <tr>
                  <th scope="row" class="w-25 border-end border-2">類型</th>
                  <td>'.$row['type'].'</td>
                </tr>
                <tr>
                  <th scope="row" class="w-25 border-end border-2">商品規格</th>
                  <td>
                    '.nl2br($row['description']).'
                  </td>
                </tr>
              </tbody>
            </table>
          </div>';
    $html .= '<div class="row border rounded" style="background-color:#eaeded;">
                <div class="mb-2 comment mt-2" id="review" style="display: none;"></div>
                <div class="row mx-auto border-top border-2 border-secondary" id="show_review" style="display:none;"></div>
              </div>
            <div class="row mt-4" id="review_pagination" style="display:none;">
              <div class="col">
                <nav aria-label="Page navigation example">
                  <ul class="pagination mt-3 position-relative justify-content-center">
                  </ul>
                </nav>
              </div>
            </div>
          </div>';
$conn->close();
echo $html;    
          
?>
          