<!-- 導覽列 -->
<header>
  <nav class="navbar navbar-expand-md bg-body-tertiary">
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
            if(!isset($_SESSION['username'],$_SESSION['role'])){
              echo '<li class="nav-item ms-auto d-md-none">
                      <a class="nav-link active" aria-current="page" href="login.php">登入</a>
                    </li>';
            }else{
              echo '<li class="nav-item ms-auto d-md-none">
                      <a class="nav-link" aria-current="page" href="logout.php">登出</a>
                    </li>';
            }
          ?>
          <li class="nav-item ms-auto d-md-none">
            <a class="nav-link" href="personal_id.php">會員資料</a>
          </li>
          <li class="nav-item ms-auto d-md-none">
            <a class="nav-link" href="shopping_list.php">購物車</a>
          </li>
          <?php 
            if(isset($_SESSION['role']) && $_SESSION['role'] === "admin"){
              echo '<li class="nav-item ms-auto d-md-none">
                      <a class="nav-link" href="admin.php">管理者後台</a>
                    </li>';
            }
          ?>
        </ul>
      </div>
      <div class="d-none d-md-flex ms-auto me-3 gap-3 icon-link">
        <span class="fw-bold mt-auto">
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
              echo '<a href="login.php"><i class="fa-solid fa-right-to-bracket fs-1" style="color: lightslategray;"></i></a>';
            }else{
              echo '<a href="logout.php"><i class="fa-solid fa-right-from-bracket fa-rotate-180 fs-1" style="color: lightslategray;"></i></a>';
            }
          ?>
        <a href="personal_id.php"><i class="fa-solid fa-user fs-1" style="color: lightslategray;"></i></a>
        <a href="shopping_list.php">
          <i class="fa-solid fa-cart-shopping fs-1 position-relative" style="color: lightslategray;">
            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill px-2 py-1 fs-5 bg-warning">9</span>
          </i>
        </a>
        <?php 
          if(isset($_SESSION['role']) && $_SESSION['role'] === "admin"){
            echo '<a href="admin.php"><i class="fa-solid fa-gears fs-1" style="color: lightslategray;"></i></a>';
          }
        ?>
      </div>
    </div>
  </nav>
</header>