$(document).ready(function () {
    $(document).on("click", ".delete-member", function () {
        const memberId = $(this).data("id");
        if (confirm("確定要刪除這個會員嗎？")) {
            $.ajax({
                url: "delete_member.php",
                type: "POST",
                data: { id: memberId },
                success: function(response) {
                    if (response.status === "SUCCESS") {
                        alert(response.message);
                        window.location.reload();  // 刷新頁面
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
    $(document).on("click", ".delete-subscriber", function () {
        const subscriberId = $(this).data("id");
        if (confirm("確定要刪除這個訂閱者嗎？")) {
            $.ajax({
                url: "delete_subscriber.php",
                type: "POST",
                data: { id: subscriberId },
                success: function(response) {
                    if (response.status === "SUCCESS") {
                        alert(response.message);
                        window.location.reload();  // 刷新頁面
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
    $(document).on("click", ".delete-product", function () {
        const prodId = $(this).data("pid");
        console.log(prodId);
        if (confirm("確定要刪除這個商品嗎？")) {
            $.ajax({
                url: "delete_product.php",
                type: "POST",
                data: { pid: prodId },
                success: function(response) {
                    if (response.status === "SUCCESS") {
                        alert(response.message);
                        window.location.reload();  // 刷新頁面
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
    $(document).on("click", ".delete-reviews", function(){
        const reviewId = $(this).data("review_id"); 
        console.log(reviewId);
        if(confirm("確定要刪除這個留言嗎?")){
            $.ajax({
                url: "delete_review.php",
                type: "POST",
                data: {reviewid: reviewId},
                success: function(response){
                    if(response.status === "SUCCESS"){
                        alert(response.message);
                        window.location.reload() //刷新頁面
                    } else {
                        alert(response.message);
                    }
                },
                error: function(){
                    alert("發生錯誤，請稍後嘗試");
                }
            });
        }
    });
    $(document).on("click", ".delete-shoppingcart", function () {
        if (confirm("確定要刪除這筆購物車資料嗎？")) {
            const shopping_id = $(this).data("shopping_id");
            // console.log(shopping_id);
            $.ajax({
                url: "delete_shoppingcart.php",
                type: "POST",
                data: { id: shopping_id },
                success: function (response) {
                    alert("刪除成功！");
                    location.reload();
                },
                error: function () {
                    alert("刪除失敗，請稍後再試。");
                }
            });
        }
    });
    $(document).on("click", ".delete-order", function () {
        if (confirm("確定要刪除此訂單嗎？")) {
            const orderId = $(this).data("order_id");
            console.log("Deleting order:", orderId);
            $.ajax({
                url: "delete_order.php",
                type: "POST",
                data: { order_id: orderId },
                success: function (response) {
                    alert("刪除成功！");
                    location.reload();
                },
                error: function () {
                    alert("刪除失敗，請稍後再試。");
                }
            });
        }
    });
});