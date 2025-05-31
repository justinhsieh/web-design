<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}
$user_id = $_SESSION['id'];
require 'db.php'; // 連接資料庫
$sql = "SELECT sc.*, p.name, p.cate, p.pic, p.price, p.pid, p.color AS color_options
        FROM shoppingcart sc
        JOIN product p ON sc.product_id = p.pid
        WHERE sc.user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->execute([$user_id]);
$result = $stmt->get_result();
$items = $result->fetch_all(MYSQLI_ASSOC);

$stmt = $conn->prepare("SELECT name, address, phone FROM member WHERE id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$member = $stmt->get_result()->fetch_assoc();
// 類別統計
$categoryCount = ['總數' => 0, '手機/平板' => 0, '相機/相機配件' => 0, '電腦/筆電' => 0];
foreach ($items as $item) {
    $categoryCount['總數'] += $item['quantity'];
    $categoryCount[$item['cate']] += $item['quantity'];
}
?>

<!DOCTYPE html>
<html lang="zh-TW">

<?php include 'head.php';?>
  <!-- 自定義JS -->
  <script src="js/validate_personalID.js"></script>
  <script src="js/shopping_list.js"></script>
  <script src="js/cart_cnt.js"></script>
</head>

<body>
  <!-- 導覽列 -->
  <?php include 'header.php';?>
  <main>
    <div class="container py-5">
      <!-- 購物車標題 -->
      <nav class="nav nav-tabs mt-3">
        <a class="nav-link active" id="items-nav">全部 (<span id="items-count" data-itemsCount="<?= $categoryCount['總數'] ?>"><?= $categoryCount['總數'] ?></span>)</a>
        <a class="nav-link" id="phone-nav">手機/平板 (<span id="phone-count" data-phoneCount="<?= $categoryCount['手機/平板'] ?>"><?= $categoryCount['手機/平板'] ?></span>)</a>
        <a class="nav-link" id="camera-nav">相機/相機配件 (<span id="camera-count" data-cameraCount="<?= $categoryCount['相機/相機配件'] ?>"><?= $categoryCount['相機/相機配件'] ?></span>)</a>
        <a class="nav-link" id="computer-nav">電腦/筆電 (<span id="computer-count" data-computerCount="<?= $categoryCount['電腦/筆電'] ?>"><?= $categoryCount['電腦/筆電'] ?></span>)</a>
      </nav>
      <?php foreach (['手機/平板', '相機/相機配件', '電腦/筆電'] as $cate): ?>
        <?php 
          if($cate == '手機/平板') $cate_en = 'phone'; 
          elseif($cate == '相機/相機配件') $cate_en = 'camera'; 
          else $cate_en = 'computer'; 
        ?>
        <div id="<?= $cate_en ?>" class="type" data-category="<?= $cate_en ?>">
          <?php foreach ($items as $item): ?>
            <?php if ($item['cate'] == $cate): ?>
              <div class="cart-item row align-items-center">
                <div class="col-auto"><input type="checkbox" class="item-checkbox" checked></div>
                <div class="col-auto"><img src="<?= htmlspecialchars($item['pic']) ?>" alt="商品圖片" width="100" /></div>
                <div class="col">
                  <div class="fw-bold"><?= htmlspecialchars($item['name']) ?></div>
                  <div data-pid="<?= $item['pid'] ?>">編號：<?= $item['pid'] ?></div>
                  <div class="d-flex align-items-center">
                    <label class="me-2 mb-0">顏色 : </label>
                    <select class="form-select form-select-sm color-select w-auto" style="min-width: 100px;" data-pid="<?= $item['pid'] ?>">
                      <?php
                        $colors = explode(' ', $item['color_options']);
                        foreach ($colors as $color):
                      ?>
                        <option value="<?= $color ?>" <?= $color === $item['color'] ? 'selected' : '' ?>>
                          <?= htmlspecialchars($color) ?>
                        </option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
                <div class="col-auto fs-5">
                  單價: <span class="fs-6 text-danger"><i>$</i></span>
                  <span class="unit-price text-danger" data-price="<?= $item['price'] ?>">
                    <?= number_format($item['price']) ?>
                  </span>
                </div>
                <div class="col-auto">
                  <button class="btn btn-outline-secondary btn-sm decrease" data-pid="<?= $item['pid']?>">-</button>
                  <input type="text" value="<?= $item['quantity'] ?>" class="text-center quantity" id="quantity" readonly />
                  <button class="btn btn-outline-secondary btn-sm increase" data-pid="<?=$item['pid']?>">+</button>
                </div>
                <div class="col-auto">
                  <a href="#" class="remove-item text-danger" data-id="<?= $item['id'] ?>">移除</a>
                </div>

              </div>
            <?php endif; ?>
          <?php endforeach; ?>
        </div>
      <?php endforeach; ?>

      <!-- 全選 -->
      <div class="row mt-3 align-items-center">
        <div class="col-auto">
          <input type="checkbox" id="check-all" checked />
          <label for="check-all">全選</label>
        </div>
        <div class="col text-end">
          <span class="fs-5">商品總金額：</span>
          <span class="text-danger">
            <span class="fs-6">$</span>
            <span class="fs-5" id="total-price">37,999</span>
          </span>
          <button class="btn btn-primary" id="payment-button">結帳(1)</button>
        </div>
      </div>
      <div id="payment" style="display: none">
        <!-- 付款資訊 -->
        <div class="mt-4">
          <div class="payment-section text-center">付款資料</div>
          <form action="#" method="post" id="form-account">
            <div class="mb-3">
              <label for="name" class="form-label">姓名</label>
              <input type="text" class="form-control" id="name" name="name" value="<?= htmlspecialchars($member['name']) ?>" placeholder="ex. 王小明" required />
            </div>
            <div class="mb-3">
              <label for="address" class="form-label">地址</label>
              <input type="text" class="form-control" id="address" name="address" value="<?= htmlspecialchars($member['address']) ?>" required />
            </div>
            <div class="mb-3">
              <label for="card" class="form-label">卡號</label>
              <input type="text" class="form-control" id="card" name="card" pattern="[0-9]{4}-[0-9]{4}-[0-9]{4}"
                placeholder="xxxx-xxxx-xxxx" required />
            </div>
            <div class="mb-3">
              <label for="phone" class="form-label">電話</label>
              <input type="telNo" class="form-control" id="phone" name="phone" value="<?= htmlspecialchars($member['phone']) ?>" pattern="09[0-9]{2}-[0-9]{6}"
                placeholder="09xx-xxxxxx" required />
            </div>
            <!-- 訂單金額 -->
            <div class="total-section text-center mt-3">
              <div class="row">
                <div class="col">信用卡</div>
                <div class="col">=</div>
                <div class="col">本次訂單金額</div>
              </div>
              <div class="row text-danger">
                <div class="col">$<span id="card-total"></span></div>
                <div class="col">=</div>
                <div class="col">$<span id="order-total"></span></div>
              </div>
            </div>
  
            <!-- 確認結帳按鈕 -->
            <div class="text-center mt-3">
              <input type="submit" class="btn btn-primary" id="confirm-checkout" value="確認結帳" />
            </div>
          </form>
        </div>
      </div>
    </div>
  </main>
  <button id="backToTop" class="back-to-top"></button>
  <?php include 'footer.php';?>
</body>

</html>