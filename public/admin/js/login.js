$(function(){
    $('button').on('click', function(){
        var url = $('form').attr('action');
        var data = {
            'account' : $('input[name="account"]').val(),
            'password': $('input[name="password"]').val()
        }
        $.post( url, data, function(data){
           if(data != 0 && data != '0'){
               window.location.href = data;
           }else{
               alert('用户名或密码错误');
           }
        })
    });
})