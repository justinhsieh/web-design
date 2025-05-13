<?php include("db.php"); ?>
<!DOCTYPE html>
<html lang="zh-Hant">
<head>
    <meta charset="UTF-8">
    <title>歷屆訂單查詢</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- 自定義CSS -->
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <style>
        .container {
            padding: 40px;
            border-radius: 10px;
            max-width: 700px;
            width: 100%;
            text-align: center;
        }
        .result-table {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <!-- 導覽列 -->
  <header>
    <nav class="navbar navbar-expand-lg bg-light border-bottom border-1 border-black">
      <div class="container-fluid">
        <a class="navbar-brand d-flex align-items-center" href="index.html">
          <img src="images/hacker.png" alt="logo" class="logo">
          <span class="logo-context fs-3 fw-bold">3C用品店</span>
        </a>
        <nav aria-label="breadcrumb" class="ms-auto me-3">
          <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="login.html" class="link-underline link-underline-opacity-0">登入</a></li>
            <li class="breadcrumb-item"><a href="register.html" class="link-underline link-underline-opacity-0">註冊</a></li>
          </ol>
        </nav>
        <div class="tool-right me-4 d-flex">
          <a href="personal_id.html" alt="account">
            <img src="images/user.png" class="icon pe-2">
          </a>
          <a href="shopping_list.html" alt="shopping-cart">
            <img src="images/shopping-cart.png" class="icon" >
          </a>
        </div>
      </div>
    </nav>
  </header>
    <main>

        <div class="container">
            <h2 class="mb-4">歷屆訂單查詢</h2>
            <form id="searchForm" method="POST" class="row g-3 justify-content-center">
                <div class="col-md-8">
                    <input type="text" name="user_email" class="form-control" placeholder="請輸入會員 Email">
                </div>
                <div class="col-md-4">
                    <button type="submit" class="btn btn-primary w-100">查詢</button>
                </div>
            </form>
            <?php
            if (isset($_POST['user_email']) && $_POST['user_email'] != "") {
                $email = $conn->real_escape_string($_POST['user_email']);
                $sql = "SELECT orders.order_id, orders.created_at, orders.total_amount
                        FROM orders
                        JOIN member ON orders.user_id = member.id
                        WHERE member.email = '$email'";
                $result = $conn->query($sql);
    
                echo '<table class="table table-bordered result-table"><thead><tr>
                        <th class="text-center">訂單編號</th>
                        <th class="text-center">訂單日期</th>
                        <th class="text-center">總金額</th>
                      </tr></thead><tbody>';
    
                if ($result && $result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr class='text-center'><td>{$row['order_id']}</td><td>{$row['created_at']}</td><td>\${$row['total_amount']}</td></tr>";
                    }
                } else {
                    echo '<tr><td colspan="3" class="text-center">查無資料</td></tr>';
                }
                echo '</tbody></table>';
            }
            ?>
        </div>
    </main>
    <!-- 頁尾 -->
  <footer class="bg-dark">
    <div class="container-fluid">
      <div class="row bg-dark py-5 align-items-center">
        <div class="col-12 col-md-6 text-light d-flex justify-content-center mt-3">
          <span class="d-flex w-75 border border-2 border-white rounded">防詐騙提醒：3C用品店絕不會以電話或簡訊通知訂單/分期出錯、或變更付款方式，更不會要您前往ATM進行任何操作！不應在3C用品店以外的任何地方輸入3C用品店帳密(例如非政府官方的電子發票app)，以免權益受損！</span>
        </div>
        <div class="col-12 col-md-6 d-flex mt-3">
          <div class="col-7 d-flex ms-3">
            <div class="subscribe w-75 ms-auto">
              <div class="text-light fs-5 mb-2">Email:</div>
              <form action="" id="subscribe" class="d-flex">
                <input type="email" class="form-control w-75" id="email" name="email" placeholder="輸入E-mail" aria-label="Recipient's username" aria-describedby="button-addon2">
                <button class="btn btn-outline-secondary" type="submit" id="button-addon2">訂閱</button>
              </form>
              <span id="error-container"></span>
            </div>
          </div>
          <div class="col-5">
            <div class="followus">
              <div class="title text-light text-center followus_title">FOLLOW US ON</div>
              <div class="d-flex justify-content-center gap-3 mt-3">
                <a href="#" title="facebook">
                    <i class="fa-brands fa-square-facebook"></i>
                </a>
                <a href="#" title="Instagram">
                  <i class="fa-brands fa-instagram"></i>
                </a>
                <a href="#"title="Line">
                  <i class="fa-brands fa-line"></i>
                </a>
              </div>
            </div>
          </div>          
        </div>
      </div>
    </div>
    <div class="container text-center">
      <div class="row">
        <div class="col">
          <p class="copyright text-light">COPYRIGHT@3C用品店 CO.,LTD.ALL RIGHTS RESERVED.</p>
        </div>
      </div>
    </div>
  </footer>
</body>

</html>
