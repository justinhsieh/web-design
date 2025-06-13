$(document).ready(function(){
    $(document).on("click", ".edit-member", function(){
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
        $("#edit-cate-btn").text(mainCategory);
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
    $(document).on('click', '.edit-order', function () {
        $('#edit-order-id').val($(this).data('order_id'));
        $('#edit-member-name').val($(this).data('member_name'));
        $('#edit-total-amount').val($(this).data('total_amount'));
        $('#edit-payment-status').val($(this).data('payment_status'));
        $('#edit-shipping-status').val($(this).data('shipping_status'));
        $('#edit-shipping-address').val($(this).data('shipping_address'));
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
