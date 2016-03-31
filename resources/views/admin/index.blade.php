@extends('admin.master')
@section('head')
	<style>
		#mainbav ul li:nth-child(1){
			background-color: #7963DF;
		}
		#mainbav ul li:nth-child(1):hover{
			background-color: #7963DF;
		}
	</style>
@stop

@section('sidebar')
    @parent 	{{--保留父级此块内容--}}
@stop

@section('content')
	<h1>用户数：{{ $users->count}}</h1>	
@stop
