$(function(){
    $('#login-submit').on('click', function(){

        if( (verify = $('input[name="verifycode"]').val()) == '' ){
            return $('#error-p').text('验证码不能为空');
        }
        if( (account = $('input[name="account"]').val()) == '' ){
            return $('#error-p').text('用户名不能为空');
        }
        if( (password = $('input[name="password"]').val()) == '' ){
            return $('#error-p').text('密码不能为空');
        }
        var url = $('form').attr('action');
        var data = {
            'account' : account,
            'password':password,
            'verifycode':verify
        }
        $.post( url, data, function(data){
            if(data.code == 0){
                window.location.href = data.data;
            }else{
                $('#error-p').text(data.msg);
                reVerifycode($('#verifycode-img')[0]);
            }
        })
    });
})