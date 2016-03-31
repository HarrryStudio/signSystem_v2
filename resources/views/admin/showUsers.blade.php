@extends('admin.master')

@section('title')
        显示用户
@endsection

@section('head')
    <link rel="stylesheet" href="{{asset('admin/css/showUsers.css')}}">
    <script type="text/javascript" src="{{asset('admin/js/resetpasd.js')}}"></script>
@endsection

@section('content')
    <br>
    <h1>Show User WebPage</h1>
    <br>
    <hr>
    <br>
    <br>
    <form action='{{ url('admin/resetpasd') }}'>
    <table cellspacing="0" cellpadding="0" border="1" style="text-align: center">
        <tbody>
        <tr style="background-color: rgba(116, 116, 116, 0.6)">
            <th><span>用户名</span></th>
            <th><span>姓名</span></th>
            <th><span>组别</span></th>
            <th><span>手机号</span></th>
            <th><span>班级</span></th>
            <th><span>操作</span></th>
        </tr>
        @foreach($users as $user)
            <tr>
                <td><span>{{ $user->account }}</span></td>
                <td><span>{{ $user->name }}</span></td>
                <td><span>{{ $user->group_name }}</span></td>
                <td><span>{{ $user->phone }}</span></td>
                <td><span>{{ $user->class }}</span></td>
                <td><a href="{{url('admin/delete/'.$user->account)}}">删除</a>丨
                    <a href="{{url('admin/update/'.$user->account)}}">修改</a>丨
{{--                    <a href="{{url('admin/resetpasd/'.$user->account)}}">重置密码</a>--}}
                    <a href="javascript:ajax('{{$user->account}}');">重置密码</a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    </form>
    <div id="page">
        {!! $users->render() !!}
    </div>

@endsection



{{--
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>ShowUsers</title>
    <style>
        *{
            font-family: "Microsoft YaHei";
        }
        table tbody tr{
            height: 44px;
            max-width: 1000px;
        }
        table tbody tr td span{
            padding:0 10px;
        }
    </style>
</head>
<body>

<h1>Show User WebPage</h1>
<hr>
<table cellspacing="0" cellpadding="0" border="1" style="text-align: center">
    <tbody>
    <tr style="background-color: rgba(116, 116, 116, 0.6)">
        <th>用户名</th>
        <th>姓名</th>
        <th>组别</th>
        <th>手机号</th>
        <th>班级</th>
        <th>删除</th>
    </tr>
        @foreach($users as $user)
            <tr>
                <td><span>{{ $user->account }}</span></td>
                <td><span>{{ $user->name }}</span></td>
                <td><span>开发{{ $user->group_id }}组</span></td>
                <td><span>{{ $user->phone }}</span></td>
                <td><span>{{ $user->class }}</span></td>
                <td><span><a href="{{url('admin/delete/'.$user->account)}}">删除</a></span></td>
            </tr>
        @endforeach
    </tbody>
</table>
</body>
</html>--}}
