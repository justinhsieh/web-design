<?php 
  session_start();
  include 'head.php' 
?>
<script src="js/subscribe.js"></script>
<script src="js/showToast.js"></script>
<script src="js/cart_cnt.js"></script>
<script>
  $(function() {
    $("#login").validate({
      submitHandler: function(form) {
        let account = $("#account").val();
        let password = $("#pwd").val();
        $.post('check_login.php',{account:account,pwd:password},function(response){
          if(response.status === "USER"){
            showToast("登入成功！3秒後跳轉到首頁");
            setTimeout(() => {
                window.location.href = 'index.php';
            }, 3000);
          }else if(response.status === "ADMIN"){
            window.location.href = 'admin.php';
          }else{
            $('#error-account').text("請輸入正確的帳號密碼");
          }
        })
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
            maxlength:"密碼最長12個字"
        }
      }
    });

    $('#account,#pwd').on('input',function(){
      $('#error-account').text('');
    })
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
  <?php include'header.php'; ?>
  <!-- 帳號密碼 -->
   <main>
    <section class="h-100 d-flex align-items-center">
      <div class="container p-3">
        <div class="row">
          <div class="col-12 d-flex justify-content-center">
            <h1 class="fw-bold pt-2">登入會員</h1>
          </div>
        </div>
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
                        <span id="error-account" class="text-danger small"></span>
                    </div>
                    <button type="submit" class="btn btn-dark w-100 mb-3 login-btn">登入</button>
                </form>
                <div class="d-flex justify-content-center">
                    <a href="forget.php" class="link-underline link-underline-opacity-0 text-black">忘記密碼</a>
                </div>
            </div>
            <div class="col-12 col-md-4 d-flex flex-column justify-content-center align-items-center border border-2 gap-3 p-5">
                <span>首次購物，馬上加入會員!</span>
                <a href="register.php"><button type="button" class="btn btn-dark">註冊會員</button></a>
            </div>
        </div>
      </div>
    </section>
   </main>
   <?php include'footer.php'; ?>
   <div class="toast_1 position-fixed start-50 translate-middle p-3">
      <div id="liveToast" class="toast bg-danger-subtle" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header">
          <i class="fa-solid fa-bell" style="color:rgb(123, 93, 193);"></i>
          <strong class="me-auto ms-2">通知</strong>
          <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body">
          <span id="toast-message" class="fw-bold fs-6">你好</span>
          <div class="mt-2 pt-2 border-top text-black">
            如果您的瀏覽器沒有自動跳轉，請點擊<a href="index.php" class="link-primary text-decoration-none">這裡</a>。
          </div>
        </div>
      </div>
    </div>
</body>
</html>