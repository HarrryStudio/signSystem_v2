<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <link rel="stylesheet" href="./admin/css/login.css">
    <script type="text/javascript" src="./static/jquery-1.10.2.min.js"></script>
    <script type="text/javascript" src="./admin/js/login.js"></script>
</head>
<body>
<div id="login-body">
    <div id="login-main">
        <h2 id="login-title">SignSystem</h2>
        <p id="error-p"></p>
        <form action=" {{ url('admin_post_login') }} ">
            <div class="form-item">
                <label for="account" class="form-label" id="account-label"></label>
                <input type="text" name="account" placeholder="请填写用户名"/>
            </div>
            <div class="form-item">
                <label for="password" class="form-label" id="pass-label"></label>
                <input type="password" name="password" placeholder="请填写密码" />
            </div>
            <div class="form-item">
                <label for="verifycode" class="form-label" id="verify-label"></label>
                <input type="text" name="verifycode" placeholder="请填写验证码"/>
            </div>
            <div class="form-item">
                <img id="verifycode-img" src=" {{ url('captcha/1') }}" alt="点击切换" onclick="reVerifycode(this)"/>
            </div>
            <script>
                function reVerifycode(that){
                    var url = "{{ url('captcha') }}";
                    url += '/' + Math.random();
                    that.src = url;
                }
            </script>
            <div class="form-item">
                <button type="button" id="login-submit">登&nbsp;&nbsp;&nbsp;录</button>
            </div>
        </form>
    </div>
</div>
</body>
</html>