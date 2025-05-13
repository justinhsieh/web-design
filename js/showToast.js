$(function () {
    function showToast(message){
    const toastEl = $('#liveToast')[0];
        if (toastEl) {
        $(".toast-body").text(message);
        const toastBootstrap = bootstrap.Toast.getOrCreateInstance(toastEl,{delay:3000});
        toastBootstrap.show();
        }
    }
});