$(document).ready(function(){
    let currentMemberPage = 1;
    let currentMemberKeyword = "";
    function loadMembers(page = 1, keyword = '') {
        currentMemberPage = page;
        currentMemberKeyword = keyword;
        $.get("search_member.php", { page, keyword }, function(response) {
            let html = "";
            if (response.members.length > 0) {
                response.members.forEach(member => {
                    html += `
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
                html = `<tr><td colspan='10' class='text-center'>找不到會員資料</td></tr>`;
            }
            $("#member-list").html(html);
    
            // 建立分頁
            let pagination = "";
            for (let i = 1; i <= response.total_pages; i++) {
                pagination += `
                    <li class="page-item ${i === page ? 'active' : ''}">
                        <a class="page-link" href="#" onclick="loadMembers(${i}, '${keyword}')">${i}</a>
                    </li>`;
            }
            $("#member-pagination").html(pagination);
        }, "json");
    }
    
    $("#search-member-btn").on("click", function() {
        let keyword = $("#search-keyword").val();
        loadMembers(1, keyword);
    });
    
    // 預設載入第 1 頁
    $(document).ready(() => {
        loadMembers();
    });
    $('#form-add-customerID').on('submit', function (e) {
        e.preventDefault(); // 阻止預設送出行為
    
        $.ajax({
            url: 'add_member.php',
            type: 'POST',
            data: $(this).serialize(),
            success: function (response) {
                if (response.status === 'SUCCESS') {
                    alert(response.message);
    
                    // 關閉 Modal
                    $('#addUserModal').modal('hide');
                    $('#form-add-customerID')[0].reset(); // 清空表單
    
                    // 跳至最後一頁顯示新會員
                    const lastPage = response.lastPage || 1;
                    // const keyword = $('#search-keyword').val();
                    loadMembers(lastPage, currentMemberKeyword);
                } else {
                    alert(response.message);
                }
            },
            error: function () {
                alert('發生錯誤，請稍後再試。');
            }
        });
    });
    $('#form-edit-customerID').on('submit', function (e) {
        e.preventDefault(); // 阻止預設送出行為
    
        $.ajax({
            url: 'update_member.php',
            type: 'POST',
            data: $(this).serialize(),
            success: function (response) {
                if (response.status === 'SUCCESS') {
                    alert(response.message);
    
                    // 關閉 Modal 並重載目前頁
                    $('#editUserModal').modal('hide');
                    // const currentPage = $('.pagination .page-item.active .page-link').text() || 1;
                    // const keyword = $('#search-keyword').val();
                    console.log(currentMemberKeyword);
                    loadMembers(currentMemberPage, currentMemberKeyword);
                } else {
                    alert(response.message);
                }
            },
            error: function () {
                alert('發生錯誤，請稍後再試。');
            }
        });
    });
    $(document).on("click", ".delete-member", function () {
        const memberId = $(this).data("id");
        console.log("點擊刪除 ID:", memberId); // 除錯
    
        if (confirm("確定要刪除這個會員嗎？")) {
            $.ajax({
                url: "delete_member.php",
                type: "POST",
                dataType: "json", // ← 保證是 JSON 格式
                data: { id: memberId },
                success: function(response) {
                    console.log(response); // 除錯
                    if (response.status === "SUCCESS") {
                        alert(response.message);
                        // const currentPage = $('.pagination .page-item.active .page-link').text() || 1;
                        // const keyword = $('#search-keyword').val();
                        loadMembers(currentMemberPage, currentMemberKeyword); // 更好體驗
                    } else {
                        alert(response.message);
                    }
                },
                error: function(xhr) {
                    console.error("錯誤訊息：", xhr.responseText);
                    alert("發生錯誤，請稍後再試。");
                }
            });
        }
    });
    
    // 搜尋訂閱者
    let currentSubscriberPage = 1;
    let currentSubscriberKeyword = "";
    function loadSubscribers(page = 1, keyword = '') {
        currentSubscriberPage = page;
        currentSubscriberKeyword = keyword;
        $.get("search_subscriber.php", { page, keyword }, function(response) {
            let html = "";
            if (response.subscribers.length > 0) {
                response.subscribers.forEach(sub => {
                    html += `
                        <tr>
                            <td>${sub.id}</td>
                            <td>${sub.email}</td>
                            <td>
                                <button class='btn btn-danger btn-sm delete-subscriber' data-id='${sub.id}'>刪除</button>
                            </td>
                        </tr>
                    `;
                });
            } else {
                html = `<tr><td colspan='3' class='text-center'>找不到訂閱者資料</td></tr>`;
            }
    
            $("#subscriber-list").html(html);
    
            // 分頁
            let pagination = "";
            for (let i = 1; i <= response.total_pages; i++) {
                pagination += `
                    <li class="page-item ${i === page ? 'active' : ''}">
                        <a class="page-link" href="#" onclick="loadSubscribers(${i}, '${keyword}')">${i}</a>
                    </li>`;
            }
            $("#subscriber-pagination").html(pagination);
        }, "json");
    }
    
    $("#search-subscriber-btn").on("click", function() {
        let keyword = $("#search-subscriber-keyword").val();
        loadSubscribers(1, keyword);
    });
    $(document).on("click", ".delete-subscriber", function () {
        const subscriberId = $(this).data("id");
        console.log("刪除訂閱者 ID:", subscriberId); // 除錯
    
        if (confirm("確定要刪除這個訂閱者嗎？")) {
            $.ajax({
                url: "delete_subscriber.php",
                type: "POST",
                dataType: "json", // ← 非常重要，確保 response 可正確解析為 JSON
                data: { id: subscriberId },
                success: function(response) {
                    console.log("刪除回應：", response); // 除錯
                    if (response.status === "SUCCESS") {
                        alert(response.message);
    
                        // 不 reload，直接刷新列表
                        // const currentPage = $('.pagination .page-item.active .page-link').text() || 1;
                        // const keyword = $('#search-subscriber-keyword').val() || '';
                        loadSubscribers(currentSubscriberPage, currentProductKeyword); // 重載訂閱者列表
                    } else {
                        alert(response.message);
                    }
                },
                error: function(xhr) {
                    console.error("刪除失敗：", xhr.responseText); // 除錯
                    alert("發生錯誤，請稍後再試。");
                }
            });
        }
    });
    
    // 預設載入第一頁
    $(document).ready(() => {
        loadSubscribers();
    });
    
    let currentProductPage = 1;
    let currentProductKeyword = "";
    function loadProducts(page = 1, keyword = '') {
        currentProductPage = page;
        currentProductKeyword = keyword;
        console.log(page + " " + keyword + ".");
        $.ajax({
            url: 'search_product.php',
            type: 'GET',
            data: { page: page, keyword: keyword },
            success: function (response) {
                const data = JSON.parse(response);
                $('#prod-list').html(data.products_html);
                $('#pagination').html(data.pagination_html);
            }
        });
    }
    
    $(document).ready(function () {
        loadProducts();
    
        $('#search-prod-btn').click(function () {
            const keyword = $('#search-prod-keyword').val();
            loadProducts(1, keyword);
        });
    
        $(document).on('click', '.page-link', function (e) {
            e.preventDefault();
            const page = $(this).data('page');
            const keyword = $('#search-prod-keyword').val();
            loadProducts(page, keyword);
        });
    });

    $('#form-edit-productID').on('submit', function(e){
        e.preventDefault(); // 阻止表單預設提交
    
        const formData = $(this).serialize();
    
        $.ajax({
            url: 'update_product.php',
            type: 'POST',
            data: formData,
            success: function(response){
                if(response.status === "SUCCESS"){
                    // 關閉 modal
                    $('#editProductModal').modal('hide');
    
                    // 重新載入商品（保持當前頁面與關鍵字）
                    // const currentPage = $('.page-item.active .page-link').data('page') || 1;
                    // const currentKeyword = $('#search-prod-keyword').val();
                    loadProducts(currentProductPage, currentProductKeyword);
                } else {
                    alert('更新失敗：' + (response.message || '請檢查輸入資料'));
                }
            },
            error: function(){
                alert('更新過程發生錯誤');
            }
        });
    });
    $('#form-add-productID').on('submit', function(e) {
        e.preventDefault(); // 阻止表單提交預設行為
    
        const formData = $(this).serialize();
    
        $.ajax({
            url: 'add_product.php',
            method: 'POST',
            data: formData,
            success: function(response) {
                if (response.status === 'SUCCESS') {
                    $('#addProductModal').modal('hide');
                    $('#form-add-productID')[0].reset();
    
                    const lastPage = response.lastPage || 1;
                    const currentKeyword = $('#search-prod-keyword').val();
                    loadProducts(lastPage, currentKeyword);
                } else {
                    alert('新增失敗：' + (response.message || '請檢查輸入資料'));
                }
            },
            error: function() {
                alert('新增過程發生錯誤');
            }
        });
    });
    $(document).on("click", ".delete-product", function () {
        const prodId = $(this).data("pid");
    
        if (confirm("確定要刪除這個商品嗎？")) {
            $.ajax({
                url: "delete_product.php",
                type: "POST",
                data: { pid: prodId },
                success: function(response) {
                    if (response.status === "SUCCESS") {
                        alert(response.message);
    
                        const currentKeyword = $('#search-prod-keyword').val();
                        loadProducts(currentProductPage, currentKeyword);
                    } else {
                        alert(response.message);
                    }
                },
                error: function() {
                    alert("發生錯誤，請稍後再試。");
                }
            });
        }
    });
    
    
    // 搜尋留言
    let currentReviewsPage = 1;
    let currentReviewsKeyword = "";
    function loadReviews(page = 1, keyword = '') {
        currentReviewsPage = page;
        currentReviewsKeyword = keyword;
        $.get("search_reviews.php", { page, keyword }, function(response) {
            let html = "";
            if (response.reviews.length > 0) {
                response.reviews.forEach(r => {
                    html += `
                        <tr>
                            <td>${r.review_id}</td>
                            <td>${r.time}</td>
                            <td>${r.pid}</td>
                            <td>${r.username}</td>
                            <td>${r.comment}</td>
                            <td>${r.rating}</td>
                            <td>${r.like_cnt}</td>
                            <td>${r.unlike_cnt}</td>
                            <td>
                                <button class='btn btn-danger btn-sm delete-reviews' data-review_id='${r.review_id}'>刪除</button>
                            </td>
                        </tr>`;
                });
            } else {
                html = `<tr><td colspan='9' class='text-center'>查無留言資料</td></tr>`;
            }
    
            $("#review-list").html(html);
    
            // 建立分頁
            let pagination = "";
            for (let i = 1; i <= response.total_pages; i++) {
                pagination += `
                    <li class="page-item ${i === page ? 'active' : ''}">
                        <a class="page-link" href="#" onclick="loadReviews(${i}, '${keyword}')">${i}</a>
                    </li>`;
            }
            $("#review-pagination").html(pagination);
        }, "json");
    }
    
    $("#search-reviews-btn").on("click", function () {
        const keyword = $("#search-reviews-keyword").val();
        loadReviews(1, keyword);
    });
    
    $(document).ready(() => {
        loadReviews();
    });
    $(document).on("click", ".delete-reviews", function () {
        const reviewId = $(this).data("review_id");
        console.log("要刪除的留言 ID:", reviewId);
    
        if (confirm("確定要刪除這個留言嗎?")) {
            $.ajax({
                url: "delete_review.php",
                type: "POST",
                dataType: "json", // ← 關鍵：確保 response 正確解析為 JSON
                data: { reviewid: reviewId },
                success: function (response) {
                    console.log("刪除回應：", response); // 除錯用
    
                    if (response.status === "SUCCESS") {
                        alert(response.message);
    
                        // 取得目前分頁與關鍵字
                        // const currentPage = $('.pagination .page-item.active .page-link').text() || 1;
                        // const keyword = $('#search-review-keyword').val() || '';
                        loadReviews(currentReviewsPage, currentReviewsKeyword); // 重載評論資料
                    } else {
                        alert(response.message);
                    }
                },
                error: function (xhr) {
                    console.error("刪除失敗：", xhr.responseText);
                    alert("發生錯誤，請稍後嘗試");
                }
            });
        }
    });
    
    
    let currentOrderItemsPage = 1;
    let currentOrderItemsKeyword = "";

    function loadOrderItems(page = 1, keyword = '') {
        currentOrderItemsPage = page;
        currentOrderItemsKeyword = keyword;

        $.get("search_order_items.php", { page, keyword }, function (response) {
            let html = "";
            if (response.records.length > 0) {
                response.records.forEach(item => {
                    html += `
                        <tr>
                            <td>${item.id}</td>
                            <td>${item.order_id}</td>
                            <td>${item.product_name}</td>
                            <td>${item.price}</td>
                            <td>${item.quantity}</td>
                            <td>${item.color}</td>
                            <td>${item.subtotal}</td>
                        </tr>`;
                });
            } else {
                html = `<tr><td colspan="7" class="text-center">查無資料</td></tr>`;
            }

            $("#order-items-list").html(html);

            let pag = "";
            for (let i = 1; i <= response.total_pages; i++) {
                pag += `<li class="page-item ${i === page ? 'active' : ''}">
                            <a class="page-link" href="#" onclick="loadOrderItems(${i}, '${keyword}')">${i}</a>
                        </li>`;
            }
            $("#order-items-pagination").html(pag);
        }, "json");
    }

    $("#search-order-items-btn").on("click", function () {
        const keyword = $("#search-order-items-keyword").val().trim();
        loadOrderItems(1, keyword);
    });

    // 初始化
    $(document).ready(() => {
        loadOrderItems();
    });
    let currentOrdersPage = 1;
    let currentOrdersKeyword = '';

    function loadOrders(page = 1, keyword = '') {
        currentOrdersPage = page;
        currentOrdersKeyword = keyword;
        $.get("search_orders.php", { page, keyword }, function (response) {
            let html = "";
            if (response.records.length > 0) {
                response.records.forEach(o => {
                    html += `
                        <tr>
                            <td>${o.order_id}</td>
                            <td>${o.member_name}</td>
                            <td>${o.total_amount}</td>
                            <td>${o.payment_status}</td>
                            <td>${o.shipping_status}</td>
                            <td>${o.shipping_address}</td>
                            <td>
                                <button class='btn btn-warning btn-sm edit-order'
                                    data-bs-toggle='modal'
                                    data-bs-target='#editOrderModal'
                                    data-order_id='${o.order_id}'
                                    data-member_name='${o.member_name}'
                                    data-total_amount='${o.total_amount}'
                                    data-payment_status='${o.payment_status}'
                                    data-shipping_status='${o.shipping_status}'
                                    data-shipping_address='${o.shipping_address}'>
                                    編輯
                                </button>
                                <button class='btn btn-danger btn-sm delete-order' data-order_id='${o.order_id}'>刪除</button>
                            </td>
                        </tr>`;
                });
            } else {
                html = `<tr><td colspan="7" class="text-center">查無訂單資料</td></tr>`;
            }
    
            $("#order-list").html(html);
    
            // 分頁
            let pag = "";
            for (let i = 1; i <= response.total_pages; i++) {
                pag += `<li class="page-item ${i === page ? 'active' : ''}">
                            <a class="page-link" href="#" onclick="loadOrders(${i}, '${keyword}')">${i}</a>
                        </li>`;
            }
            $("#order-pagination").html(pag);
        }, "json");
    }
    $("#form-edit-order").on("submit", function (e) {
        e.preventDefault(); // 防止表單預設提交動作

        $.post("update_order.php", $(this).serialize(), function (res) {
            if (res.success) {
                $('#editOrderModal').modal('hide');
                // 重新載入訂單列表，保留原本查詢條件與分頁（此處假設全域變數儲存）
                loadOrders(currentOrdersPage, currentOrdersKeyword); 
            } else {
                alert("更新失敗，請稍後再試");
            }
        }, "json");
    });

    $("#search-order-btn").on("click", function () {
        const keyword = $("#search-order-keyword").val();
        loadOrders(1, keyword);
    });
    
    $(document).ready(() => {
        loadOrders();
    });
    $(document).on("click", ".delete-order", function () {
        const orderId = $(this).data("order_id");
    
        if (confirm("確定要刪除此訂單嗎？")) {
            $.ajax({
                url: "delete_order.php",
                type: "POST",
                dataType: "json",
                data: { order_id: orderId },
                success: function (response) {
                    if (response.status === "SUCCESS") {
                        alert(response.message);
                        loadOrders(currentOrdersPage, currentOrdersKeyword);
                    } else {
                        alert(response.message);
                    }
                },
                error: function () {
                    alert("刪除失敗，請稍後再試。");
                }
            });
        }
    });
    
    //購物車
    let currentShoppingCartPage = 1;
    let currentShoppingCartKeyword = '';
    function loadShoppingCart(page = 1, keyword = '') {
        currentShoppingCartPage = page;
        currentShoppingCartKeyword = keyword;
        $.get("search_shoppingcart.php", { page, keyword }, function (response) {
            let html = "";
            if (response.records.length > 0) {
                response.records.forEach(r => {
                    html += `
                        <tr>
                            <td>${r.id}</td>
                            <td>${r.member_name}</td>
                            <td>${r.product_name}</td>
                            <td>${r.quantity}</td>
                            <td>${r.price}</td>
                            <td>${r.created_at}</td>
                            <td>${r.update_at}</td>
                            <td>
                                <button class='btn btn-danger btn-sm delete-shoppingcart' data-shopping_id='${r.id}'>刪除</button>
                            </td>
                        </tr>`;
                });
            } else {
                html = `<tr><td colspan="8" class="text-center">查無資料</td></tr>`;
            }
    
            $("#shoppingcart-list").html(html);
    
            // 分頁
            let pag = "";
            for (let i = 1; i <= response.total_pages; i++) {
                pag += `
                    <li class="page-item ${i === page ? 'active' : ''}">
                        <a class="page-link" href="#" onclick="loadShoppingCart(${i}, '${keyword}')">${i}</a>
                    </li>`;
            }
            $("#shoppingcart-pagination").html(pag);
        }, "json");
    }
    
    $("#search-shoppingcart-btn").on("click", function () {
        const keyword = $("#search-shoppingcart-keyword").val();
        loadShoppingCart(1, keyword);
    });
    
    $(document).ready(() => {
        loadShoppingCart();
    });
    $(document).on("click", ".delete-shoppingcart", function () {
        const shopping_id = $(this).data("shopping_id");
    
        if (confirm("確定要刪除這筆購物車資料嗎？")) {
            $.ajax({
                url: "delete_shoppingcart.php",
                type: "POST",
                dataType: "json", // ← 確保 response 是 JSON
                data: { id: shopping_id },
                success: function (response) {
                    if (response.status === "SUCCESS") {
                        alert(response.message);
                        // const currentPage = $('.pagination .page-item.active .page-link').text() || 1;
                        // const keyword = $('#search-shoppingcart-keyword').val() || '';
                        loadShoppingCart(currentShoppingCartPage, currentShoppingCartKeyword);
                    } else {
                        alert(response.message);
                    }
                },
                error: function () {
                    alert("刪除失敗，請稍後再試。");
                }
            });
        }
    });
    
    
});
