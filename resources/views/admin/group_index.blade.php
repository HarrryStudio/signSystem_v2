@extends('admin.master')

@section('sidebar')
    @parent 	{{--保留父级此块内容--}}
@stop

@section('content')
	<h1>所有组别：</h1>	
	<ul>
		@foreach ($groups as $group)
		   	<li>
		   		<span>id:{{ $group->id }}</span>
		   		<mark style="display:inline-block;margin-left:4rem; width:10rem;">name:{{$group->name}}</mark>
		   		<span>人数：{{$group -> counts}}</span>
		   		<a href="http://signsystem.cn:81/admin/selectGroupUsers/{{$group->id}}">查看人员（后边换ajax）</a>
		   	</li>
		@endforeach
	</ul>		

@stop
