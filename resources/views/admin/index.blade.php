@extends('admin.master')

@section('sidebar')
    @parent

    <p>{{ session('admin_account') }}</p>
@stop

@section('content')

@stop
