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
});
