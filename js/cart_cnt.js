$(function(){
    $.get('get_cart_cnt.php',function(response){
        $cnt = response.count;
        if($cnt > 10){
            $('.cart_cnt').text('10+');
        }else{
            $('.cart_cnt').text($cnt);
        }
      })
})