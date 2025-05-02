<?php include'head.php'; ?>
    <script>
      $(function() {
        $("#send").validate({
          submitHandler: function(form) {
              form.submit();
          },
          rules:{
            email:{
              required:true,
            }
          },
          messages: {
            email:{
              required:"電子信箱為必填欄位"
            }
          },
          errorPlacement: function (error, element) {
            $("#error-container-1").html(error);
          }
        });
        $("#authentication").validate({
          submitHandler: function(form) {
              form.submit();
          },
          rules:{
            auth:{
              required:true,
            }
          },
          messages: {
            auth:{
              required:"驗證碼為必填欄位"
            }
          },
          errorPlacement: function (error, element) {
            $("#error-container-2").html(error);
          }
        });
        $(".sendauth").click(function(){
            const email = $('#exampleFormControlInput2').val();
            const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (emailPattern.test(email)) {
                $("#authentication").show();
            }
        })
        $("#subscribe").validate({
          submitHandler: function(form) {
              form.submit();
          },
          rules:{
            email2:{
              required:true,
            }
          },
          messages: {
            email2: {
                required:"信箱為必填欄位",
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
      <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
          <a class="navbar-brand d-flex align-items-center" href="index.php">
            <img src="images/hacker.png" alt="logo" class="logo">
            <span class="logo-context fs-3 fw-bold">3C用品店|忘記密碼</span>
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
    <section class="container h-100 d-flex justify-content-center align-items-center">
      <div class="row w-100 h-100 justify-content-center py-3">
        <div class="col-12 col-md-8">
          <div class="border border-2 p-4 d-flex flex-column align-items-center h-100 justify-content-center">
            <div class="text-center fs-2 mb-2">忘記密碼?</div>
            <div class="text-center mb-4">請輸入您的電子郵件，我們將會傳送驗證碼給您。</div>
            <form action="#" id="send" class="w-100 mb-3">
              <div class="row gap-1 d-flex justify-content-center">
                <div class="col-12 col-md-6 ">
                  <input type="email" class="form-control" id="exampleFormControlInput2" name="email" placeholder="Email會員信箱">
                </div>
                <div class="col-12 col-md-4">
                  <button type="submit" class="btn btn-dark w-100">發送驗證碼</button>
                </div>
              </div>
            </form>
            <span id="error-container-1" class="w-100 text-danger"></span>
            <form action="#" id="authentication" class="w-100 mt-3" style="display:none">
              <div class="row g-2">
                <div class="col-12 col-md-8">
                  <input type="text" class="form-control" id="exampleFormControlInput3" name="auth" placeholder="驗證碼">
                </div>
                <div class="col-12 col-md-4">
                  <button type="submit" class="btn btn-dark w-100">確認</button>
                </div>
              </div>
            </form>
            <span id="error-container-2" class="w-100 text-danger"></span>
          </div>
        </div>
      </div>
    </section>
  </main>
   <?php include'footer.php'; ?>
</body>
</html>
