<?php include 'header.php' ?>
    <script>
      $(function () {
        $(window).scroll(function () {
            if ($(this).scrollTop() > 200) {
                $("#backToTop").css("display", "flex");
            } else {
                $("#backToTop").css("display", "none");
            }
        });
        $("#backToTop").click(function () {
            $("html").animate({ scrollTop: 0 });
        });
        $(".spec-btn").click(function () {
          $(".intro").show();
          $(".comment").hide();
        });
        $(".comment-btn").click(function () {
          $(".intro").hide();
          $(".comment").show();
        });
        $(".spec-comment").click(function(){
          $(".spec-comment").removeClass("active");
          $(this).addClass("active");
        })
        $(".item-color").click(function(){
          $(".item-color").removeClass("active");
          $(this).addClass("active");
        })
        $(".rating i").hover(
          function(){
            $(this).prevAll().addBack().addClass("hovered");
          },
          function(){
            $(".rating i").removeClass("hovered");
        })
        $(".rating i").on('click',function(){
          $(".rating i").removeClass("selected");
          $(this).prevAll().addBack().addClass("selected");
          $("#ratingValue").val($(this).data("value"));
        })
        $.validator.addMethod("ratingRequired", function(value, element) {
          return value !== "";
        }, "請選擇星星評分");
        $("#com").validate({
          ignore:[],
          submitHandler: function(form) {
              form.submit();
          },
          rules: {
            ratingValue: {
              ratingRequired: true
            },
            content: {
              required: true
            }
          },
          messages: {
            content: {
              required: "請輸入留言"
            }
          },
          errorPlacement: function (error, element) {
            if (element.attr("name") === "ratingValue") {
              error.insertAfter(".rating");
            }else if(element.attr("name") === "content"){
              $("#error-container-1").html(error);
            } else{
              error.insertAfter(element);
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
            $("#error-container-2").html(error);
        }
        });
      });
    </script>
    <style>
      body .rating i.hovered, body .rating i.selected{
        color: #ffd43b;
      }
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
            <span class="logo-context fs-3 fw-bold">3C用品店|商品頁面</span>
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
    <!-- 商品 -->
    <main>
      <div class="container">
        <?php 
          if(isset($_GET['product_name']))
            include 'product_detail.php'; 
        ?>
      </div>
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
                <span id="error-container-2"></span>
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
    <button id="backToTop" class="back-to-top"></button>
  </body>
</html>