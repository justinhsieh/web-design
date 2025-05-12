$(document).ready(function(){
    $(".edit-member").on("click", function(){
        $("#edit-id").val($(this).data("id"));
        $("#edit-name").val($(this).data("name"));
        $("#edit-account").val($(this).data("username"));
        $("#edit-birthdate").val($(this).data("birthdate"));
        const gender = $(this).data("gender");
        if (gender === "M") {
            $("#edit-gender-m").prop("checked", true);
        } else if (gender === "F") {
            $("#edit-gender-f").prop("checked", true);
        } else if (gender === "O") {
            $("#edit-gender-o").prop("checked", true);
        }
        $("#edit-phone").val($(this).data("phone"));
        $("#edit-email").val($(this).data("email"));
        $("#edit-address").val($(this).data("address"));
        $("#edit-role").val($(this).data("role"));
        const role = $(this).data("role");
        if (role === "user") {
            $("#edit-role-user").prop("checked", true);
        } else if (role === "admin") {
            $("#edit-role-admin").prop("checked", true);
        }
    });
    $(document).on("click", ".edit-product", function(){
        $("#edit-prodID").val($(this).data("pid"));
        $("#edit-prodTime").val($(this).data("time"));
        $("#edit-prodName").val($(this).data("name"));
        $("#edit-prodBrand").val($(this).data("brand"));
        $("#edit-prodColor").val($(this).data("color"));
        $("#edit-prodPrice").val($(this).data("price"));
        $("#edit-prodFunction").val($(this).data("function"));
        
        const mainCategory = $(this).data("cate");
        console.log(mainCategory);
        const mainCategoryName = {
            phone: "手機/平板",
            camera: "相機/相機配件",
            computer: "電腦/筆電"
        }[mainCategory] || "商品分類";
        $("#edit-cate-btn").text(mainCategoryName);
        $("#edit-product-classifier").val(mainCategory);
        
        // 設定次分類
        const subCategory = $(this).data("sub_cate");
        $("#sub-category-btn").text(subCategory || "商品次分類");
        $("#edit-product-sub-cate").val(subCategory);

        $("#edit-product-sub-cate").val($(this).data("sub_cate"));
        $("#edit-prodType").val($(this).data("type"));
        $("#edit-prodDescription").val($(this).data("description"));
        $("#edit-prodAmmount").val($(this).data("stock"));
        $("#edit-prodLink").val($(this).data("pic-link"));
    });
    $("#form-edit-customerID").submit(function(e) {
        e.preventDefault(); // 防止表單默認提交
        const formData = $(this).serialize();
    
        $.ajax({
            url: "update_member.php",
            type: "POST",
            data: formData,
            success: function(response) {
                if (response.status === "SUCCESS") {
                    window.location.href = "admin.php"; // 成功後跳轉
                } else {
                    alert(response.message);
                }
            },
            error: function() {
                alert("發生錯誤，請稍後再試。");
            }
        });
    });

    // 定義主分類對應的次分類
    const subCategories = {
        phone: ["iPad", "iPhone", "安卓手機"],
        camera: ["微單眼/單眼", "單眼鏡頭", "數位/拍立得"],
        computer: ["筆記型電腦", "主機", "LCD螢幕"]
    };

    // 處理主分類選擇
    $(".main-category-item").on("click", function(e){
        e.preventDefault();

        // 更新主分類按鈕名稱
        const mainCategoryName = $(this).text();
        $("#edit-cate-btn").text(mainCategoryName);
        
        // 取得主商品分類
        const categoryKey = $(this).data("category");
        $("#edit-product-classifier").val(categoryKey);

        // 取得對應的次分類
        const subCategoryList = subCategories[categoryKey];

        // 生成次分類選單
        const subCategoryMenu = $("#sub-category");
        subCategoryMenu.empty();
        subCategoryList.forEach(function(sub){
            subCategoryMenu.append(`<li><a class="dropdown-item sub-category-item" data-subcategory="${sub}">${sub}</a></li>`);
        });

        // 預設次分類按鈕文字
        $("#sub-category-btn").text("商品次分類");
        $("#edit-product-sub-cate").val("");
    });

    // 處理次分類選擇
    $("#sub-category").on("click", ".sub-category-item", function(e){
        e.preventDefault();
        $("#sub-category-btn").text($(this).text());
        var selectedSubCategory = $(this).data("subcategory");
        $("#edit-product-sub-cate").val(selectedSubCategory);
    });
});
