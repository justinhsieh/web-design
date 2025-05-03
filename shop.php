<?php include 'head.php' ?>
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

        $(".spec-btn").click(function () {
          $(".intro").show();
          $(".comment").hide();
          $("#show_review").hide();
          $("#review_pagination").hide();
        });

        $(".comment-btn").click(function () {
          $(".intro").hide();
          $(".comment").show();
          $("#show_review").show();
          $("#review_pagination").show();
        });

        $(".spec-comment").click(function(){
          $(".spec-comment").removeClass("active");
          $(this).addClass("active");
        })

        $(".item-color").click(function(){
          $(".item-color").removeClass("active");
          $(this).addClass("active");
        })

        $(document).on('mouseenter', '.rating i', function () {
          $(this).prevAll().addBack().addClass("hovered");
        }).on('mouseleave', '.rating i', function () {
          $(".rating i").removeClass("hovered");
        });

        $(document).on('click','.rating i',function(){
          $(".rating i").removeClass("selected");
          $(this).prevAll().addBack().addClass("selected");
          $("#ratingValue").val($(this).data("value"));
        })

        $.validator.addMethod("ratingRequired", function(value, element) {
          return value !== "";
        }, "請選擇星星評分");
        const product = "<?php echo "{$_GET['product_name']}";?>";
        
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

        function loadReview(page,product){
          $.get('get_review.php',{page:page,product:product},function(response){
            $("#review").html(response.review_html);
            $('.pagination').html(response.pagination);
            $('#show_review').html(response.show_review)
            $("#com").validate({
              ignore:[],
              submitHandler: function(form) {
                  $.post('review2db.php',{
                  rating:$('#ratingValue').val(),
                  comment:$('[name="content"]').val(),
                  productName:product
                },function(response){
                  loadReview(1,product);
                  showToast("謝謝您的評論！")
                  $('.review_id').val(response.id);
                },'json')
              },
              rules: {
                ratingValue: {
                  ratingRequired: true
                },
                content: {
                  required: true,
                  maxlength:100
                }
              },
              messages: {
                content: {
                  required: "請輸入留言",
                  maxlength:"輸入不可超過100個字"
                }
              },
              errorPlacement: function (error, element) {
                if (element.attr("name") === "ratingValue") {
                  $("#error-container-3").html(error);
                }else if(element.attr("name") === "content"){
                  $("#error-container-1").html(error);
                }
              }
            });
          },'json')
        }
        // 點擊分頁按鈕
        $('.pagination').on('click', 'a', function () {
          const page = parseInt($(this).data('page'));
          if (!isNaN(page)) {
            loadReview(page,product);
          }
        });
        loadReview(1,product);
        $(document).on('mouseenter','i.like_unlike',function(){
          $(this).removeClass('fa-regular').addClass('fa-solid');
        }).on('mouseleave','i.like_unlike',function(){
          if(!$(this).hasClass('selected')){
            $(this).removeClass('fa-solid').addClass('fa-regular');
          }
        });
        $(document).on('click','i.like_unlike',function(){
          let select = 0;
          if(!$(this).hasClass('selected')){
            $(this).siblings('i.like_unlike').removeClass('fa-solid selected').addClass('fa-regular')
            $(this).removeClass('fa-regular').addClass('fa-solid selected')
            select = 1;
          }else{
            $(this).removeClass('fa-solid').addClass('fa-regular').removeClass('selected');
          }
          let self = $(this);
          let review_id = $(this).closest('.customer_review').find('.review_id').val();
          let like_unlike = $(this).data('value');
          $.get('get_like.php',{review_id:review_id,like_unlike:like_unlike,select:select},function(response){
          if(response.like_cnt > 0){
            self.closest('.customer_review').find('span.like').text(response.like_cnt);
          }else{
            self.closest('.customer_review').find('span.like').text('');
          }
          },'json')
        })
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
      body .rating i.hovered, body .rating i.selected, #review_star{
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
    <nav class="navbar navbar-expand-md bg-body-tertiary">
      <div class="container-fluid">
        <a class="navbar-brand d-flex align-items-center" href="index.php">
          <img src="images/hacker.png" alt="logo" class="logo">
          <span class="logo-context fs-3 fw-bold">3C用品店</span>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item ms-auto d-md-none">
              <a class="nav-link active" aria-current="page" href="login.php">登入</a>
            </li>
            <li class="nav-item ms-auto d-md-none">
              <a class="nav-link" href="personal_id.html">會員資料</a>
            </li>
            <li class="nav-item ms-auto d-md-none">
              <a class="nav-link" href="shopping_list.html">購物車</a>
            </li>
            <li class="nav-item ms-auto d-none">
              <a class="nav-link" href="admin.html">管理者後台</a>
            </li>
          </ul>
        </div>
        <div class="d-none d-md-flex ms-auto me-3 gap-3 icon-link">
          <span class="fw-bold mt-auto">您好，帳號名稱</span>
          <a href="login.php"><i class="fa-solid fa-right-to-bracket fs-1" style="color: lightslategray;"></i></a>
          <a href="personal_id.html"><i class="fa-solid fa-user fs-1" style="color: lightslategray;"></i></a>
          <a href="shopping_list.html">
            <i class="fa-solid fa-cart-shopping fs-1 position-relative" style="color: lightslategray;">
              <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill px-2 py-1 fs-5 bg-warning">9</span>
            </i>
          </a>
          <a href="admin.html" class="d-none"><i class="fa-solid fa-gears fs-1" style="color: lightslategray;"></i></a>
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
    <?php include'footer.php'; ?>
    <button id="backToTop" class="back-to-top"></button>
    
  <div class="toast-container position-fixed bottom-0 end-0 p-3">
    <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
      <div class="toast-header">
        <i class="fa-solid fa-bell" style="color: #82769e;"></i>
        <strong class="me-auto ms-2">通知</strong>
        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
      </div>
      <div class="toast-body">
        謝謝您的評論！
      </div>
    </div>
  </div>
  </body>
</html>
