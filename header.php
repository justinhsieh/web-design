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
            <li class="nav-item ms-auto d-md-none">
              <a class="nav-link active" aria-current="page" href="login.php">登入</a>
            </li>
            <li class="nav-item ms-auto d-md-none">
              <a class="nav-link" href="personal_id.html">會員資料</a>
            </li>
            <li class="nav-item ms-auto d-md-none">
              <a class="nav-link" href="shopping_list.html">購物車</a>
            </li>
            <li class="nav-item ms-auto d-none">
              <a class="nav-link" href="admin.html">管理者後台</a>
            </li>
          </ul>
        </div>
        <div class="d-none d-md-flex ms-auto me-3 gap-3 icon-link">
          <span class="fw-bold mt-auto">您好，帳號名稱</span>
          <a href="login.php"><i class="fa-solid fa-right-to-bracket fs-1" style="color: lightslategray;"></i></a>
          <a href="personal_id.html"><i class="fa-solid fa-user fs-1" style="color: lightslategray;"></i></a>
          <a href="shopping_list.html">
            <i class="fa-solid fa-cart-shopping fs-1 position-relative" style="color: lightslategray;">
              <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill px-2 py-1 fs-5 bg-warning">9</span>
            </i>
          </a>
          <a href="admin.html" class="d-none"><i class="fa-solid fa-gears fs-1" style="color: lightslategray;"></i></a>
        </div>
      </div>
    </nav>
</header>