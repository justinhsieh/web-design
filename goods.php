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
            email:"請輸入正確的電子信箱格式"
        }
      },
      errorPlacement: function (error, element) {
        $("#error-container").html(error);
      }
    });

    //載入商品
    function loadProducts(page, category, subcategory,keyword = '') {
      $.get('get_products.php', {
        page: page,
        category: category,
        subcategory: subcategory,
        keyword:keyword
      }, function (response) {
        $('#product_list').html(response.products_html);
        generatePagination(page, response.total_pages);
        currentCategory = category;
        currentSubcategory = subcategory;
      }, 'json');
    }
    //產生分頁按鈕
    function generatePagination(currentPage, totalPages) {
      let html = '';

      if(totalPages > 0){
        html += `<li class="page-item page_f ${currentPage === 1 ? 'disabled' : ''}">
          <a class="page-link text-dark" href="#" data-page="1" aria-label="First">
            <span aria-hidden="true">&laquo;</span>
          </a>
        </li>`;
      }
      
      for (let i = 1; i <= totalPages; i++) {
        html += `<li class="page-item page_ ${i === currentPage ? 'active' : ''}">
          <a class="page-link text-dark" href="#" data-page="${i}">${i}</a>
        </li>`;
      }
      if(totalPages > 0){
        html += `<li class="page-item page_e ${currentPage === totalPages ? 'disabled' : ''}">
          <a class="page-link text-dark" href="#" data-page="${totalPages}" aria-label="Last">
            <span aria-hidden="true">&raquo;</span>
          </a>
        </li>`;
      }
      $('.pagination').html(html);
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
        <div class="col-12 col-md-4 col-lg-3 mt-3">
          <div class="list-group list-group-flush d-flex flex-row flex-md-column overflow-auto flex-nowrap">
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
        <div class="col-12 col-md-8 col-lg-9">
          <!-- 商品欄 -->
          <div class="row justify-content-center" id="product_list"></div>
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
  <button id="backToTop" class="back-to-top"></button>
</body>
</html>
