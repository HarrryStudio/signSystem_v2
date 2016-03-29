@extends('admin.master')

@section('sidebar')
    @parent 	{{--保留父级此块内容--}}
@stop

@section('content')
	<h1>用户数：{{ $users->count}}</h1>	
@stop
