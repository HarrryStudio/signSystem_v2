@extends('admin.master')

@section('head')
	<link rel="stylesheet" href="{{asset('admin/css/group.css')}}">
	<script type="text/javascript" src="{{asset('admin/js/group.js')}}"></script>
@stop

@section('sidebar')
    @parent 	{{--保留父级此块内容--}}
@stop

@section('content')
	<div class="widget">
		<div class="widget-header bordered-bottom bordered-yellow">
		    <span class="widget-caption">
		        Show group WebPage
		    </span>
		</div>

		<div class="widget-body">
			<div class="toolbar clearfix" style="padding:10px 0 20px 0;">
				<span style="float:left;">
					<a id="createGroup" class="btn btn-success" url="{{url('/admin/createGroup')}}">创建组</a>
				</span>
				<span style="float:right;">
					<label>所选人员移动至：</label>
					<select id='groupSelect'> 
					</select>
				</span>
			</div>
			<table id="list" class="table table-bordered text-center" border="1">
				<thead class="bordered-darkorange">
					<tr>
						<th><span>id</span></th>
						<th><span>组名</span></th>
						<th><span>人数</span></th>
						<th><span>操作</span></th>
					</tr>
				</thead>

				<tbody>
					@foreach ($groups as $group)
					   	<tr>
					   		<th>
					   			<span name="id" class="id">{{ $group->id }}</span>
					   		</th>
					   		<th>
					   			<input name="name" type="text" disabled="true" value="{{$group->name}}" maxlength="8" style="margin-top:20px;">
							</th>

							<th>
								<span class="count">{{$group -> counts}}</span>
							</th>
							<th>
					   		<a class="btn operation resetName widget-buttons" url="{{url('/admin/updateGroup')}}/{{$group->id}}">编辑</a>
					   		<a class="btn operation showList widget-buttons" value="{{$group -> counts}}" url="{{url('/admin/selectGroupUsers')}}/{{$group->id}}">查看人员</a>
					   		<a class="btn operation delete widget-buttons" value="{{$group -> counts}}" disabled=true url="{{url('/admin/delGroup')}}/{{$group->id}}">删除该组</a>
							</th>
						</tr>
					   	<tr >
							<th colspan = "4">
								<table class="info table table-bordered text-center" border="1"></table>
							</th>
					   	</tr>
					   	
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
@stop
