<?php 
  session_start();
  include 'head.php' 
?>
<script src="js/subscribe.js"></script>
<script src="js/showToast.js"></script>
<script src="js/cart_cnt.js"></script>
<script>
  $(function() {
    $("#send").validate({
      submitHandler: function(form) {
        let password = $('#pwd1').val().trim();
        $.post('reset_password.php',{password:password},function(response){
          if(response.status === "SUCCESS"){
            showToast("密碼更改成功！")
            setTimeout(() => {
                window.location.href = 'login.php';
            }, 2000);
          }
        },'json')
      },
      rules:{
        pwd1:{
          required:true,
          minlength:6,
          maxlength:12
        },
        pwd2:{
          required:true,
          equalTo:"#pwd1"
        }
      },
      messages: {
        pwd1:{
            required:"密碼為必填欄位",
            minlength:"密碼最少要6個字",
            maxlength:"密碼最少要12個字"
        },
        pwd2: {
          required:"密碼確認為必填欄位",
          equalTo:"兩次密碼不相符"
        }
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
  <?php include'header.php'; ?>
  <!-- 帳號密碼 -->
  <main>
    <section class="container h-100 pb-2 d-flex flex-column align-items-center">
      <div class="row">
        <div class="col-12 d-flex justify-content-center">
          <h1 class="fw-bold pt-2">重置密碼</h1>
        </div>
      </div>
      <div class="row w-100 h-100 justify-content-center py-3">
        <div class="col-12 col-md-8">
          <div class="border border-2 p-4 d-flex flex-column align-items-center h-100 justify-content-center">
            <form action="" id="send" class="w-100 mb-3">
              <div class="row gap-2 d-flex justify-content-center">
                <div class="col-12 col-lg-6">
                    <label for="pwd1">新密碼</label>
                    <input type="password" class="form-control" id="pwd1" name="pwd1" placeholder="密碼長度介於6-12">
                </div>
                <div class="col-12 col-lg-6 mt-3">
                    <label for="pwd2">重新輸入密碼</label>
                    <input type="password" class="form-control" id="pwd2" name="pwd2" placeholder="">
                </div>
                <div class="col-12 col-lg-6">
                    <button class="btn btn-dark w-100" type="submit">確認</button>
                </div>
                <div class="col-12 col-md-10">
                  <span id="error-container-1" class="w-100 text-danger"></span>
                </div>
              </div>
            </form>
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