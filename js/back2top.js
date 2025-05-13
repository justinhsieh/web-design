$(function () {
        $(window).scroll(function () {
            if ($(this).scrollTop() > 200) {
                $("#backToTop").css("display", "flex");
            } else {
                $("#backToTop").css("display", "none");
            }
        });
        $("#backToTop").click(function () {
            $("html").animate({ scrollTop: 0 },0);
        });
});