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
            <li class="breadcrumb-item"><a href="login.php" class="link-underline link-underline-opacity-0">登入</a></li>
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
   <?php include'footer.php'; ?>
</body>
</html>
