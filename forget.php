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
              alert("success!");
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
    <nav class="navbar navbar-expand-lg bg-light border-bottom border-1 border-black">
      <div class="container-fluid">
        <a class="navbar-brand d-flex align-items-center" href="index.php">
          <img src="images/hacker.png" alt="logo" class="logo">
          <span class="logo-context fs-3 fw-bold">3C用品店|忘記密碼</span>
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
  <!-- 帳號密碼 -->
   <main>
    <section class="h-100 d-flex align-items-center">
        <div class="container p-3 h-100">
            <div class="row h-100">
                <div class="col-12 d-flex justify-content-center align-items-center">
                  <div class="d-flex flex-column justify-content-center align-items-center w-50 h-100 border border-2">
                    <div class="text-center fs-2">忘記密碼?</div>
                    <div class="text-center mb-3">請輸入您的電子郵件，我們將會傳送驗證碼給您。</div>
                    <div class="w-100 d-flex flex-column align-items-center justify-content-center">
                        <form action="#" id="send" class="w-75">
                            <div class="d-flex justify-content-center">
                                <input type="email" class="form-control w-75" id="exampleFormControlInput2" name="email" placeholder="Email會員信箱">
                                <button type="submit" class="ms-2 btn btn-dark sendauth">發送驗證碼</button>
                            </div>
                        </form>
                        <span id="error-container-1" class="w-75"></span>
                        <form action="#" id="authentication" class="w-75 mt-3" style="display:none">
                            <div class="mb-3 d-flex justify-content-center">
                                <input type="text" class="form-control w-50" id="exampleFormControlInput3" name="auth" placeholder="驗證碼">
                                <button type="submit" class="ms-2 btn btn-dark">確認</button>
                            </div>
                        </form>
                        <span id="error-container-2" class="w-75"></span>
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
