<?php 
  session_start();
  include 'head.php' 
?>
<script src="js/subscribe.js"></script>
<script src="js/showToast.js"></script>
<script>
  $(function() {
    let countdown = 180;
    let timer;
    $("#send").validate({
      submitHandler: function(form) {
        $.post('send_auth.php',{email:$('[name="forget"]').val()},function(response){
          $('.auth-btn').prop('disabled',true);
            let count_time = countdown;

            timer = setInterval(function(){
              if(count_time > 0){
                $('.auth-btn').text(`${count_time}秒後可再發送`);
              }
              else{
                clearInterval(timer);
                $('.auth-btn').prop('disabled',false).text('發送驗證碼');
              }
              count_time--;
          },1000);
          if(response.status === "OK"){
            $("#authentication").show(); //顯示輸入驗證碼欄位
            $("#error-container-1").text(""); //清空錯誤訊息
          }else if(response.status === "BAD"){
            $("#error-container-1").text("請輸入正確的電子信箱");
            clearInterval(timer);
            $('.auth-btn').prop('disabled',false).text('發送驗證碼');
          }else{
            $("#error-container-1").text("系統錯誤，請稍後再試");
            clearInterval(timer);
            $('.auth-btn').prop('disabled',false).text('發送驗證碼');
          }
        },'json')
      },
      rules:{
        forget:{
          required:true,
        }
      },
      messages: {
        forget:{
          required:"電子信箱為必填欄位",
          email:"請輸入正確的電子信箱格式"
        }
      },
      errorPlacement: function (error, element) {
        $("#error-container-1").html(error);
      }
    });

    $("#authentication").validate({
      submitHandler: function(form) {
          $.post('verify_auth.php',{code:$('[name="auth"]').val()},function(response){
            if(response.status === "SUCCESS"){
              window.location.href = "reset.php";
            }else if(response.status === "EXPIRE"){
              $("#error-container-2").html("驗證碼已過期");
            }else{
              $("#error-container-2").html("請輸入正確的驗證碼");
            }
          },'json')
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
          <h1 class="fw-bold pt-2">找回密碼</h1>
        </div>
      </div>
      <div class="row w-100 h-100 justify-content-center py-3">
        <div class="col-12 col-md-8">
          <div class="border border-2 p-4 d-flex flex-column align-items-center h-100 justify-content-center">
            <div class="text-center fs-2 mb-2">忘記密碼?</div>
            <div class="text-center mb-4">請輸入您的電子郵件，我們將會傳送驗證碼給您。</div>
            <form action="#" id="send" class="w-100 mb-3">
              <div class="row gap-1 d-flex justify-content-center">
                <div class="col-12 col-lg-6 ">
                  <input type="email" class="form-control" id="forget" name="forget" placeholder="Email會員信箱">
                </div>
                <div class="col-12 col-lg-4">
                  <button type="submit" class="btn btn-dark w-100 auth-btn">發送驗證碼</button>
                </div>
                <div class="col-12 col-md-10">
                  <span id="error-container-1" class="w-100 text-danger"></span>
                </div>
              </div>
            </form>
            <form action="#" id="authentication" class="w-100 mt-3" style="display:none">
              <div class="row gap-1 d-flex justify-content-center">
                <div class="col-12 col-lg-6">
                  <input type="text" class="form-control" id="auth" name="auth" placeholder="驗證碼">
                </div>
                <div class="col-12 col-lg-4">
                  <button type="submit" class="btn btn-dark w-100">確認</button>
                </div>
                <div class="col-12 col-md-10">
                  <span id="error-container-2" class="w-100 text-danger"></span>
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