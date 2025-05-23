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
});