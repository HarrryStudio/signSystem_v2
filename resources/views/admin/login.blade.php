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
<form action=" {{ url('admin_post_login') }} ">
    <input type="text" name="account" placeholder="account"/>
    <input type="password" name="password" placeholder="password" />
    <button type="button">登录</button>
</form>
</body>
</html>