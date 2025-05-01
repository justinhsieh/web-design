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
    <nav class="navbar navbar-expand-lg bg-light border-bottom border-1 border-black">
      <div class="container-fluid">
        <a class="navbar-brand d-flex align-items-center" href="index.php">
          <img src="images/hacker.png" alt="logo" class="logo">
          <span class="logo-context fs-3 fw-bold">3C用品店|登入</span>
        </a>
        <nav aria-label="breadcrumb" class="ms-auto me-3">
          <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="login.html" class="link-underline link-underline-opacity-0">登入</a></li>
            <li class="breadcrumb-item"><a href="register.php" class="link-underline link-underline-opacity-0">註冊</a></li>
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
  <!-- 帳號密碼 -->
   <main>
    <section class="h-100 d-flex align-items-center">
        <div class="container p-3">
            <div class="row justify-content-center">
                <div class="col-4 border border-2 p-5">
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
                <div class="col-4 d-flex flex-column justify-content-center align-items-center border border-2 border-start-0 gap-3 p-5">
                    <span>首次購物，馬上加入會員!</span>
                    <a href="register.php"><button type="button" class="btn btn-dark">註冊會員</button></a>
                    
                </div>
            </div>
        </div>
    </section>
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
                <button class="btn btn-outline-secondary text-light" type="submit" id="button-addon2">訂閱</button>
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
