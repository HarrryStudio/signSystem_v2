@extends('admin.master')

@section('head')
	<link rel="stylesheet" href="{{asset('admin/css/group.css')}}">
	<script type="text/javascript" src="{{asset('admin/js/group.js')}}"></script>
@stop

@section('sidebar')
    @parent 	{{--保留父级此块内容--}}
@stop

@section('content')
	<h1 id="title">所有组别：</h1>	
	<div id="toolbar" class="clearfix">
		<span style="float:left;">
			<a id="createGroup" class="btn btn-success" url="{{url('/admin/createGroup')}}">创建组</a>
		</span>
		<span style="float:right;">
			<label>所选人员移动至：</label>
			<select id='groupSelect'> 
			</select>
		</span>
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
			   		<a class="btn operation resetName" url="{{url('/admin/updateGroup')}}/{{$group->id}}">编辑</a>
			   		<a class="btn operation showList" value="{{$group -> counts}}" url="{{url('/admin/selectGroupUsers')}}/{{$group->id}}">查看人员</a>
			   		<a class="btn operation delect" value="{{$group -> counts}}" disabled=true url="{{url('/admin/delGroup')}}/{{$group->id}}">删除该组</a>
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
@stop
