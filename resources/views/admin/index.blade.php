@extends('admin.master')
@section('head')
	<link rel="stylesheet" href="{{asset('admin/css/index.css')}}">
	<link rel="stylesheet" href="{{asset('static/Font-Awesome/css/font-awesome.min.css')}}">
@stop

@section('sidebar')
    @parent 	{{--保留父级此块内容--}}
@stop

@section('content')
	<div class="container-span clearfix">
		<div class="top-columns clearfix text-center">
			<dl class="show-num-mod float-left">
				<dt>
					<i class="count-icon  icon-user"></i>
				</dt>
				<dd>
					<strong>{{$users_count}}</strong>
					<span>用户数</span>
				</dd>
			</dl>
			<dl class="show-num-mod float-left">
				<dt>
					<i class="count-icon icon-columns"></i>
				</dt>
				<dd>
					<strong>{{$users_count}}</strong>
					<span>组别数</span>
				</dd>
			</dl>
		</div>

		<div class="panel">
			<div class="columns-mod">
				<div class="hd">
					<h4>系统信息</h4>
				</div>
				<div class="system-info">
					<table>
						<tr>
							<th class="title">签到系统版本</th>
							<td class="text">2.0.0</td>
						</tr>
						<tr>
							<th class="title">服务器操作系统</th>
							<td class="text">Linux</td>
						</tr>
						<tr>
							<th class="title">laravel版本</th>
							<td class="text">5.2</td>
						</tr>
						<tr>
							<th class="title">运行环境</th>
							<td class="text">Apache/2.4.3 PHP/5.5.3</td>
						</tr>
						<tr>
							<th class="title">MYSQL版本</th>
							<td class="text">5.5.20-log</td>
						</tr>
					</table>
				</div>
			</div>
		</div>
		<div class="panel">
			<div class="columns-mod">
				<div class="hd">
					<h4>产品团队</h4>
				</div>
				<div class="system-info">
					<table>
						<tr>
							<th class="title">总策划</th>
							<td class="text">凌端化</td>
						</tr>
						<tr>
							<th class="title">产品设计研发团队</th>
							<td class="text">凌端化 刘博 王明亮</td>
						</tr>
						<tr>
							<th class="title">界面及用户体验团队</th>
							<td class="text">李文月 侯丹丹 李雪冰</td>
						</tr>
						<tr>
							<th class="title">官方网址</th>
							<td class="text"><a href="http://www.marchsoft.cn/">www.marchsoft.cn</a></td>
						</tr>
						<tr>
							<th class="title">联系地址</th>
							<td class="text"><address>河南科技学院</address></td>
						</tr>
					</table>
				</div>
				
			</div>
		</div>
	</div>
@stop
