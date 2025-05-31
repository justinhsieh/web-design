$(document).ready(function(){
    // 搜尋會員
    $("#search-member-btn").on("click", function(){
        let keyword = $("#search-keyword").val();
        $.ajax({
            url: "search_member.php",
            method: "GET",
            data: { keyword: keyword },
            dataType: "json",
            success: function(data){
                let rows = `<tr>
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
                </tr>`;
                if(data.length > 0){
                    data.forEach(function(member){
                        rows += `
                            <tr>
                                <td>${member.id}</td>
                                <td>${member.name}</td>
                                <td>${member.username}</td>
                                <td>${member.birthdate}</td>
                                <td>${member.gender}</td>
                                <td>${member.phone}</td>
                                <td>${member.email}</td>
                                <td>${member.address}</td>
                                <td>${member.role}</td>
                                <td>
                                    <button class='btn btn-warning btn-sm edit-member'
                                        data-bs-toggle='modal'
                                        data-bs-target='#editUserModal'
                                        data-id='${member.id}'
                                        data-name='${member.name}'
                                        data-username='${member.username}'
                                        data-birthdate='${member.birthdate}'
                                        data-gender='${member.gender}'
                                        data-phone='${member.phone}'
                                        data-email='${member.email}'
                                        data-address='${member.address}'
                                        data-role='${member.role}'>
                                        編輯
                                    </button>
                                    <button class='btn btn-danger btn-sm delete-member' data-id='${member.id}'>刪除</button>
                                </td>
                            </tr>
                        `;
                    });
                } else {
                    rows = "<tr><td colspan='10' class='text-center'>找不到符合的會員</td></tr>";
                }
                $("#member-list").html(rows);
            },
            error: function(){
                alert("查詢失敗，請稍後再試");
            }
        });
    });
    // 搜尋訂閱者
    $("#search-subscriber-btn").on("click", function(){
        let keyword = $("#search-subscriber-keyword").val();
        console.log(keyword);
        $.ajax({
            url: "search_subscriber.php",
            method: "GET",
            data: { keyword: keyword },
            dataType: "json",
            success: function(data){
                let rows = `<tr>
                <th>ID</th>
                <th>電子郵件</th>
                <th>操作</th>
                </tr>`;
                if(data.length > 0){
                    data.forEach(function(subscriber){
                        rows += `
                            <tr>
                                <td>${subscriber.id}</td>
                                <td>${subscriber.email}</td>
                                <td>
                                    <button class='btn btn-danger btn-sm delete-subscriber' data-id='${subscriber.id}'>刪除</button>
                                </td>
                            </tr>
                        `;
                    });
                } else {
                    rows = "<tr><td colspan='10' class='text-center'>找不到符合的訂閱者</td></tr>";
                }
                $("#subscriber-list").html(rows);
            },
            error: function(){
                alert("查詢失敗，請稍後再試");
            }
        });
    });
    // 搜尋商品
    $("#search-prod-btn").on("click", function(){
        let keyword = $("#search-prod-keyword").val();
        $.ajax({
            url: "search_product.php",
            method: "GET",
            data: { keyword: keyword },
            dataType: "json",
            success: function(data){
                let rows = `<tr>
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
                </tr>`;
                if(data.length > 0){
                    data.forEach(function(product){
                        rows += `
                            <tr>
                                <td>${product.pid}</td>
                                <td>${product.name}</td>
                                <td>${product.brand}</td>
                                <td>${product.color}</td>
                                <td>${product.price}</td>
                                <td>${product.function}</td>
                                <td>${product.cate}</td>
                                <td>${product.type}</td>
                                <td>${product.description}</td>
                                <td>${product.sub_cate}</td>
                                <td>${product.stock}</td>
                                <td>
                                    <button class='btn btn-warning btn-sm edit-product'
                                        data-bs-toggle='modal'
                                        data-bs-target='#editProductModal'
                                        data-pid='${product.pid}'
                                        data-time='${product.time}'
                                        data-name='${product.name}'
                                        data-brand='${product.brand}'
                                        data-color='${product.color}'
                                        data-price='${product.price}'
                                        data-function='${product.function}'
                                        data-cate='${product.cate}'
                                        data-type='${product.type}'
                                        data-description='${product.description}'
                                        data-sub_cate='${product.sub_cate}'
                                        data-stock='${product.stock}'
                                        data-pic-link='${product.pic}'>
                                        編輯
                                    </button>
                                    <button class='btn btn-danger btn-sm delete-product' data-pid='${product.pid}'>刪除</button>
                                </td>
                            </tr>
                        `;
                    });
                } else {
                    rows = "<tr><td colspan='10' class='text-center'>找不到符合的商品</td></tr>";
                }
                $("#prod-list").html(rows);
            },
            error: function(){
                alert("查詢失敗，請稍後再試");
            }
        });
    });
    // 搜尋留言
    $("#search-reviews-btn").on("click", function(){
        let keyword = $("#search-reviews-keyword").val();
        $.ajax({
            url: "search_reviews.php",
            method: "GET",
            data: { keyword: keyword },
            dataType: "json",
            success: function(data){
                let rows = `<tr>
                <th>留言ID</th>
                <th>時間</th>
                <th>商品ID</th>
                <th>會員</th>
                <th>內容</th>
                <th>星數</th>
                <th>喜歡數</th>
                <th>討厭數</th>
                </tr>`;
                if(data.length > 0){
                    data.forEach(function(review){
                        rows += `
                            <tr>
                                <td>${review.review_id}</td>
                                <td>${review.time}</td>
                                <td>${review.pid}</td>
                                <td>${review.username}</td>
                                <td>${review.comment}</td>
                                <td>${review.rating}</td>
                                <td>${review.like_cnt}</td>
                                <td>${review.unlike_cnt}</td>
                                <td>
                                    <button class='btn btn-danger btn-sm delete-reviews' data-review_id='${review.review_id}'>刪除</button>
                                </td>
                            </tr>
                        `;
                    });
                } else {
                    rows = "<tr><td colspan='10' class='text-center'>找不到符合的留言</td></tr>";
                }
                $("#review-list").html(rows);
            },
            error: function(){
                alert("查詢失敗，請稍後再試");
            }
        });
    });
    $("#search-order-btn").click(function () {
        const keyword = $("#search-order-keyword").val().trim();
        console.log("Order: " + keyword);
        $.ajax({
            url: "search_orders.php",
            type: "POST",
            data: { keyword: keyword },
            success: function (data) {
                let rows = `<tr>
                <th>訂單編號</th>
                <th>會員帳號</th>
                <th>總金額</th>
                <th>付款狀態</th>
                <th>運送狀態</th>
                <th>收件地址</th>
                <th>操作</th>
                </tr>`;
                if(data.length > 0){
                    data.forEach(function(row){
                        rows += `
                            <tr>
                            <td>${row['order_id']}</td>
                            <td>${row['member_name']}</td>
                            <td>${row['total_amount']}</td>
                            <td>${row['payment_status']}</td>
                            <td>${row['shipping_status']}</td>
                            <td>${row['shipping_address']}</td>
                            <td>
                                <button class='btn btn-warning btn-sm edit-order'
                                    data-bs-toggle='modal'
                                    data-bs-target='#editOrderModal'
                                    data-order_id='${row['order_id']}'
                                    data-member_name='${row['member_name']}'
                                    data-total_amount='${row['total_amount']}'
                                    data-payment_status='${row['payment_status']}'
                                    data-shipping_status='${row['shipping_status']}'
                                    data-shipping_address='${row['shipping_address']}'>
                                    編輯
                                </button>
                                <button class='btn btn-danger btn-sm delete-order' data-order_id='${row['order_id']}'>刪除</button>
                            </td>
                        </tr>
                        `;
                    });
                } else {
                    rows = "<tr><td colspan='10' class='text-center'>找不到符合的訂單</td></tr>";
                }
                $("#order-list").html(rows);
            },
            error: function () {
                alert("搜尋失敗，請稍後再試。");
            }
        });
    });
    $("#search-shoppingcart-btn").click(function () {
        const keyword = $("#search-shoppingcart-keyword").val().trim();
        // console.log(keyword);
        $.ajax({
            url: "search_shoppingcart.php",
            type: "POST",
            data: { keyword: keyword },
            dataType: "json",
            success: function (data) {
                let rows = `<tr>
                    <th>購物車編號</th>
                    <th>會員帳號</th>
                    <th>產品名稱</th>
                    <th>數量</th>
                    <th>價格</th>
                    <th>建立時間</th>
                    <th>更新時間</th>
                    <th>操作</th>
                </tr>`;
    
                if (data.length > 0) {
                    data.forEach(function (row) {
                        rows += `
                            <tr>
                                <td>${row.id}</td>
                                <td>${row.member_name}</td>
                                <td>${row.product_name}</td>
                                <td>${row.quantity}</td>
                                <td>${row.price}</td>
                                <td>${row.created_at}</td>
                                <td>${row.update_at}</td>
                                <td>
                                    <button class='btn btn-danger btn-sm delete-shoppingcart' data-shopping_id='${row.id}'>刪除</button>
                                </td>
                            </tr>`;
                    });
                } else {
                    rows += `<tr><td colspan='8' class='text-center'>找不到符合的購物車資料</td></tr>`;
                }
    
                $("#shoppingcart-list").html(rows);
            },
            error: function () {
                alert("搜尋失敗，請稍後再試。");
            }
        });
    });
    
});
