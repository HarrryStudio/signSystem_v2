<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title')</title>
	{{--<link rel="stylesheet" href="../admin/css/master.css">--}}
	<link rel="stylesheet" href="{{asset('admin/css/master.css')}}">
    <script type="text/javascript" src="{{asset('static/jquery-1.10.2.min.js')}}"></script>
    @section('head')
		{{--myself link--}}
    @show
</head>
<body>
	<header id="header">
		<div class="img-box">
			<img src="" alt="logo">
		</div>

		<!--主导航-->
		<nav id="mainbav">
			<ul>
				<li><a href="{{url('/admin/index')}}">首页</a></li>
				<li><a href="{{url('/admin/user')}}">用户</a></li>
				<li><a href="{{url('/admin/group')}}">组别</a></li>
			</ul>
		</nav>

		<!--用户中心-->
		<div id="ucenter">
			<span>icon</span>
		</div>
	</header>

	<div class="content">
		{{--主体内容--}}
	    @yield('content')
		
	</div>
</body>
</html>