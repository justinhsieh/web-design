$(document).ready(function($){    
    $("#form-personalID, #form-add-customerID").validate({
        submitHandler: function(form){
            form.submit();
        },
        rules: {},
        messages: {
            name: {
                required: "姓名為必填欄位"
            },
            birth: {
                pattern: "生日格式錯誤"
            },
            account:{
                account: "帳號為必填欄位"
            },
            password:{
                required: "密碼為必填欄位",
                minlength: "密碼至少需6位"
            },
            phone_number:{
                required: "電話為必填欄位",
                pattern: "電話格式錯誤"
            },
            email:{
                required: "電子郵件為必填欄位",
                email: "電子郵件格式錯誤"
            },
            location:{
                required: "地址為必填欄位"
            }
        }
    })
    $("#form-edit-customerID").validate({
        submitHandler: function(form){
            alert("會員資料已儲存!");
            form.submit();
        },
        rules: {},
        messages: {
            customerID:{
                required: "ID為必填欄位"
            },
            name: {
                required: "姓名為必填欄位"
            },
            birth: {
                pattern: "生日格式錯誤"
            },
            account:{
                account: "帳號為必填欄位"
            },
            password:{
                required: "密碼為必填欄位",
                minlength: "密碼至少需6位"
            },
            phone_number:{
                required: "電話為必填欄位",
                pattern: "電話格式錯誤"
            },
            email:{
                required: "電子郵件為必填欄位",
                email: "電子郵件格式錯誤"
            },
            location:{
                required: "地址為必填欄位"
            }
        }
    })
    // $("#form-add-subscriber").validate({
    //     submitHandler: function(form) {
    //         const email = $("#subscriberEmail").val();
    
    //         // 檢查是否是會員（AJAX 非同步查詢）
    //         $.post("check_member_email.php", { email: email }, function(data) {
    //             if (data.exists) {
    //                 $("#email-exists-alert").removeClass("d-none");
    //             } else {
    //                 $("#email-exists-alert").addClass("d-none");
    //                 form.submit(); // 提交表單
    //             }
    //         }, "json");
    //     },
    //     rules: {
    //         email: {
    //             required: true,
    //             email: true
    //         }
    //     },
    //     messages: {
    //         email: {
    //             required: "電子郵件為必填欄位",
    //             email: "電子郵件格式錯誤"
    //         }
    //     }
    // });
    
    $("#form-add-productID").validate({
        submitHandler: function(form){
            alert("商品資料已儲存!");
            form.submit();
        },
        rules: {},
        messages: {
            productTime:{
                required: "上架時間為必填欄位",
                pattern: "格式錯誤"
            },
            productName:{
                required: "商品名稱為必填欄位"
            },
            product_price:{
                required: "商品單價為必填欄位",
                pattern: "格式錯誤"
            },
            product_count:{
                required: "商品庫存為必填欄位"
            },
            product_description:{
                required: "商品描述為必填欄位"
            },
            product_pic_location:{
                required: "圖片位址為必填欄位"
            }
        }
    })
    $("#form-edit-productID").validate({
        submitHandler: function(form){
            alert("商品資料已儲存!");
            form.submit();
        },
        rules: {},
        messages: {
            productID:{
                required: "商品編號為必填欄位"
            },
            productTime:{
                required: "上架時間為必填欄位",
                pattern: "格式錯誤"
            },
            productName:{
                required: "商品名稱為必填欄位"
            },
            product_price:{
                required: "商品單價為必填欄位",
                pattern: "格式錯誤"
            },
            product_count:{
                required: "商品庫存為必填欄位"
            },
            product_description:{
                required: "商品描述為必填欄位"
            },
            product_pic_location:{
                required: "圖片位址為必填欄位"
            }
        }
    })
});