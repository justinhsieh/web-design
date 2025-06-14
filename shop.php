<?php 
  session_start();
  include 'head.php' 
?>
<script src="js/back2top.js"></script>
<script src="js/subscribe.js"></script>
<script src="js/showToast.js"></script>
<script src="js/cart_cnt.js"></script>
<script>
  $(function () {
    $(".spec-btn").click(function () {
      $(".intro").show();
      $(".intro").addClass("fadein");
      $(".comment").removeClass("fadein");
      $(".comment").hide();
      $("#show_review").hide();
      $("#review_pagination").hide();
    });

    $(".comment-btn").click(function () {
      $(".intro").hide();
      $(".comment").show();
      $(".comment").addClass("fadein");
      $(".intro").removeClass("fadein");
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
    function loadReview(page,product){
      $.get('get_review.php',{page:page,product:product},function(response){
        $("#review").html(response.review_html);
        $('.pagination').html(response.pagination);
        $('#show_review').html(response.show_review)
        if(!response.is_login){
          $('#com').html('<div class="text-danger text-center">請先 <a href="login.php" class="text-decoration-none">登入</a> 才能留言。</div>');
        }else{
          $("#com").validate({
            ignore:[],
            submitHandler: function(form) {
                $.post('review2db.php',{
                rating:$('#ratingValue').val(),
                comment:$('[name="content"]').val(),
                productName:product
              },function(response){
                if(response.status === "SUCCESS"){
                  loadReview(1,product);
                  showToast("謝謝您的評論！")
                  $('.review_id').val(response.id);
                }else{
                  showToast("系統發生錯誤，請再試一次！");
                }
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
                required: "請輸入留言！",
                maxlength:"輸入不可超過100個字！"
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
        }
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

    $(document).on('click','#buy_now',function(){
      const $pid = $('input[name="product_id"]').val();
      const $price_text = $('.price').text();
      const $price = parseInt($price_text.replace(/,/g,''));
      const $color = $('.item-color.active').text().trim();
      const $quantity = $('.form-select-sm').val();

      $.post('add_cart.php',{
        oper:'add_shop',
        pid:$pid,
        price:$price,
        color:$color,
        quantity:$quantity
      },function(response){
        if(response.status === 'unauthorized'){
          window.location.href = 'login.php';
        }
        else if(response.status === 'success'){
          window.location.href = 'shopping_list.php';
        }
      },'json')
    })

    $(document).on('click','#buy_cart',function(){
      const $img = $('.product_img');
      const $cart = $('.fa-cart-shopping');

      const $pid = $('input[name="product_id"]').val();
      const $price_text = $('.price').text();
      const $price = parseInt($price_text.replace(/,/g,''));
      const $color = $('.item-color.active').text().trim();
      const $quantity = $('.form-select-sm').val();

      $.post('add_cart.php',{
        oper:'add_shop',
        pid:$pid,
        price:$price,
        color:$color,
        quantity:$quantity
      },function(response){
        if(response.status === 'unauthorized'){
          window.location.href = 'login.php';
        }else if(response.status === 'success'){
          const $flyImg = $img.clone()
          .removeClass('w-100')
          .css({
            position: 'absolute',
            top: $img.offset().top,
            left: $img.offset().left,
            width: $img.width(),
            height: $img.height(),
            opacity: 0.75,
            zIndex: 1000
          })
          .appendTo('body');

          const cartOffset = $cart.offset();

          $flyImg.animate({
            top: cartOffset.top,
            left: cartOffset.left,
            width: 30,
            height: 30,
            opacity: 0
          }, 800, function () {
            $flyImg.remove();
            cart_cnt();
          });
        }
      },'json')
    })

    function cart_cnt(){
      $.get('get_cart_cnt.php',function(response){
        $cnt = response.count;
        if($cnt > 10){
            $('.cart_cnt').text('10+');
        }else{
            $('.cart_cnt').text($cnt);
        }
      })
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
  <?php include'header.php'; ?>
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