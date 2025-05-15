$(function () {
    window.showToast = function (message){
    const toastEl = $('#liveToast')[0];
        if (toastEl) {
        $("#toast-message").text(message);
        const toastBootstrap = bootstrap.Toast.getOrCreateInstance(toastEl,{delay:3000});
        toastBootstrap.show();
        }
    }
});