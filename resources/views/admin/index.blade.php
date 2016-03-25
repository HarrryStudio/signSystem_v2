@extends('admin.master')

@section('sidebar')
    @parent 	{{--保留父级此块内容--}}
@stop

@section('content')
	<h1>12414</h1>

	@foreach ($users as $user)
    	<p>This is user {{ $user->id }}</p>
	@endforeach

@stop
