<?php include 'head.php' ?>
    <style>
      .fa-brands{
          color:#3f465a;
          font-size:40px;
      }
    </style>
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
            $("html").animate({ scrollTop: 0 },0);
        });
        $("#subscribe").validate({
          submitHandler: function(form) {
              alert("success!");
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
            $("#error-container").html(error);
        }
        });
        $(document).on('click','.card a',function(e){
          e.preventDefault();
          let product_name = $(this).closest('.card').find('.card-title').text();
          let url = 'shop.php?product_name=' + encodeURIComponent(product_name);
          window.location.href = url;
        })
      });
    </script>
</head>
<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary homepage-nav w-100">
        <div class="container-fluid ">
          <a class="navbar-brand" href="index.php">
            <img src="images/hacker.png" alt="logo" class="logo">
            <span class="logo-context fs-3 fw-bold text-warning">3C用品店</span>
          </a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
            <ul class="navbar-nav mb-2 mb-lg-0 gap-3">
              <li class="nav-item ms-auto">
                <a class="homepage-nav-title nav-link text-warning fs-3 fw-bold active " aria-current="page" href="#service">SERVICE</a>
              </li>
              <li class="nav-item ms-auto">
                <a class="homepage-nav-title nav-link text-warning fs-3 fw-bold" href="#product">PRODUCT</a>
              </li>
              <li class="nav-item ms-auto">
                <a class="homepage-nav-title nav-link text-warning fs-3 fw-bold" href="#team">TEAM</a>
              </li>
            </ul>
          </div>
        </div>
    </nav>
    <header id="homepage-header" class="h-75 d-flex flex-column">
        <div class="d-flex flex-column justify-content-center align-items-center gap-3">
            <div class="welcome text-light fs-3 fw-bold">歡迎光臨3C用品店</div>
            <div class="welcome text-light fs-2 fw-bold">IT'S NICE TO MEET YOU</div>
            <a href="goods.php"><button type="button" class="btn btn-warning btn-lg text-light">前往購物</button></a>
        </div>
    </header>
    <div class="d-flex flex-column my-5" id="service">
        <div class="mx-auto fs-1 fw-bold my-5">SERVICE</div>
        <div class="row d-flex mb-5 justify-content-center align-items-center mx-3">
            <div class="col-12 col-md-4 d-flex flex-column align-items-center gap-4">
                <i class="fa-solid fa-cart-shopping" style="color: #FFD43B;font-size:100px;"></i>
                <div class="fs-3 fw-bold">E-commerce</div>
                <div class="text-center">我們提供最新的手機、筆電、智慧穿戴裝置及各式周邊配件，滿足您的科技需求。讓科技輕鬆融入您的日常生活。</div>
            </div>
            <div class="col-12 col-md-4 d-flex flex-column align-items-center gap-4">
                <i class="fa-solid fa-desktop" style="color: #FFD43B;font-size:100px;"></i>
                <div class="fs-3 fw-bold">Responsive Design</div>
                <div class="text-center">我們的網站採用 響應式設計，無論您使用手機、平板或電腦，都能享受流暢的購物體驗。動態調整的介面確保操作便利性，讓您隨時隨地輕鬆選購最新3C產品！</div>
            </div>
            <div class="col-12 col-md-4 d-flex flex-column align-items-center gap-4">
                <i class="fa-solid fa-face-smile" style="color: #FFD43B; font-size:100px;"></i>
                <div class="fs-3 fw-bold">Attitude</div>
                <div class="text-center">我們秉持誠信、專業與熱忱，用心聆聽您的需求，為您推薦最合適的科技解決方案。我們致力於提供最貼心、迅速且可靠的服務，讓您的每一次選購都充滿信心與滿意！</div>
            </div>
        </div>
    </div>
    <div class="d-flex flex-column my-5" id="product">
        <div class="mx-auto fs-1 fw-bold my-5">PRODUCT</div>
        <div class="row d-flex mb-5 justify-content-center gap-5">
            <div class="col-12 col-md-4 card" style="width: 18rem;">
                <a href="#"><img src="images/ipad11.png" class="card-img-top"></a>
                <div class="card-body text-center">
                  <h5 class="card-title fw-bold">iPad 11 11吋/WiFi/128G 平板電腦</h5>
                </div>
            </div>
            <div class="col-12 col-md-4 card" style="width: 18rem;">
                <a href="#"><img src="images/ipadair.png" class="card-img-top"></a>
                <div class="card-body text-center">
                  <h5 class="card-title fw-bold">iPad Air 11吋/WiFi/128G平板電腦</h5>
                </div>
            </div>
            <div class="col-12 col-md-4 card" style="width: 18rem;">
                <a href="#"><img src="images/ipadpro.png" class="card-img-top"></a>
                <div class="card-body text-center">
                  <h5 class="card-title fw-bold">iPad Pro 11吋/WiFi/256G/M4晶片 平板電腦</h5>
                </div>
            </div>
        </div>
    </div>
    <div class="d-flex flex-column my-5" id="team">
        <div class="mx-auto fs-1 fw-bold my-5">TEAM</div>
        <div class="row d-flex mb-5 justify-content-center gap-5">
            <div class="col-12 col-md-4 text-center">
                <img src="images/profile_1.png" alt="">
                <div class="fw-bold fs-2">Justin Hsieh</div>
                <div class="fs-4">Designer</div>
            </div>
            <div class="col-12 col-md-4 text-center">
                <img src="images/profile_2.png" alt="">
                <div class="fw-bold fs-2">Sam Chen</div>
                <div class="fs-4">Designer</div>
            </div>
        </div>
    </div>
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
                <button class="btn btn-outline-secondary" type="submit" id="button-addon2">訂閱</button>
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
  <button id="backToTop" class="back-to-top"></button>
</body>
</html>
