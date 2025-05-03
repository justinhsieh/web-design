<?php include'head.php'; ?>
    <script>
      $(function() {
        $("#send").validate({
          submitHandler: function(form) {
              form.submit();
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
              showToast("感謝訂閱！")
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
              $(".toast-body").text(message);
              const toastBootstrap = bootstrap.Toast.getOrCreateInstance(toastEl,{delay:3000});
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
                <div class="col-12 col-md-6 ">
                  <input type="email" class="form-control" id="exampleFormControlInput2" name="forget" placeholder="Email會員信箱">
                </div>
                <div class="col-12 col-md-4">
                  <button type="submit" class="btn btn-dark w-100">發送驗證碼</button>
                </div>
                <div class="col-12 col-md-10">
                  <span id="error-container-1" class="w-100 text-danger"></span>
                </div>
              </div>
            </form>
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
