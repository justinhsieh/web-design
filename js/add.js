$(document).ready(function () {
        // 定義主分類對應的次分類
    const subCategories = {
        phone: ["iPad", "iPhone", "安卓手機"],
        camera: ["微單眼/單眼", "單眼鏡頭", "數位/拍立得"],
        computer: ["筆記型電腦", "主機", "LCD螢幕"]
    };

    // 處理主分類選擇
    $(".add-main-category-item").on("click", function(e){
        e.preventDefault();

        // 更新主分類按鈕名稱
        const mainCategoryName = $(this).text();
        $("#add-cate-btn").text(mainCategoryName);

        // 取得主商品分類
        const categoryKey = $(this).data("category");
        $("#add-product-classifier").val(categoryKey);
        
        // 取得對應的次分類
        const subCategoryList = subCategories[categoryKey];

        // 生成次分類選單
        const subCategoryMenu = $("#add-sub-category");
        subCategoryMenu.empty();
        subCategoryList.forEach(function(sub){
            subCategoryMenu.append(`<li><a class="dropdown-item add-sub-category-item" data-subcategory="${sub}">${sub}</a></li>`);
        });

        // 預設次分類按鈕文字
        $("#add-sub-category-btn").text("商品次分類");
        $("#add-product-sub-cate").val("");
    });

    // 處理次分類選擇
    $("#add-sub-category").on("click", ".add-sub-category-item", function(e){
        e.preventDefault();
        $("#add-sub-category-btn").text($(this).text());
        var selectedSubCategory = $(this).data("subcategory");
        $("#add-product-sub-cate").val(selectedSubCategory);
    });
});