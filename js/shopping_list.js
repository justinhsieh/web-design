$(document).ready(function ($) {
    $("#form-account").validate({
    submitHandler: function (form) {
        alert("訂單已提交！");
        form.submit();
    },
    rules: {},
    messages: {
        name: {
            required: "姓名為必填欄位",
        },
        address: {
            required: "地址為必填欄位",
        },
        card: {
            required: "卡號為必填欄位",
            pattern: "錯誤格式",
        },
        phone: {
            required: "電話為必填欄位",
            pattern: "錯誤格式",
        },
    },
    });
});
$(document).ready(function () {
    $(window).scroll(function () {
        if ($(this).scrollTop() > 200) {
            $("#backToTop").css("display", "flex");
        } else {
            $("#backToTop").css("display", "none");
        }
        });
        $("#backToTop").click(function () {
        $("html").animate({ scrollTop: 0 });
    });
    function updateTotal() {
        let total = 0;
        $(".cart-item").each(function () {
            let checkbox = $(this).find(".item-checkbox");
            if (checkbox.prop("checked")) {
                let price = parseInt($(this).find(".unit-price").data("price"));
                let quantity = parseInt($(this).find("#quantity").val());
                total += price * quantity;
            }
        });
        $("#total-price, #card-total, #order-total").text(
            total.toLocaleString()
        );
    }

    function updateCategoryCount(category, delta) {
        let countSpan = $("#" + category + "-count");
        let current =
            parseInt(countSpan.attr("data-" + category + "Count")) || 0;
        //console.log(current);
        let newCount = current + delta;
        countSpan.attr("data-" + category + "Count", newCount);
        countSpan.text(newCount);
    }

    $(document).on("click", ".remove-item", function (e) {
        e.preventDefault();
        const $item = $(this).closest(".cart-item");
        const id = $(this).data("id");

        const quantity = parseInt($item.find(".quantity").val());
        const category = $item.closest(".type").data("category");

    
        if (!confirm("確定要移除此商品？")) return;
    
        $.post("delete_from_cart.php", { id: id}, function (res) {
            if (res === "success") {
                $item.remove(); // 從畫面移除
                alert("已移除商品");
                updateCategoryCount(category, -quantity);
                updateCategoryCount("items", -quantity); 
                updateTotal();
            } else {
                alert("移除失敗：" + res);
            }
        });
    });
    

    $("#check-all").change(function () {
        let isChecked = $(this).prop("checked");
        $(".item-checkbox").each(function () {
            let category = $(this).closest(".type").data("category");
            let quantity =
            parseInt($(this).closest(".cart-item").find(".quantity").val()) ||
            0;
            let delta = isChecked ? quantity : -quantity;
            updateCategoryCount(category, delta);
            updateCategoryCount("items", delta);
        });
        $(".item-checkbox").prop("checked", isChecked);
        updateTotal();
    });

    $(".item-checkbox").change(function () {
        let isChecked = $(this).prop("checked");
        let category = $(this).closest(".type").data("category");
        let count =
            parseInt($(this).closest(".cart-item").find("#quantity").val()) ||
            0;
        if (isChecked) {
            //console.log(count);
            updateCategoryCount(category, count);
            updateCategoryCount("items", count);
        } else {
            //console.log(count);
            updateCategoryCount(category, -count);
            updateCategoryCount("items", -count);
        }
        updateTotal();
    });

    $("#payment-button").on("click", function () {
        $("#payment").show();
    });

    $("#items-nav").on("click", function () {
        $(".nav-link").removeClass("active");
        $(this).addClass("active");
        $(".type").show();
    });

    $("#phone-nav").on("click", function () {
        $(".nav-link").removeClass("active");
        $(this).addClass("active");
        $(".type").hide();
        $("#phone").show();
    });

    $("#camera-nav").on("click", function () {
        $(".nav-link").removeClass("active");
        $(this).addClass("active");
        $(".type").hide();
        $("#camera").show();
    });

    $("#computer-nav").on("click", function () {
        $(".nav-link").removeClass("active");
        $(this).addClass("active");
        $(".type").hide();
        $("#computer").show();
    });
    updateTotal();

    $(".increase, .decrease").click(function () {
        let $btn = $(this);
        let $quantityInput = $btn.siblings(".quantity");
        let currentQty = parseInt($quantityInput.val());
        let delta = $btn.hasClass("increase") ? 1 : -1;
        if (currentQty + delta < 1) return;

        let pid = $btn.data("pid");
        let $item = $btn.closest(".cart-item");
        let category = $item.closest(".type").data("category");

        $.ajax({
            url: "update_cart.php",
            method: "POST",
            data: {
                pid: pid,
                quantity: currentQty + delta
            },
            success: function () {
                $quantityInput.val(currentQty + delta);
                updateCategoryCount(category, delta);
                updateCategoryCount("items", delta);
                updateTotal()
            }
        });
    });
    $(".color-select").change(function () {
        let pid = $(this).data("pid");
        let color = $(this).val();
    
        $.post("update_cart.php", { pid: pid, quantity: 1, color: color }, function (res) {
            console.log("顏色已更新");
        });
    });
    $("#form-account").on("submit", function (e) {
        e.preventDefault();
      
        const formData = {
          name: $("#name").val(),
          address: $("#address").val(),
          phone: $("#phone").val(),
          total: parseFloat($("#order-total").text().replace(/,/g, ''))
        };
      
        $.post("pay_account.php", formData, function (res) {
          if (res === "success") {
            alert("訂單已送出！");
            location.href = "order.php";
          }
        });
    });
      
});
