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
            <p class="border-top border-bottom p-3">售價<span class="price">'.number_format($row['price']).'</span>元</p>
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
    $html .= '<div class="border border-2 mb-2 comment" style="display: none">
            <form action="" method="" class="mt-2 d-flex flex-column" id="com">
              <div class="border-bottom border-2 my-2 rating">
                <span>商品評價:</span>
                <i class="fa-solid fa-star" data-value="1"></i>
                <i class="fa-solid fa-star" data-value="2"></i>
                <i class="fa-solid fa-star" data-value="3"></i>
                <i class="fa-solid fa-star" data-value="4"></i>
                <i class="fa-solid fa-star" data-value="5"></i>
              </div>
              <input type="hidden" name="ratingValue" id="ratingValue">
              <div class="d-flex align-items-center gap-2">
                <span>客戶名字:</span>
                <textarea name="content" rows="3" cols="100" placeholder="留下你的評論"></textarea>
                <input type="submit" class="comment-submit mt-auto">
                <span id="error-container-1"></span>
              </div>
            </form>
            </div>
          </div>';
$conn->close();
echo $html;    
          
?>
          <!-- <div class="d-flex flex-column border border-2 my-2 w-75">
            <div class="d-flex">
              <div>名字:00000000</div>
              <div class="ms-auto">日期:2025/03/23</div>
            </div>
            <div class="mt-3">
              <span> 評論:11111111 </span>
            </div>
          </div> -->