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
    <script src="js/cancel.js"></script>
    <script src="js/search.js"></script>
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
            </nav>

            <div class="tab-content mt-3">
                <div id="members" class="tab-pane fade show active">
                    <h4>會員管理</h4>
                    <!-- 查詢區域 -->
                    <div class="mt-3">
                        <input type="text" id="search-keyword" class="form-control" placeholder="搜尋會員 (姓名/帳號/電子郵件)">
                        <button class="btn btn-primary mt-2" id="search-member-btn">搜尋</button>
                    </div>

                    <!-- 會員列表 -->
                    <div class="list-customerID">
                        <table class="table mt-2">
                            <tbody id="member-list">
                                <!-- 結果將顯示在這裡 -->
                            </tbody>
                        </table>
                    </div>
                    <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addUserModal">新增會員</button>
                    <div class="list-customerID">
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
                            <tbody>
                                <?php
                                include("db.php");
                                $sql = "SELECT * FROM member";
                                $result = $conn->query($sql);
                                if($result->num_rows > 0){
                                    while($row = $result->fetch_assoc()){
                                        echo "<tr>
                                                <td>{$row['id']}</td>
                                                <td>{$row['name']}</td>
                                                <td>{$row['username']}</td>
                                                <td>{$row['birthdate']}</td>
                                                <td>{$row['gender']}</td>
                                                <td>{$row['phone']}</td>
                                                <td>{$row['email']}</td>
                                                <td>{$row['address']}</td>
                                                <td>{$row['role']}</td>
                                                <td>
                                                  <button class='btn btn-warning btn-sm edit-member'
                                                          data-bs-toggle='modal'
                                                          data-bs-target='#editUserModal'
                                                          data-id='{$row['id']}'
                                                          data-name='{$row['name']}'
                                                          data-username='{$row['username']}'
                                                          data-birthdate='{$row['birthdate']}'
                                                          data-gender='{$row['gender']}'
                                                          data-phone='{$row['phone']}'
                                                          data-email='{$row['email']}'
                                                          data-address='{$row['address']}'
                                                          data-role='{$row['role']}'>
                                                          編輯
                                                  </button>
                                                  <button class='btn btn-danger btn-sm delete-member' data-id='{$row['id']}'>刪除</button>
                                                </td>
                                              </tr>";
                                    }
                                }else{
                                    echo "<tr><td colspan='10' class='text-center'>尚無會員資料</td></tr>";
                                }
                                $conn->close();
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            <div class="tab-content mt-3">
                <div id="subscriber" class="tab-pane fade">
                    <h4>訂閱者管理</h4>
                    <!-- 查詢區域 -->
                    <div class="mt-3">
                        <input type="text" id="search-subscriber-keyword" class="form-control" placeholder="搜尋訂閱者 (會員電子郵件)">
                        <button class="btn btn-primary mt-2" id="search-subscriber-btn">搜尋</button>
                    </div>

                    <!-- 訂閱者列表 -->
                    <div class="list-customerID">
                        <table class="table mt-2">
                            <tbody id="subscriber-list">
                                <!-- 結果將顯示在這裡 -->
                            </tbody>
                        </table>
                    </div>
                    <!-- <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addSubscriberModal">新增訂閱者</button> -->
                    <div class="list-subscriberID">
                        <table class="table mt-2">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>電子郵件</th>
                                    <th>操作</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                include("db.php");
                                $sql = "SELECT * FROM subscriber";
                                $result = $conn->query($sql);
                                if($result->num_rows > 0){
                                    while($row = $result->fetch_assoc()){
                                        echo "<tr>
                                                <td>{$row['id']}</td>
                                                <td>{$row['email']}</td>
                                                <td>
                                                  <button class='btn btn-danger btn-sm delete-subscriber' data-id='{$row['id']}'>刪除</button>
                                                </td>
                                              </tr>";
                                    }
                                }else{
                                    echo "<tr><td colspan='10' class='text-center'>尚無訂閱者資料</td></tr>";
                                }
                                $conn->close();
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div id="products" class="tab-pane fade">
                    <h4>商品管理</h4>
                    
                    <!-- 查詢區域 -->
                    <div class="mt-3">
                        <input type="text" id="search-prod-keyword" class="form-control" placeholder="搜尋商品 (名稱/品牌/分類)">
                        <button class="btn btn-primary mt-2" id="search-prod-btn">搜尋</button>
                    </div>

                    <!-- 商品列表 -->
                    <div class="list-prodID">
                        <table class="table mt-2">
                            <tbody id="prod-list">
                                <!-- 結果將顯示在這裡 -->
                            </tbody>
                        </table>
                    </div>
                    <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addProductModal">
                        新增商品
                    </button>
                    <div class="list-prodID">
                        <table class="table mt-2">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>名稱</th>
                                    <th>品牌</th>
                                    <th>顏色</th>
                                    <th>價格</th>
                                    <th>功能</th>
                                    <th>分類</th>
                                    <th>類型</th>
                                    <th>描述</th>
                                    <th>次分類</th>
                                    <th>庫存</th>
                                    <th>操作</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    include "db.php";
                                    $sql = "SELECT * FROM product";
                                    $result = $conn->query($sql);
                                    if($result->num_rows > 0){
                                        while($row = $result->fetch_assoc()){
                                            echo "<tr>
                                                <td>{$row['pid']}</td>
                                                <td>{$row['name']}</td>
                                                <td>{$row['brand']}</td>
                                                <td>{$row['color']}</td>
                                                <td>{$row['price']}</td>
                                                <td>{$row['function']}</td>
                                                <td>{$row['cate']}</td>
                                                <td>{$row['type']}</td>
                                                <td>{$row['description']}</td>
                                                <td>{$row['sub_cate']}</td>
                                                <td>{$row['stock']}</td>
                                                <td>
                                                    <button class='btn btn-warning btn-sm edit-product'
                                                            data-bs-toggle='modal'
                                                            data-bs-target='#editProductModal'
                                                            data-pid='{$row['pid']}'
                                                            data-time='{$row['time']}'
                                                            data-name='{$row['name']}'
                                                            data-brand='{$row['brand']}'
                                                            data-color='{$row['color']}'
                                                            data-price='{$row['price']}'
                                                            data-function='{$row['function']}'
                                                            data-cate='{$row['cate']}'
                                                            data-type='{$row['type']}'
                                                            data-description='{$row['description']}'
                                                            data-sub_cate='{$row['sub_cate']}'
                                                            data-stock='{$row['stock']}'
                                                            data-pic-link='{$row['pic']}'>
                                                            編輯
                                                    </button>
                                                    <button class='btn btn-danger btn-sm delete-product' data-pid='{$row['pid']}'>刪除</button>
                                                </td>
                                                </tr>";
                                        }
                                    }else{
                                        echo "<tr><td colspan='12' class='text-center'>尚無商品資料</td></tr>";
                                    }
                                    $conn->close();
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div id="messages" class="tab-pane fade">
                    <h4>留言管理</h4>
                    <!-- 查詢區域 -->
                    <div class="mt-3">
                        <input type="text" id="search-reviews-keyword" class="form-control" placeholder="搜尋留言 (會員/星數/內容)">
                        <button class="btn btn-primary mt-2" id="search-reviews-btn">搜尋</button>
                    </div>

                    <!-- 留言列表 -->
                    <div class="list-reviewID">
                        <table class="table mt-2">
                            <tbody id="review-list">
                                <!-- 結果將顯示在這裡 -->
                            </tbody>
                        </table>
                    </div>
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
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    include "db.php";
                                    $sql = "SELECT * FROM reviews";
                                    $result = $conn->query($sql);
                                    if($result->num_rows > 0){
                                        while($row = $result->fetch_assoc()){
                                            echo "<tr>
                                                <td>{$row['review_id']}</td>
                                                <td>{$row['time']}</td>
                                                <td>{$row['pid']}</td>
                                                <td>{$row['username']}</td>
                                                <td>{$row['comment']}</td>
                                                <td>{$row['rating']}</td>
                                                <td>{$row['like_cnt']}</td>
                                                <td>{$row['unlike_cnt']}</td>
                                                <td>
                                                    <button class='btn btn-danger btn-sm delete-reviews' data-review_id='{$row['review_id']}'>刪除</button>
                                                </td>
                                                </tr>";
                                        }
                                    }else{
                                        echo "<tr><td colspan='12' class='text-center'>尚無留言資料</td></tr>";
                                    }
                                    $conn->close();
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div id="orders" class="tab-pane fade">
                    <h4>訂單管理</h4>
                    <!-- 查詢區域 -->
                    <div class="mt-3">
                        <input type="text" id="search-order-keyword" class="form-control" placeholder="搜尋訂單 (會員帳號/付款狀態/運送狀態)">
                        <button class="btn btn-primary mt-2" id="search-order-btn">搜尋</button>
                    </div>

                    <!-- 訂單列表 -->
                    <div class="list-orderID">
                        <table class="table mt-2">
                            <tbody id="order-list">
                                <!-- 結果將顯示在這裡 -->
                            </tbody>
                        </table>
                    </div>
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
                        <tbody>
                            <?php
                                include "db.php";
                                $sql = "SELECT o.order_id, 
                                               m.name AS member_name,
                                               o.order_date,
                                               o.total_amount,
                                               o.payment_status,
                                               o.shipping_status,
                                               o.shipping_address
                                        FROM orders o
                                        JOIN member m ON o.user_id = m.id
                                        ORDER BY o.order_date DESC";
                                $result = $conn->query($sql);
                                if($result->num_rows > 0){
                                    while($row = $result->fetch_assoc()){
                                        echo "<tr>
                                                    <td>{$row['order_id']}</td>
                                                    <td>{$row['member_name']}</td>
                                                    <td>{$row['total_amount']}</td>
                                                    <td>{$row['payment_status']}</td>
                                                    <td>{$row['shipping_status']}</td>
                                                    <td>{$row['shipping_address']}</td>
                                                    <td>
                                                      <button class='btn btn-warning btn-sm edit-member'
                                                              data-bs-toggle='modal'
                                                              data-bs-target='#editOrderModal'
                                                              data-order_id='{$row['order_id']}'
                                                              data-member_name='{$row['member_name']}'
                                                              data-total_amount='{$row['total_amount']}'
                                                              data-payment_status='{$row['payment_status']}'
                                                              data-shipping_status='{$row['shipping_status']}'
                                                              data-shipping_address='{$row['shipping_address']}'>
                                                              編輯
                                                      </button>
                                                      <button class='btn btn-danger btn-sm delete-order' data-order_id='{$row['order_id']}'>刪除</button>
                                                    </td>
                                                  </tr>";
                                    }
                                }else{
                                    echo "<tr><td colspan=9 class='text-center'>尚無訂單資料</td></tr>";
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
                <div id="shoppingCart" class="tab-pane fade">
                    <h4>購物車管理</h4>
                    <!-- 查詢區域 -->
                    <div class="mt-3">
                        <input type="text" id="search-shoppingcart-keyword" class="form-control" placeholder="搜尋購物車 (會員帳號/產品名稱)">
                        <button class="btn btn-primary mt-2" id="search-shoppingcart-btn">搜尋</button>
                    </div>

                    <!-- 訂單列表 -->
                    <div class="list-shoppingcartID">
                        <table class="table mt-2">
                            <tbody id="shoppingcart-list">
                                <!-- 結果將顯示在這裡 -->
                            </tbody>
                        </table>
                    </div>
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
                        <tbody>
                            <?php
                                include "db.php";
                                $sql = "SELECT sc.*, 
                                        m.name AS member_name, 
                                        p.name AS product_name 
                                        FROM shoppingcart sc
                                        JOIN member m ON sc.user_id = m.id
                                        JOIN product p ON sc.product_id = p.pid
                                        ORDER BY sc.created_at DESC";
                                $result = $conn->query($sql);
                                if($result->num_rows > 0){
                                    while($row = $result->fetch_assoc()){
                                        echo "<tr>
                                                    <td>{$row['id']}</td>
                                                    <td>{$row['member_name']}</td>
                                                    <td>{$row['product_name']}</td>
                                                    <td>{$row['quantity']}</td>
                                                    <td>{$row['price']}</td>
                                                    <td>{$row['created_at']}</td>
                                                    <td>{$row['update_at']}</td>
                                                    <td>
                                                      <button class='btn btn-danger btn-sm delete-shoppingcart' data-shopping_id='{$row['id']}'>刪除</button>
                                                    </td>
                                                  </tr>";
                                    }
                                }else{
                                    echo "<tr><td colspan=9 class='text-center'>尚無購物車資料</td></tr>";
                                }
                            ?>
                        </tbody>
                    </table>
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
                <form action="add_member.php" method="post" class="form-horizontal" id="form-add-customerID">
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
    
    <!-- 新增訂閱者 Modal -->
    <!-- <div class="modal fade" id="addSubscriberModal" tabindex="-1" aria-labelledby="addSubscriberLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <form id="form-add-subscriber" method="post" action="add_subscriber.php">
            <div class="modal-header">
            <h5 class="modal-title">新增訂閱者</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="關閉"></button>
            </div>
            <div class="modal-body">
                <div class="form-group py-2">
                    <label for="email" class="form-label">電子郵件</label>
                    <input type="email" name="email" id="subscriberEmail" class="form-control" required placeholder="example@gmail.com" />
                </div>
                <div class="alert alert-danger d-none" id="email-exists-alert">此電子郵件已是會員，無需訂閱</div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">取消</button>
                <button type="submit" class="btn btn-primary">儲存</button>
            </div>
        </form>
        </div>
    </div>
    </div> -->


    <!-- 新增商品 Modal -->
    <div class="modal fade" id="addProductModal" tabindex="-1" aria-labelledby="addProductLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addProductLabel">新增商品</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="add_product.php" method="post" class="form-horizontal" id="form-add-productID">
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
                <form action="update_member.php" method="post" class="form-horizontal" id="form-edit-customerID">
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
                <form action="update_product.php" method="post" class="form-horizontal" id="form-edit-productID">
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