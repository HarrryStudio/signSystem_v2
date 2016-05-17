@extends('admin.master')
@section('head')
	<link rel="stylesheet" href="{{asset('admin/css/index.css')}}">
@stop

@section('sidebar')
    @parent 	{{--保留父级此块内容--}}
@stop

@section('content')
	<ul>
		<li>
			<span>icon</span>
			<span>用户数:</span>
			<span>{{$users_count}}</span>
		</li>

		<li>
			<span>icon</span>
			<span>组别数:</span>
			<span>{{$groups_count}}</span>
		</li>
	</ul>

	<div id="information" class="clearfix">
		<div id="system">
			<h2 class="title">系统信息</h2>
			<ul>
				<li>
					<span class="text">签到系统版本</span>
					<span class="text-content">2.0.0</span>
				</li>
				<li>
					<span class="text">服务器操作系统</span>
					<span class="text-content">Linux</span>
				</li>
				<li>
					<span class="text">laravel版本</span>
					<span class="text-content">5.2</span>
				</li>
				<li>
					<span class="text">运行环境</span>
					<span class="text-content">Apache/2.4.3 PHP/5.5.3</span>
				</li>
				<li>
					<span class="text">MYSQL版本</span>
					<span class="text-content">5.5.20-log</span>
				</li>
			</ul>
		</div>

		<div id="team">
			<h2 class="title">产品团队</h2>
			<ul>
				<li>
					<span class="text">总策划</span>
					<span class="text-content">凌端化</span>
				</li>
				<li>
					<span class="text">产品设计研发团队</span>
					<span class="text-content">凌端化 刘博 王明亮</span>
				</li>
				<li>
					<span class="text">界面及用户体验团队</span>
					<span class="text-content">李文月 侯丹丹 李雪冰</span>
				</li>
				<li>
					<span class="text">官方网址</span>
					<span class="text-content"><a href="http://www.marchsoft.cn/">www.marchsoft.cn</a></span>
				</li>
				<li>
					<span class="text">联系地址</span>
					<span class="text-content"><address>河南科技学院</address></span>
				</li>
			</ul>
		</div>
	</div>
@stop
