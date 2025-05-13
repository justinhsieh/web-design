<?php 
  session_start();
  include 'config.php';
  header('Content-Type: application/json');

  //取得pid
  $product = $_GET['product']?? '';
  $stmt = $conn->prepare("SELECT `pid` FROM `product` WHERE `name` = ?");
  $stmt->bind_param("s", $product);
  $stmt->execute();
  $result = $stmt->get_result();
  
  if($row = $result->fetch_assoc()){
      $pid = (int)$row['pid'];
  }
  else{
      $pid = null;
  }

  $itemsPerPage = 5;
  $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
  if ($page < 1) $page = 1;
  $total = $conn->query("SELECT COUNT(*) as c FROM `reviews` WHERE `pid` = '$pid'")->fetch_assoc()['c'];
  $totalPages = ceil($total / $itemsPerPage);
  $offset = ($page - 1) * $itemsPerPage;

  //取得評論
  $form = '<form action="" method="POST" class="mt-2 d-flex flex-column py-2" id="com">
            <div class="border-bottom border-secondary my-2 rating">
              <span>商品評價:</span>
              <i class="fa-solid fa-star" data-value="1"></i>
              <i class="fa-solid fa-star" data-value="2"></i>
              <i class="fa-solid fa-star" data-value="3"></i>
              <i class="fa-solid fa-star" data-value="4"></i>
              <i class="fa-solid fa-star" data-value="5"></i>
              <span id="error-container-3"></span>
            </div>
            <input type="hidden" name="ratingValue" id="ratingValue">
            <div class="d-flex align-items-center gap-2">
              <textarea name="content" rows="3" cols="100" placeholder="留下你的評論" style="resize:none;"></textarea>
              <input type="submit" class="comment-submit mt-auto rounded" value="發布留言">
            </div>
            <div> 
              <span id="error-container-1" class="mt-auto"></span>
            </div>
          </form>';
  $stmt = $conn->prepare("SELECT * FROM `reviews` WHERE `pid` = ? ORDER BY `time` DESC LIMIT $itemsPerPage OFFSET $offset ");
  $stmt->bind_param("i", $pid);
  $stmt->execute();
  $result = $stmt->get_result();
  $html = '<span class="fs-3 fw-bold">全部留言</span>';
  while($row = $result->fetch_assoc()){
      $html .= '<div class="d-flex flex-column my-2 rounded customer_review"">
            <div class="d-flex gap-2">
              <div class="fw-bold">'.$row['username'].':'.'</div>';
      for($i = 1; $i <= (int)$row['rating']; $i++){
          $html .= '<i id="review_star" class="fa-solid fa-star pt-1" data-value="'.$i.'"></i>';
      }
      for($i = 1; $i <= 5-(int)$row['rating']; $i++){
          $html .= '<i class="fa-solid fa-star pt-1" data-value="'.$i.'"></i>';
      }
      $datetime = $row['time'];
      list($date,$time) = explode(' ',$datetime);
      $html .= '<div>'.$date.'</div>
              <input type="hidden" name="review_id" class="review_id" value="'.$row['review_id'].'">
            </div>
            <div>
              <span>'.nl2br($row['comment']).'</span>
            </div>
            <div class="d-flex gap-2 align-items-center pb-2">
              <i class="fa-regular fa-thumbs-up like_unlike" data-value="1" style="color: #b6c8e2;"></i>
              <span class="like">'.(($row['like_cnt'] == 0)? '':$row['like_cnt']).'</span>
              <i class="fa-regular fa-thumbs-up fa-flip-vertical like_unlike" data-value="2" style="color: #b6c8e2; --scaleY: -1;"></i>
              <span class="unlike"></span>
            </div>
          </div>
          </div>';
  }
  
  $stmt->close();

  //處理分頁
  $page_html = '';
  if($totalPages > 0){
      $page_html .= '<li class="page-item page_f '.($page === 1 ? 'disabled' : '').'">
          <a class="page-link text-dark" href="#" data-page="1" aria-label="First">
          <span aria-hidden="true">&laquo;</span>
          </a>
      </li>';
  }
    
  for ($i = 1; $i <= $totalPages; $i++) {
  $page_html .= '<li class="page-item page_ '.($i === $page ? 'active' : '').'">
      <a class="page-link text-dark" href="#" data-page="'.$i.'">'.$i.'</a>
  </li>';
  }
  if($totalPages > 0){
  $page_html .= '<li class="page-item page_e '.($page === $totalPages ? 'disabled' : '').'">
      <a class="page-link text-dark" href="#" data-page="'.$totalPages.'" aria-label="Last">
      <span aria-hidden="true">&raquo;</span>
      </a>
  </li>';
  }
  echo json_encode([
      'review_html' => $form,
      'pagination' => $page_html,
      'show_review' => $html,
      'is_login' => isset($_SESSION['username'])
    ]);
  $conn->close();
?>
