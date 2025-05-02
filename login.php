<?php include 'head.php' ?>
    <script>
      $(function() {
        $("#login").validate({
          submitHandler: function(form) {
              form.submit();
          },
          rules:{
            account:{
              required:true,
              minlength:5,
              maxlength:10
            },
            pwd:{
                required:true,
                minlength:6,
                maxlength:12
            }
          },
          messages: {
            account: {
                required:"帳號為必填欄位",
                minlength:"帳號最少要5個字",
                maxlength:"帳號最長10個字"
            },
            pwd:{
                required:"密碼為必填欄位",
                minlength:"密碼最少要6個字",
                maxlength:"密碼最少要12個字"
            }
          }
        });
        $("#subscribe").validate({
          submitHandler: function(form) {
              form.submit();
          },
          rules:{
            email:{
              required:true,
            }
          },
          messages: {
            email: {
                required:"信箱為必填欄位",
            }
          },
          errorPlacement: function (error, element) {
            $("#error-container").html(error);
        }
        });
        $("#login").on("submit", function(e) {
          e.preventDefault(); // 阻止表單預設提交行為
          let account = $("#account").val();
          let password = $("#pwd").val();
    
          if (account === "admin" && password === "admin123456") {
            // 登入成功，導向管理者後台
            window.location.href = "admin.html";
          } else if(account === "member" && password === "member123456") {
            window.location.href = "goods.html";
          }
        });
      });
    </script>
    <style>
      .fa-brands{
          color:#3f465a;
          font-size:40px;
      }
    </style>
</head>
<body>
  <!-- 導覽列 -->
  <header>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
      <div class="container-fluid">
        <a class="navbar-brand d-flex align-items-center" href="index.php">
          <img src="images/hacker.png" alt="logo" class="logo">
          <span class="logo-context fs-3 fw-bold">3C用品店|登入</span>
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
        <div class="d-none d-md-flex ms-auto gap-3 icon-link">
          <span class="fw-bold mt-auto">您好，帳號名稱</span>
          <a href="login.php"><i class="fa-solid fa-right-to-bracket fs-1" style="color: lightslategray;"></i></a>
          <a href="personal_id.html"><i class="fa-solid fa-user fs-1" style="color: lightslategray;"></i></a>
          <a href="shopping_list.html"><i class="fa-solid fa-cart-shopping fs-1" style="color: lightslategray;"></i></a>
          <a href="admin.html" class="d-none"><i class="fa-solid fa-gears fs-1" style="color: lightslategray;"></i></a>
        </div>
      </div>
    </nav>
  </header>
  <!-- 帳號密碼 -->
   <main>
    <section class="h-100 d-flex align-items-center">
      <div class="container p-3">
          <div class="row justify-content-center">
              <div class="col-12 col-md-5 border border-2 p-5">
                  <form action="#" id="login" method="POST">
                      <div class="mb-3">
                          <label for="account" class="form-label">會員帳號</label>
                          <input type="text" class="form-control" id="account" name="account" placeholder="Account會員帳號">
                      </div>
                      <div class="mb-3">
                          <label for="pwd" class="form-label">會員密碼</label>
                          <input type="password" class="form-control" id="pwd" name="pwd" placeholder="*************">
                      </div>
                      <button type="submit" class="btn btn-dark w-100 mb-3 login-btn">登入</button>
                  </form>
                  <div class="d-flex justify-content-center">
                      <button type="button" class="btn"><a href="forget.php" class="link-underline link-underline-opacity-0 text-black">忘記密碼</a></button>
                  </div>
              </div>
              <div class="col-12 col-md-4 d-flex flex-column justify-content-center align-items-center border border-2 border-start-0 gap-3 p-5">
                  <span>首次購物，馬上加入會員!</span>
                  <a href="register.php"><button type="button" class="btn btn-dark">註冊會員</button></a>
                  
              </div>
          </div>
      </div>
    </section>
   </main>
   <?php include'footer.php'; ?>
</body>
</html>
