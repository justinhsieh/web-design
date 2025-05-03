<?php include 'head.php' ?>
    <script>
      $(function() {
        $("#register").validate({
          submitHandler: function(form) {
              alert("success!");
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
            },
            pwd2:{
              required:true,
              equalTo:"#pwd"
            },
            email:{
              required:true,
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
            },
            pwd2: {
              required:"密碼確認為必填欄位",
              equalTo:"兩次密碼不相符"
            },
            email:{
              required:"電子信箱為必填欄位"
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
                email:"請輸入正確的電子信箱格式"
            }
          },
          errorPlacement: function (error, element) {
            $("#error-container").html(error);
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
    <nav class="navbar navbar-expand-md bg-body-tertiary">
      <div class="container-fluid">
        <a class="navbar-brand d-flex align-items-center" href="index.php">
          <img src="images/hacker.png" alt="logo" class="logo">
          <span class="logo-context fs-3 fw-bold">3C用品店|註冊會員</span>
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
  <!-- 帳號密碼 -->
   <main>
    <section class="h-100 d-flex align-items-center">
        <div class="container p-3 h-100">
          <div class="row h-100 d-flex justify-content-center">
            <div class="col-12 col-md-8">
              <div class="d-flex flex-column justify-content-center align-items-center h-100 border border-2">
                <div class="w-75">
                  <form action="#" id="register">
                    <div class="mb-3">
                      <label for="account" class="form-label">會員帳號</label>
                      <input type="text" class="form-control" id="account" name="account" placeholder="帳號長度介於5-10">
                    </div>
                    <div class="mb-3">
                        <label for="pwd" class="form-label">會員密碼</label>
                        <input type="password" class="form-control" id="pwd" name="pwd" placeholder="密碼長度介於6-12">
                    </div>
                    <div class="mb-3">
                      <label for="pwd2" class="form-label">密碼確認</label>
                      <input type="password" class="form-control" id="pwd2" name="pwd2">
                    </div>
                    <div class="mb-3">
                      <label for="exampleFormControlInput3" class="form-label">會員信箱</label>
                      <input type="email" class="form-control" id="exampleFormControlInput3" name="email" placeholder="Email會員信箱">
                    </div>
                    <button type="submit" class="btn btn-dark w-100 mb-3">註冊會員</button>
                  </form>
                </div>
                <div class="d-flex justify-content-center align-items-center">
                    <span>已有帳號？</span>
                    <a href="login.php" class="text-danger link-underline link-underline-opacity-0">登入</a>
                </div>
              </div>
            </div>
          </div>
        </div>
    </section>
   </main>
   <?php include'footer.php'; ?>
</body>
</html>
