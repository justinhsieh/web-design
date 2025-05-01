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
        <a class="navbar-brand d-flex align-items-center" href="index.php">
          <img src="images/hacker.png" alt="logo" class="logo">
          <span class="logo-context fs-3 fw-bold">3C用品店|註冊會員</span>
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
