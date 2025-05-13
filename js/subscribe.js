$(function () {
    $("#subscribe").validate({
    submitHandler: function(form) {
        let email = $('#email').val().toLowerCase().trim();
        $.post('subscriber.php',{email:email},function(response){
        if(response.status === "OK"){
            showToast("感謝訂閱！")
        }else{
            $("#error-container").html("電子信箱已被使用過");
        }
        },'json');
    },
    rules:{
        email:{
        required:true,
        }
    },
    messages: {
        email: {
            required:"信箱為必填欄位",
            email:"請輸入正確的電子信箱格式"
        }
    },
    errorPlacement: function (error, element) {
        $("#error-container").html(error);
    }
    });
});