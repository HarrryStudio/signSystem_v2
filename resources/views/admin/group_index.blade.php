@extends('admin.master')

@section('head')
	<link rel="stylesheet" href="{{asset('admin/css/group.css')}}">
	<script type="text/javascript" src="{{asset('admin/js/group.js')}}"></script>
@stop

@section('sidebar')
    @parent 	{{--保留父级此块内容--}}
@stop

@section('content')
	<h1 id="title" style="padding-left:20%;">所有组别：</h1>	
	<div id="toolbar" style="padding-left:30%;">
		<button id="createGroup">创建组</button>
	</div>
	<table id="list">
		<thead>
			<th>id</th>
			<th>组名</th>
			<th>人数</th>
			<th>操作</th>
		</thead>
		<tbody>
			@foreach ($groups as $group)
			   	<tr>
			   		<th>
			   			<span name="id" class="id">{{ $group->id }}</span>
			   		</th>
			   		<th>
			   			<input name="name" type="text" disabled="true" value="{{$group->name}}" maxlength="8">
					</th>

					<th>
						<span class="count">{{$group -> counts}}</span>
					</th>
					<th>
			   		<button class="resetName" url="{{url('/admin/updateGroup')}}/{{$group->id}}">编辑</button>
			   		<button class="showList" value="{{$group -> counts}}" url="{{url('/admin/selectGroupUsers')}}/{{$group->id}}">查看人员</button>
			   		<button class="delect" value="{{$group -> counts}}" disabled=true url="{{url('/admin/delGroup')}}/{{$group->id}}">删除该组</button>
					</th>
				</tr>
			   	<tr >
					<th colspan = "4">
						<table class="info"></table>
					</th>
			   	</tr>
			   	
			@endforeach
		</tbody>
	</table>
	<script>

	</script>
@stop
