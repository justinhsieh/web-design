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
                let rows = "";
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
    $(document).on("click", ".edit-member", function(){
        $("#edit-id").val($(this).data("id"));
        $("#edit-name").val($(this).data("name"));
        $("#edit-account").val($(this).data("username"));
        $("#edit-birthdate").val($(this).data("birthdate"));
        $("#edit-phone").val($(this).data("phone"));
        $("#edit-email").val($(this).data("email"));
        $("#edit-address").val($(this).data("address"));
        $("#edit-role").val($(this).data("role"));

        // 性別設定
        const gender = $(this).data("gender");
        $("input[name='sex'][value='" + gender + "']").prop("checked", true);
    });
    $(document).on("click", ".delete-member", function(){
        const memberId = $(this).data("id");
        if(confirm("確定要刪除這位會員嗎？")){
            $.ajax({
                url: "delete_member.php",
                method: "POST",
                data: { id: memberId },
                success: function(response){
                    alert(response.message);
                    window.location.href = "admin.php";
                },
                error: function(){
                    alert("刪除失敗，請稍後再試");
                }
            });
        }
    });
    // 搜尋商品
    $("#search-prod-btn").on("click", function(){
        let keyword = $("#search-prod-keyword").val();
        $.ajax({
            url: "search_prod.php",
            method: "GET",
            data: { keyword: keyword },
            dataType: "json",
            success: function(data){
                let rows = "";
                if(data.length > 0){
                    data.forEach(function(product){
                        rows += `
                            <tr>
                                <td>${product.pid}</td>
                                <td>${product.name}</td>
                                <td>${product.brand}</td>
                                <td>${product.color}</td>
                                <td>${product.function}</td>
                                <td>${product.cate}</td>
                                <td>${product.type}</td>
                                <td>${product.description}</td>
                                <td>${product.sub_cate}</td>
                                <td>${product.stock}</td>
                                <td>
                                    <button class='btn btn-warning btn-sm edit-prod'
                                        data-bs-toggle='modal'
                                        data-bs-target='#editProductModal'
                                        data-id='${product.pid}'
                                        data-name='${product.name}'
                                        data-brand='${product.brand}'
                                        data-color='${product.color}'
                                        data-price='${product.price}'
                                        data-function='${product.function}'
                                        data-cate='${product.cate}'
                                        data-type='${product.type}'
                                        data-description='${product.description}'
                                        data-sub_cate='${product.sub_cate}'
                                        data-stock='${product.stock}'>
                                        編輯
                                    </button>
                                    <button class='btn btn-danger btn-sm delete-prod' data-id='${product.pid}'>刪除</button>
                                </td>
                            </tr>
                        `;
                    });
                } else {
                    rows = "<tr><td colspan='10' class='text-center'>找不到符合的會員</td></tr>";
                }
                $("#prod-list").html(rows);
            },
            error: function(){
                alert("查詢失敗，請稍後再試");
            }
        });
    });
    $(document).on("click", ".edit-prod", function(){
        $("#edit-prodID").val($(this).data("pid"));
        $("#edit-prodName").val($(this).data("name"));
        $("#edit-prodBrand").val($(this).data("brand"));
        $("#edit-prodColor").val($(this).data("color"));
        $("#edit-prodPrice").val($(this).data("price"));
        $("#edit-prodFunction").val($(this).data("function"));
        $("#edit-prodType").val($(this).data("type"));
        $("#edit-prodDescription").val($(this).data("description"));
        $("#edit-stock").val($(this).data("stock"));

        // 分類設定
        const type = $(this).data("cate");
        $("input[name='sex'][value='" + gender + "']").prop("checked", true);
        // 次分類設定
        
    });
    $(document).on("click", ".delete-member", function(){
        const memberId = $(this).data("id");
        if(confirm("確定要刪除這位會員嗎？")){
            $.ajax({
                url: "delete_member.php",
                method: "POST",
                data: { id: memberId },
                success: function(response){
                    alert(response.message);
                    window.location.href = "admin.php";
                },
                error: function(){
                    alert("刪除失敗，請稍後再試");
                }
            });
        }
    });
});
