<!-- 導覽列 -->
<header>
  <nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
      <a class="navbar-brand d-flex align-items-center" href="index.php">
        <img src="images/hacker.png" alt="logo" class="logo">
        <span class="logo-context fs-3 fw-bold">3C用品店</span>
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          
          <?php 
            if(isset($_SESSION['username'])){
              echo '<li class="nav-item ms-auto d-lg-none">
                      <span class="fs-4">您好，'.htmlentities($_SESSION['username']).'</span>
                    </li>';
            }else{
              echo '<li class="nav-item ms-auto d-lg-none">
                      <span class="fs-4 fw-bold">您好，遊客</span>
                    </li>';
            }
            if(!isset($_SESSION['username'],$_SESSION['role'])){
              echo '<li class="nav-item ms-auto d-lg-none">
                      <a class="nav-link active main_nav fs-4" aria-current="page" href="login.php">登入</a>
                    </li>';
            }else{
              echo '<li class="nav-item ms-auto d-lg-none">
                      <a class="nav-link main_nav fs-4" aria-current="page" href="logout.php">登出</a>
                    </li>';
            }
          ?>
          <li class="nav-item ms-auto d-lg-none">
            <a class="nav-link main_nav fs-4" href="personal_id.php">會員資料</a>
          </li>
          <li class="nav-item ms-auto d-lg-none">
            <a class="nav-link main_nav fs-4" href="shopping_list.php">購物車</a>
          </li>
         <li class="nav-item ms-auto d-lg-none">
            <a class="nav-link main_nav fs-4" href="order.php">個人歷史訂單</a>
          </li>
          
          <?php 
            if(isset($_SESSION['role']) && $_SESSION['role'] === "admin"){
              echo '<li class="nav-item ms-auto d-lg-none">
                      <a class="nav-link main_nav fs-4" href="admin.php">管理者後台</a>
                    </li>';
            }
          ?>
        </ul>
      </div>
      <div class="d-none d-lg-flex ms-auto me-3 gap-3 icon-link">
        <span class="fw-bold mt-auto main_nav">
          <?php 
            if(isset($_SESSION['username'])){
              echo "您好，". htmlentities($_SESSION['username']);
            }else{
              echo "您好，遊客";
            }
          ?>
        </span>
        <?php 
            if(!isset($_SESSION['username'],$_SESSION['role'])){
              echo '<a href="login.php" class="header_btn main_nav"><i class="fa-solid fa-right-to-bracket fs-4">登入</i></a>';
            }else{
              echo '<a href="logout.php" class="header_btn main_nav fa-solid fs-4 text-decoration-none"><i class="fa-solid fa-right-from-bracket fa-rotate-180 fs-4"></i>登出</a>';
            }
          ?>
        <a href="personal_id.php" class="header_btn main_nav"><i class="fa-solid fa-user fs-4">會員資料</i></a>
        <a href="shopping_list.php" class="header_btn main_nav text-decoration-none">
          <i class="fa-solid fa-cart-shopping fs-4 position-relative">
            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill px-1 py-0 bg-warning text-black-50 cart_cnt">9</span>
          </i>
          <span class="fa-solid fs-4">購物車</span>
        </a>
        <a href="order.php" class="header_btn main_nav"><i class="fa-solid fa-clipboard-list fs-4">個人歷史訂單</i></a>
        <?php 
          if(isset($_SESSION['role']) && $_SESSION['role'] === "admin"){
            echo '<a href="admin.php" class="header_btn main_nav"><i class="fa-solid fa-gears fs-4">管理員介面</i></a>';
          }
        ?>
      </div>
    </div>
  </nav>
</header>