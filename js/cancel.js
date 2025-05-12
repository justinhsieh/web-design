$(document).ready(function () {
    $(".delete-member").on("click", function () {
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
    $(".cancel-productID").on("click", function () {
        let row = $(this).closest("tr");
        let productID = row.find("td:first").text();
        if (confirm(`確定要刪除商品:${productID}嗎?`)) {
            row.remove();
        }
    });
    $(".cancel-discussion").on("click", function () {
        let row = $(this).closest("tr");
        let discussion = row.find("td:first").text();
        if (confirm(`確定要刪除會員:${discussion}的留言嗎?`)) {
            row.remove();
        }
    });
    $(".cancel-paylist").on("click", function () {
        let row = $(this).closest("tr");
        let paylist = row.find("td:first").text();
        if (confirm(`確定要刪除會員:${paylist}的訂單嗎?`)) {
            row.remove();
        }
    });
});