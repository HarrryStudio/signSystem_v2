<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title')</title>
	{{--<link rel="stylesheet" href="../admin/css/master.css">--}}
	<link rel="stylesheet" href="{{asset('admin/css/master.css')}}">
	<link rel="stylesheet" href="{{asset('static/Font-Awesome/css/font-awesome.css')}}">
    <script type="text/javascript" src="{{asset('static/jquery-1.10.2.min.js')}}"></script>
    @section('head')
		{{--myself link--}}
    @show
</head>
<body>
	<header id="header">
		<div class="img-box">
			<img src="{{asset('admin/img/logo.png')}}" alt="logo">
			<div style="clear: both"></div>
		</div>

		<!--主导航-->
		<nav id="mainbav">
			<ul>
				<li><a href="{{url('/admin/index')}}">首页</a></li>
				<li><a href="{{url('/admin/showUsers')}}">用户</a></li>
				<li><a href="{{url('/admin/group')}}">组别</a></li>
			</ul>
		</nav>
		<div style="clear: both;"></div>
		<!--用户中心-->
		<div id="ucenter">
			<span>icon</span>
		</div>
	</header>
	<!--侧边导航栏-->
	<div id="subnav">
	    @section('sidebar')
			{{--侧边栏--}}
	    @show
	</div>


<div class="container">
	{{--主体内容--}}
    @yield('content')
	
</div>
</body>
</html>