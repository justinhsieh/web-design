<?php 
  session_start();
  include 'head.php'; 
?>
<script src="js/back2top.js"></script>
<script src="js/subscribe.js"></script>
<script src="js/showToast.js"></script>
<script>
  $(function () {
    $(".drop_item").click(function(){
      $(".dropdown-toggle").html($(this).html());
      $(".drop_item").each(function(){
        $(this).show();
      })
      $(this).hide();
      if($(this).text() == "排序：全部"){
        $(".list-group-item").show();
      }else if($(this).text() == "排序：手機/平板"){
        for(var i=0; i<9; i++){
          if(i<3)
            $(".list-group-item").eq(i).show();
          else
          $(".list-group-item").eq(i).hide();
        }
      }else if($(this).text() == "排序：相機/相機配件"){
        for(var i=0; i<9; i++){
          if(i >= 3 && i <= 5)
            $(".list-group-item").eq(i).show();
          else
          $(".list-group-item").eq(i).hide();
        }
      }else{
        for(var i=0; i<9; i++){
          if(i >= 6 && i <= 8)
            $(".list-group-item").eq(i).show();
          else
          $(".list-group-item").eq(i).hide();
        }
      }
    })

    //載入商品
    function loadProducts(page, category, subcategory,keyword = '') {
      $.get('get_products.php', {
        page: page,
        category: category,
        subcategory: subcategory,
        keyword:keyword
      }, function (response) {
        $('#product_list').html(response.products_html);
        $('.pagination').html(response.page_html);
        currentCategory = category;
        currentSubcategory = subcategory;
      }, 'json');
    }

    // 點擊分頁按鈕
    $('.pagination').on('click', 'a', function () {
      const page = parseInt($(this).data('page'));
      if (!isNaN(page)) {
        loadProducts(page, currentCategory, currentSubcategory);
      }
    });

    let currentCategory = 'all';
    let currentSubcategory = 'all';

    // 點擊主分類
    $('.dropdown-menu').on('click', 'a', function (e) {
      e.preventDefault();
      $('.drop_item').removeClass('active');
      $(this).addClass('active');
      const category = $(this).data('category');
      currentCategory = category;
      currentSubcategory = 'all';
      $('.searchbar').val('');
      loadProducts(1, currentCategory, currentSubcategory);
    });

    // 點擊次分類
    $('.list-group').on('click', 'a', function (e) {
      e.preventDefault();
      const subcategory = $(this).text().trim();
      currentSubcategory = subcategory;
      loadProducts(1, currentCategory, currentSubcategory);
    });

    //點擊商品
    $(document).on('click','.card a',function(e){
      e.preventDefault();
      let product_name = $(this).closest('.card').find('span.fs-5').text();
      let url = 'shop.php?product_name=' + encodeURIComponent(product_name);
      window.location.href = url;
    })

    //搜尋
    $('.searchbar').on('input',function(){
      const keyword = $('.searchbar').val()?$('.searchbar').val().trim():'';
      loadProducts(1, currentCategory, currentSubcategory, keyword);
    })

    // 預設載入第一頁全部商品
    loadProducts(1, currentCategory, currentSubcategory);
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
  <!-- 幻燈片 -->
  <section>
    <div id="carouselExampleAutoplaying" class="carousel slide bg-light" data-bs-ride="carousel">
      <div class="carousel-indicators">
        <button type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide-to="0" class="c-indicator active me-2" aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide-to="1" class="c-indicator me-2"aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide-to="2" class="c-indicator me-2"aria-label="Slide 3"></button>
      </div>
      <div class="carousel-inner">
        <div class="carousel-item active">
          <img src="images/bt_2_095_01_e10.jpg" class="d-block carousel-img mx-auto">
        </div>
        <div class="carousel-item">
          <img src="images/bt_2_095_01_e6.png" class="d-block carousel-img mx-auto">
        </div>
        <div class="carousel-item">
          <img src="images/bt_2_095_02_e10.jpg" class="d-block carousel-img mx-auto">
        </div>
      </div>
    </div>
  </section>
  <!-- 商品 -->
  <section class="product">
    <div class="container my-5">
      <!-- 搜尋欄 -->
      <div class="row">
        <div class="d-flex position-relative searchbox">
          <div class="d-flex ms-auto position-relative pe-3" role="search">
            <input class="form-control searchbar" type="search" placeholder="搜尋..." aria-label="Search">
            <i id="searchIcon" class="fa fa-search position-absolute search-icon"></i>
          </div>
          <div class="dropdown d-flex align-items-center">
            <button class="btn btn-outline-light dropdown-toggle text-dark border-dark d-flex justify-content-center align-items-center me-4" type="button" data-bs-toggle="dropdown" aria-expanded="false">
              排序：全部
            </button>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item drop_item" href="#" data-category="all">排序：全部</a></li>
              <li><a class="dropdown-item drop_item" href="#" data-category="手機/平板">排序：手機/平板</a></li>
              <li><a class="dropdown-item drop_item" href="#" data-category="相機/相機配件">排序：相機/相機配件</a></li>
              <li><a class="dropdown-item drop_item" href="#" data-category="電腦/筆電">排序：電腦/筆電</a></li>
            </ul>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-12 col-lg-3 mt-3">
          <div class="list-group list-group-flush d-flex flex-row flex-lg-column overflow-auto flex-nowrap">
            <a href="#" class="list-group-item flex-shrink-0">iPhone</a>
            <a href="#" class="list-group-item flex-shrink-0">iPad</a>
            <a href="#" class="list-group-item flex-shrink-0">安卓手機</a>
            <a href="#" class="list-group-item flex-shrink-0">微單眼/單眼</a>
            <a href="#" class="list-group-item flex-shrink-0">單眼鏡頭</a>
            <a href="#" class="list-group-item flex-shrink-0">數位/拍立得</a>
            <a href="#" class="list-group-item flex-shrink-0">筆記型電腦</a>
            <a href="#" class="list-group-item flex-shrink-0">主機</a>
            <a href="#" class="list-group-item flex-shrink-0">LCD螢幕</a>
          </div>
        </div>
        <div class="col-12 col-lg-9">
          <!-- 商品欄 -->
          <div class="row" id="product_list"></div>
          <div class="row mt-4">
            <div class="col">
              <nav aria-label="Page navigation example">
                <ul class="pagination mt-3 position-relative justify-content-center">
                </ul>
              </nav>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
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
  <button id="backToTop" class="back-to-top"></button>
</body>
</html>