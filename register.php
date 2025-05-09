<?php include 'head.php' ?>
    <script>
      $(function() {
        $("#register").validate({
          submitHandler: function(form) {
            let account = $('#account').val().trim();
            let pwd = $('#pwd').val().trim();
            let email = $('#email_2').val().toLowerCase().trim();
            $.post('register2db.php',{account:account,password:pwd,email:email},function(response){
              if(response.status === 'SUCCESS'){
                showToast("註冊成功，請前往登入頁面登入！");
                $('#register input').val('');
              }else{
                showToast("註冊失敗，請檢查是否符合條件！");
              }
            })
            return false;
          },
          rules:{
            account:{
              required:true,
              minlength:5,
              maxlength:10,
              remote:{
                url:'check_register.php',
                type:'post',
                data:{
                  field:"username",
                  value:function(){
                    return $('#account').val().trim();
                  }
                }
              }
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
            email_2:{
              required:true,
              remote:{
                url:'check_register.php',
                type:'post',
                data:{
                  field:"email",
                  value:function(){
                    return $('#email_2').val().toLowerCase().trim();
                  }
                }
              }
            }
          },
          messages: {
            account: {
                required:"帳號為必填欄位",
                minlength:"帳號最少要5個字",
                maxlength:"帳號最長10個字",
                remote:"帳號已存在"
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
            email_2:{
              required:"電子信箱為必填欄位",
              email:"請輸入正確的電子信箱格式",
              remote:"電子信箱已被使用"
            }
          }
        });

        $("#subscribe").validate({
          submitHandler: function(form) {
            let email = $('#email').val().toLowerCase().trim();
            $.post('subscriber.php',{email:email},function(response){
              if(response.status === "OK"){
                showToast("感謝訂閱！")
              }else{
                $("#error-container").html("電子信箱已被使用過");
              }
            },'json');
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

        function showToast(message){
          const toastEl = $('#liveToast')[0];
            if (toastEl) {
              $("#toast-message").text(message);
              const toastBootstrap = bootstrap.Toast.getOrCreateInstance(toastEl,{delay:2000});
              toastBootstrap.show();
            }
        }
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
      <div class="container p-3 h-100">
        <div class="row">
          <div class="col-12 d-flex justify-content-center">
            <h1 class="fw-bold pt-2">註冊會員</h1>
          </div>
        </div>
        <div class="row d-flex justify-content-center">
          <div class="col-12 col-md-8">
            <div class="d-flex flex-column justify-content-center align-items-center  border border-2">
              <div class="w-75 mt-2">
                <form action="" method="POST" id="register">
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
                    <label for="email_2" class="form-label">會員信箱</label>
                    <input type="email" class="form-control" id="email_2" name="email_2" placeholder="Email會員信箱">
                  </div>
                  <button type="submit" class="btn btn-dark w-100 mb-3">註冊會員</button>
                </form>
              </div>
              <div class="d-flex justify-content-center align-items-center mb-2">
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
   <div class="toast_1 position-fixed start-50 translate-middle p-3">
    <div id="liveToast" class="toast bg-danger-subtle" role="alert" aria-live="assertive" aria-atomic="true">
      <div class="toast-header">
        <i class="fa-solid fa-bell" style="color:rgb(123, 93, 193);"></i>
        <strong class="me-auto ms-2">通知</strong>
        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
      </div>
      <div class="toast-body fw-bold fs-6">
        <span id="toast-message">123</span>
      </div>
    </div>
  </div>
</body>
</html>