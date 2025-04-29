<?php include 'header.php' ?>
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
              alert("success!");
              form.submit();
          },
          rules:{
            email2:{
              required:true
            }
          },
          messages: {
            email2:{
                required:"信箱為必填欄位"
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
    <nav class="navbar navbar-expand-lg bg-light border-bottom border-1 border-black">
      <div class="container-fluid">
        <a class="navbar-brand d-flex align-items-center" href="index.html">
          <img src="images/hacker.png" alt="logo" class="logo">
          <span class="logo-context fs-3 fw-bold">3C用品店|註冊會員</span>
        </a>
        <nav aria-label="breadcrumb" class="ms-auto me-3">
          <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="login.php" class="link-underline link-underline-opacity-0">登入</a></li>
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
  <!-- 帳號密碼 -->
   <main>
    <section class="h-100 d-flex align-items-center">
        <div class="container p-3 h-100">
            <div class="row h-100">
                <div class="col-12 d-flex justify-content-center align-items-center">
                  <div class="d-flex flex-column justify-content-center align-items-center w-50 h-100 border border-2">
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
                <input type="email" class="form-control w-75" id="email" name="email2" placeholder="輸入E-mail" aria-label="Recipient's username" aria-describedby="button-addon2">
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