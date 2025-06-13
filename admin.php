<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

// 如果想限制只有 admin 才能進入 admin.php
if ($_SESSION['role'] !== 'admin') {
    echo "無權限訪問此頁面";
    exit;
}
?>
<?php include 'head.php';?>
    <!-- 自定義JS -->
    <script src="js/validate_personalID.js"></script>
    <script src="js/add.js"></script>
    <script src="js/edit.js"></script>
    <script src="js/CRUD.js"></script>
    <script src="js/cart_cnt.js"></script>
    <script>
        $(document).ready(function () {
            $(".drop_item").click(function () {
                $(".dropdown-toggle").html($(this).html());
                $(".drop_item").each(function () {
                    $(this).show();
                })
                $(this).hide();
            });
            
        });
    </script>

</head>

<body>
    <?php include 'header.php'; ?>
    <div class="container py-5">
        <h2 class="text-center py-2">系統管理者後台</h2>
        <!-- 管理介面 -->
        <div id="adminPanel">
            <nav class="nav nav-tabs mt-3">
                <a class="nav-link active" data-bs-toggle="tab" href="#members">會員管理</a>
                <a class="nav-link" data-bs-toggle="tab" href="#subscriber">訂閱管理</a>
                <a class="nav-link" data-bs-toggle="tab" href="#messages">留言管理</a>
                <a class="nav-link" data-bs-toggle="tab" href="#products">商品管理</a>
                <a class="nav-link" data-bs-toggle="tab" href="#shoppingCart">購物車管理</a>
                <a class="nav-link" data-bs-toggle="tab" href="#orders">訂單管理</a>
                <a class="nav-link" data-bs-toggle="tab" href="#orders-items">訂單資料管理</a>
            </nav>

            <div class="tab-content mt-3">
                <div id="members" class="tab-pane fade show active">
                    <h4>會員管理</h4>
                    <!-- 查詢區域 -->
                    <div class="d-flex mb-3">
                        <input type="text" id="search-keyword" class="form-control me-2" placeholder="搜尋會員 (姓名 / 帳號 / Email)">
                        <button class="btn btn-primary" id="search-member-btn">搜尋</button>
                    </div>
                    <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addUserModal">新增會員</button>
                    <div class="list-customerID">
                        
                        <!-- 資料表 -->
                        <table class="table mt-2">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>姓名</th>
                                    <th>帳號</th>
                                    <th>生日</th>
                                    <th>性別</th>
                                    <th>電話</th>
                                    <th>電子郵件</th>
                                    <th>地址</th>
                                    <th>權限</th>
                                    <th>操作</th>
                                </tr>
                            </thead>
                            <tbody id="member-list">
                                <!-- AJAX 載入資料 -->
                            </tbody>
                        </table>

                        <!-- 頁碼容器 -->
                        <nav>
                            <ul class="pagination justify-content-center" id="member-pagination">
                                <!-- AJAX 載入頁碼 -->
                            </ul>
                        </nav>
                    </div>

                </div>
            <div class="tab-content mt-3">
            <div id="subscriber" class="tab-pane fade">
                <h4>訂閱者管理</h4>
                <!-- 搜尋列 -->
                <div class="d-flex mb-3">
                    <input type="text" id="search-subscriber-keyword" class="form-control me-2" placeholder="搜尋訂閱者 (電子郵件)">
                    <button class="btn btn-primary" id="search-subscriber-btn">搜尋</button>
                </div>

                <!-- 訂閱者列表 -->
                <div class="list-subscriberID">
                    <table class="table mt-2">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>電子郵件</th>
                                <th>操作</th>
                            </tr>
                        </thead>
                        <tbody id="subscriber-list">
                            <!-- 資料會由 AJAX 動態填入 -->
                        </tbody>
                    </table>

                    <!-- 分頁 -->
                    <nav>
                        <ul class="pagination justify-content-center" id="subscriber-pagination">
                            <!-- AJAX 載入 -->
                        </ul>
                    </nav>
                </div>
            </div>

                <div id="products" class="tab-pane fade">
                    <h4>商品管理</h4>
                    
                    <!-- 查詢區域 -->
                    <div class="d-flex mb-3">
                        <input type="text" id="search-prod-keyword" class="form-control me-2" placeholder="搜尋商品 (名稱/品牌/分類)">
                        <button class="btn btn-primary" id="search-prod-btn">搜尋</button>
                    </div>

                    <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addProductModal">
                        新增商品
                    </button>
                    <!-- 商品列表 -->
                    <div class="list-prodID mt-3">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>ID</th><th>名稱</th><th>品牌</th><th>顏色</th><th>價格</th><th>功能</th>
                                    <th>分類</th><th>類型</th><th>描述</th><th>次分類</th><th>庫存</th><th>操作</th>
                                </tr>
                            </thead>
                            <tbody id="prod-list">
                                <!-- AJAX 載入資料 -->
                            </tbody>
                        </table>
                        <nav>
                            <ul class="pagination justify-content-center" id="pagination">
                                <!-- AJAX 載入分頁 -->
                            </ul>
                        </nav>
                    </div>
                </div>
                <div id="messages" class="tab-pane fade">
                    <h4>留言管理</h4>
                    <!-- 搜尋區域 -->
                    <div class="d-flex mb-3">
                        <input type="text" id="search-reviews-keyword" class="form-control me-2" placeholder="搜尋留言 (會員/星數/內容)">
                        <button class="btn btn-primary" id="search-reviews-btn">搜尋</button>
                    </div>

                    <!-- 留言列表 -->
                    <div class="list-reviewID">
                        <table class="table mt-2">
                            <thead>
                                <tr>
                                    <th>留言ID</th>
                                    <th>時間</th>
                                    <th>商品ID</th>
                                    <th>會員</th>
                                    <th>內容</th>
                                    <th>星數</th>
                                    <th>喜歡數</th>
                                    <th>討厭數</th>
                                    <th>操作</th>
                                </tr>
                            </thead>
                            <tbody id="review-list">
                                <!-- AJAX 資料插入 -->
                            </tbody>
                        </table>
                        <!-- 分頁 -->
                        <nav>
                            <ul class="pagination justify-content-center" id="review-pagination"></ul>
                        </nav>
                    </div>
                </div>

                <div id="orders" class="tab-pane fade">
                    <h4>訂單管理</h4>
                    <!-- 查詢區域 -->
                    <div class="d-flex mb-3">
                        <input type="text" id="search-order-keyword" class="form-control me-2" placeholder="搜尋訂單 (會員帳號/付款狀態/運送狀態)">
                        <button class="btn btn-primary" id="search-order-btn">搜尋</button>
                    </div>

                    <!-- 訂單列表 -->
                    <div class="list-orderID">
                        <table class="table mt-2">
                            <thead>
                                <tr>
                                    <th>訂單編號</th>
                                    <th>會員帳號</th>
                                    <th>總金額</th>
                                    <th>付款狀態</th>
                                    <th>運送狀態</th>
                                    <th>收件地址</th>
                                    <th>操作</th>
                                </tr>
                            </thead>
                            <tbody id="order-list">
                                <!-- AJAX 資料 -->
                            </tbody>
                        </table>
                        <nav>
                            <ul class="pagination justify-content-center" id="order-pagination"></ul>
                        </nav>
                    </div>
                </div>

                <div id="orders-items" class="tab-pane fade">
                    <h4>訂單明細資料管理</h4>
                    <!-- 查詢區域 -->
                    <!-- 查詢區域 -->
                    <div class="d-flex mb-3">
                        <input type="text" id="search-order-items-keyword" class="form-control me-2" placeholder="搜尋訂單明細 (訂單編號/會員帳號)">
                        <button class="btn btn-primary" id="search-order-items-btn">搜尋</button>
                    </div>

                    <!-- 訂單明細列表 -->
                    <div class="list-order-itemsID">
                        <table class="table mt-2">
                            <thead>
                                <tr>
                                    <th>項目ID</th>
                                    <th>訂單編號</th>
                                    <th>產品名稱</th>
                                    <th>價格</th>
                                    <th>數量</th>
                                    <th>顏色</th>
                                    <th>小計</th>
                                </tr>
                            </thead>
                            <tbody id="order-items-list">
                                <!-- AJAX 資料 -->
                            </tbody>
                        </table>
                        <nav>
                            <ul class="pagination justify-content-center" id="order-items-pagination"></ul>
                        </nav>
                    </div>

                </div>

                <div id="shoppingCart" class="tab-pane fade">
                    <h4>購物車管理</h4>
                    <!-- 搜尋 -->
                    <div class="d-flex mb-3">
                        <input type="text" id="search-shoppingcart-keyword" class="form-control me-2" placeholder="搜尋購物車 (會員帳號/產品名稱)">
                        <button class="btn btn-primary" id="search-shoppingcart-btn">搜尋</button>
                    </div>

                    <!-- 資料表 -->
                    <div class="list-shoppingcartID">
                        <table class="table mt-2">
                            <thead>
                                <tr>
                                    <th>購物車編號</th>
                                    <th>會員帳號</th>
                                    <th>產品名稱</th>
                                    <th>數量</th>
                                    <th>價格</th>
                                    <th>建立時間</th>
                                    <th>更新時間</th>
                                    <th>操作</th>
                                </tr>
                            </thead>
                            <tbody id="shoppingcart-list">
                                <!-- AJAX 資料會顯示這裡 -->
                            </tbody>
                        </table>

                        <!-- 分頁 -->
                        <nav>
                            <ul class="pagination justify-content-center" id="shoppingcart-pagination"></ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- 新增會員 Modal -->
    <div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addUserLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">新增會員</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="#" class="form-horizontal" id="form-add-customerID">
                    <div class="modal-body">
                        <div class="form-group py-2">
                            <label for="name" class="form-label">會員姓名</label>
                            <input type="text" name="name" class="form-control" placeholder="ex.王小明" required />
                        </div>
                        <div class="form-group py-2">
                            <label for="birth" class="form-label">出生</label>
                            <input type="text" name="birth" placeholder="xxxx-xx-xx" class="form-control"
                                pattern="^((?:19[2-9]\d{1})|(?:20[0-2][0-9]))\-((?:0?[1-9])|(?:1[0-2]))\-((?:0?[1-9])|(?:[1-2][0-9])|30|31)$" />
                        </div>
                        <div class="form-group py-2">
                            <label for="sex" class="form-label">性別</label>
                            <input type="radio" name="sex" value="M" checked/>男
                            <input type="radio" name="sex" value="F"/>女
                            <input type="radio" name="sex" value="O"/>其他
                        </div>
                        <div class="form-group py-2">
                            <label for="account" class="form-label">帳號</label>
                            <input type="text" name="account" placeholder="Account" class="form-control" required />
                        </div>
                        <div class="form-group py-2">
                            <label for="password" class="form-label">密碼</label>
                            <input type="password" name="password" placeholder="Password" class="form-control"
                                minlength="6" required />
                        </div>
                        <div class="form-group py-2">
                            <label for="phone_number" class="form-label">電話</label>
                            <input type="text" name="phone_number" placeholder="09xx-xxxxxx" class="form-control"
                                pattern="09[0-9]{2}-[0-9]{6}" required />
                        </div>
                        <div class="form-group py-2">
                            <label for="email" class="form-label">電子郵件</label>
                            <input type="email" name="email" placeholder="example@gmail.com" class="form-control"
                                required />
                        </div>
                        <div class="form-group py-2">
                            <label for="location" class="form-label">地址</label>
                            <input type="text" name="location" class="form-control" required />
                        </div>
                        <div class="form-group py-2">
                            <label for="role" class="form-label">權限</label>
                            <input type="radio" name="role" value="user" checked />user
                            <input type="radio" name="role" value="admin" />admin
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            取消
                        </button>
                        <button type="submit" class="btn btn-primary" id="add-saveUserBtn">
                            儲存
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- 新增商品 Modal -->
    <div class="modal fade" id="addProductModal" tabindex="-1" aria-labelledby="addProductLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addProductLabel">新增商品</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="#"class="form-horizontal" id="form-add-productID">
                    <div class="modal-body">
                        <div class="form-group py-2">
                            <label for="productName" class="form-label">商品名稱</label>
                            <input type="text" name="productName" class="form-control" id="add-prodName" required />
                        </div>
                        <div class="form-group py-2">
                            <label for="productBrand" class="form-label">商品品牌</label>
                            <input type="text" name="productBrand" class="form-control" id="add-prodBrand" required/>
                        </div>
                        <div class="form-group py-2">
                            <label for="productColor" class="form-label">商品顏色</label>
                            <input type="text" name="productColor" class="form-control" id="add-prodColor" required/>
                        </div>
                        <div class="form-group py-2">
                            <label for="product_price" class="form-label">商品單價</label>
                            <input type="number" name="product_price" class="form-control" id="add-prodPrice" required />
                        </div>
                        <div class="form-group py-2">
                            <label for="productFunction" class="form-label">商品功能</label>
                            <input type="text" name="productFunction" class="form-control" id="add-prodFunction" required/>
                        </div>
                        
                        <div class="form-group py-2">
                            <label for="productClassifier" class="form-label">商品分類</label>
                            <div class="dropdown d-flex align-items-center">
                                <button
                                    class="btn btn-outline-light dropdown-toggle text-dark border-dark d-flex justify-content-center align-items-center me-4"
                                    id="add-cate-btn" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    相機/相機配件
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a href="#" class="dropdown-item add-main-category-item" data-category="phone">手機/平板</a></li>
                                    <li><a href="#" class="dropdown-item add-main-category-item" data-category="camera">相機/相機配件</a></li>
                                    <li><a href="#" class="dropdown-item add-main-category-item" data-category="computer">電腦/筆電</a></li>
                                </ul>
                                <input type="hidden" name="productClassifier" id="add-product-classifier" required />
                            </div>
                        </div>
                        <div class="form-group py-2">
                            <label for="product_sub_cate" class="form-label">商品次分類</label>
                            <div class="dropdown d-flex align-items-center">
                                <button class="btn btn-outline-light dropdown-toggle text-dark border-dark d-flex justify-content-center align-items-center me-4"
                                        type="button" data-bs-toggle="dropdown" aria-expanded="false" id="add-sub-category-btn">
                                    商品次分類
                                </button>
                                <ul class="dropdown-menu" id="add-sub-category">
                                    <!-- 次分類選項將在這裡生成 -->
                                </ul>
                                <input type="hidden" name="product_sub_cate" id="add-product-sub-cate" required />
                            </div>
                        </div>
                        <div class="form-group py-2">
                            <label for="productType" class="form-label">商品類型</label>
                            <input type="text" name="productType" class="form-control" id="add-prodType" required/>
                        </div>
                        <div class="form-group py-2">
                            <label for="product_description" class="form-label">商品描述</label>
                            <input type="text" name="product_description" class="form-control" id="add-prodDescription" required />
                        </div>
                        <div class="form-group py-2">
                            <label for="product_count" class="form-label">商品庫存</label>
                            <input type="number" name="product_count" class="form-control" id="add-prodAmmount" required />
                        </div>
                        <div class="form-group py-2">
                            <label for="product_pic_location" class="form-label">圖片位址</label>
                            <input type="text" name="product_pic_location" class="form-control" id="add-prodLink" required />
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            取消
                        </button>
                        <button type="submit" class="btn btn-primary" id="add-saveProductBtn">
                            儲存
                        </button>
                    </div>
                </form>
                
            </div>
        </div>
    </div>
    <!-- 編輯會員 Modal-->
    <div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="editUserLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addProductLabel">編輯會員資料</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="#" class="form-horizontal" id="form-edit-customerID">
                    <div class="modal-body">
                        <div class="form-group py-2">
                            <label for="customerID" class="form-label">會員ID</label>
                            <input type="number" name="customerID" class="form-control" id="edit-id" readonly required />
                        </div>
                        <div class="form-group py-2">
                            <label for="name" class="form-label">會員姓名</label>
                            <input type="text" name="name" class="form-control" id="edit-name" required />
                        </div>
                        <div class="form-group py-2">
                            <label for="birth" class="form-label">出生</label>
                            <input type="text" name="birth" class="form-control" id="edit-birthdate"
                                pattern="^((?:19[2-9]\d{1})|(?:20[0-2][0-9]))\-((?:0?[1-9])|(?:1[0-2]))\-((?:0?[1-9])|(?:[1-2][0-9])|30|31)$" />
                        </div>
                        <div class="form-group py-2">
                            <label for="sex" class="form-label">性別</label>
                            <input type="radio" name="sex" value="M" id="edit-gender-m" checked/>男
                            <input type="radio" name="sex" value="F" id="edit-gender-f"/>女
                            <input type="radio" name="sex" value="O" id="edit-gender-o"/>其他
                        </div>
                        <div class="form-group py-2">
                            <label for="account" class="form-label">帳號</label>
                            <input type="text" name="account" class="form-control" id="edit-account" required />
                        </div>
                        <div class="form-group py-2">
                            <label for="phone_number" class="form-label">電話</label>
                            <input type="text" name="phone_number" class="form-control" id="edit-phone"
                                pattern="09[0-9]{2}-[0-9]{6}" required />
                        </div>
                        <div class="form-group py-2">
                            <label for="email" class="form-label">電子郵件</label>
                            <input type="email" name="email" class="form-control" id="edit-email" required />
                        </div>
                        <div class="form-group py-2">
                            <label for="location" class="form-label">地址</label>
                            <input type="text" name="location" class="form-control" id="edit-address" required />
                        </div>
                        <div class="form-group py-2">
                            <label for="role" class="form-label">權限</label>
                            <input type="radio" name="role" value="user" id="edit-role-user" checked/>user
                            <input type="radio" name="role" value="admin" id="edit-role-admin"/>admin
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            取消
                        </button>
                        <button type="submit" class="btn btn-primary" id="edit-saveUserBtn">
                            儲存
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- 編輯商品 Modal -->
    <div class="modal fade" id="editProductModal" tabindex="-1" aria-labelledby="editProductLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editProductLabel">編輯商品</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="#"class="form-horizontal" id="form-edit-productID">
                    <div class="modal-body">
                        <div class="form-group py-2">
                            <label for="productID" class="form-label">商品編號</label>
                            <input type="number" name="productID" class="form-control" id="edit-prodID" readonly required/>
                        </div>
                        <div class="form-group py-2">
                            <label for="productTime" class="form-label">上架時間</label>
                            <input type="text" name="productTime" class="form-control" id="edit-prodTime" required readonly
                                pattern="^((?:19[2-9]\d{1})|(?:20[012][0-9]))\-((?:0?[1-9])|(?:1[0-2]))\-((?:0?[1-9])|(?:[1-2][0-9])|30|31)$" />
                        </div>
                        <div class="form-group py-2">
                            <label for="productName" class="form-label">商品名稱</label>
                            <input type="text" name="productName" class="form-control" id="edit-prodName" required />
                        </div>
                        <div class="form-group py-2">
                            <label for="productBrand" class="form-label">商品品牌</label>
                            <input type="text" name="productBrand" class="form-control" id="edit-prodBrand" required/>
                        </div>
                        <div class="form-group py-2">
                            <label for="productColor" class="form-label">商品顏色</label>
                            <input type="text" name="productColor" class="form-control" id="edit-prodColor" required/>
                        </div>
                        <div class="form-group py-2">
                            <label for="product_price" class="form-label">商品單價</label>
                            <input type="number" name="product_price" class="form-control" id="edit-prodPrice" required />
                        </div>
                        <div class="form-group py-2">
                            <label for="productFunction" class="form-label">商品功能</label>
                            <input type="text" name="productFunction" class="form-control" id="edit-prodFunction" required/>
                        </div>
                        
                        <div class="form-group py-2">
                            <label for="productClassifier" class="form-label">商品分類</label>
                            <div class="dropdown d-flex align-items-center">
                                <button
                                    class="btn btn-outline-light dropdown-toggle text-dark border-dark d-flex justify-content-center align-items-center me-4"
                                    id="edit-cate-btn" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    相機/相機配件
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a href="#" class="dropdown-item main-category-item" data-category="phone">手機/平板</a></li>
                                    <li><a href="#" class="dropdown-item main-category-item" data-category="camera">相機/相機配件</a></li>
                                    <li><a href="#" class="dropdown-item main-category-item" data-category="computer">電腦/筆電</a></li>
                                </ul>
                                <input type="hidden" name="productClassifier" id="edit-product-classifier" required />
                            </div>
                        </div>
                        <div class="form-group py-2">
                            <label for="product_sub_cate" class="form-label">商品次分類</label>
                            <div class="dropdown d-flex align-items-center">
                                <button class="btn btn-outline-light dropdown-toggle text-dark border-dark d-flex justify-content-center align-items-center me-4"
                                        type="button" data-bs-toggle="dropdown" aria-expanded="false" id="sub-category-btn">
                                    商品次分類
                                </button>
                                <ul class="dropdown-menu" id="sub-category">
                                    <!-- 次分類選項將在這裡生成 -->
                                </ul>
                                <input type="hidden" name="product_sub_cate" id="edit-product-sub-cate" required />
                            </div>
                        </div>
                        <div class="form-group py-2">
                            <label for="productType" class="form-label">商品類型</label>
                            <input type="text" name="productType" class="form-control" id="edit-prodType" required/>
                        </div>
                        <div class="form-group py-2">
                            <label for="product_description" class="form-label">商品描述</label>
                            <input type="text" name="product_description" class="form-control" id="edit-prodDescription" required />
                        </div>
                        
                        <div class="form-group py-2">
                            <label for="product_count" class="form-label">商品庫存</label>
                            <input type="number" name="product_count" class="form-control" id="edit-prodAmmount" required />
                        </div>
                        <div class="form-group py-2">
                            <label for="product_pic_location" class="form-label">圖片位址</label>
                            <input type="text" name="product_pic_location" class="form-control" id="edit-prodLink" required />
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            取消
                        </button>
                        <button type="submit" class="btn btn-primary" id="edit-saveProductBtn">
                            儲存
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- 編輯訂單 Modal -->
<div class="modal fade" id="editOrderModal" tabindex="-1" aria-labelledby="editOrderLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editOrderLabel">編輯訂單</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="update_order.php" method="post" id="form-edit-order">
                <div class="modal-body">
                    <input type="hidden" name="order_id" id="edit-order-id" />

                    <div class="form-group py-2">
                        <label for="edit-username" class="form-label">會員帳號</label>
                        <input type="text" name="username" class="form-control" id="edit-member-name" required readonly/>
                    </div>

                    <div class="form-group py-2">
                        <label for="edit-total-amount" class="form-label">訂單總金額</label>
                        <input type="number" name="total_amount" class="form-control" id="edit-total-amount" required readonly/>
                    </div>

                    <div class="form-group py-2">
                        <label for="edit-payment-status" class="form-label">付款狀態</label>
                        <select name="payment_status" class="form-select" id="edit-payment-status" required>
                            <option value="paid">已付款</option>
                            <option value="unpaid">未付款</option>
                        </select>
                    </div>

                    <div class="form-group py-2">
                        <label for="edit-shipping-status" class="form-label">運送狀態</label>
                        <select name="shipping_status" class="form-select" id="edit-shipping-status" required>
                            <option value="pending">待出貨</option>
                            <option value="shipped">已出貨</option>
                            <option value="delivered">已送達</option>
                        </select>
                    </div>

                    <div class="form-group py-2">
                        <label for="edit-shipping-address" class="form-label">收件地址</label>
                        <input type="text" name="shipping_address" class="form-control" id="edit-shipping-address" required />
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">取消</button>
                    <button type="submit" class="btn btn-primary">儲存</button>
                </div>
            </form>
        </div>
    </div>
</div>

</body>

</html>