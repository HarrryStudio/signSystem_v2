@extends('admin.master')

@section('title')
        显示用户
@endsection

@section('head')
    <link rel="stylesheet" href="{{asset('admin/css/showUsers.css')}}">
    <script type="text/javascript" src="{{asset('admin/js/resetpasd.js')}}"></script>
    <script type="text/javascript" src="{{asset('admin/js/showUsers.js')}}"></script>
@endsection

@section('content')
    <br>
    <h1 id="web-title">Show User WebPage</h1>
    <br>
    <hr>
    <div id="info-warp">
        <div id="toolbar">
            <div class="left-wrap">
                <a href="{{URL::to('admin/create')}}">新&nbsp&nbsp增</a>
                <a href="#" id="delect">删&nbsp&nbsp除</a>
            </div>
            <div class="right-wrap">
                <input type="text" class="find" placeholder="使用用户名或姓名检索" value="{{ isset($now) ? $now : '' }}">
                <a href="#" id="find-btn">查&nbsp看</a>
            </div>
        </div>
        <form action='{{ url('admin/resetpasd') }}'>
            <table cellspacing="0" cellpadding="0" border="1" style="text-align: center">
                <tbody>
                <tr style="background-color:rgba(23, 22, 23, 1)">
                    <th><input type="checkbox" id="all-select" name='chk_list'></th>
                    <th><span>用户名</span></th>
                    <th><span>姓名</span></th>
                    <th><span>组别</span></th>
                    <th><span>手机号</span></th>
                    <th><span>班级</span></th>
                    <th><span>操作</span></th>
                </tr>
                @foreach($users as $user)
                    <tr>
                        <th><input type="checkbox" class="checkbox" value="{{$user->account}}"></th>
                        <td><span>{{ $user->account }}</span></td>
                        <td><span>{{ $user->name }}</span></td>
                        <td><span>
                                @if($user->id>0)
                                    {{ $user->group_name }}
                                @else
                                    -------
                            @endif
                            </span></td>
                        <td><span>{{ $user->phone }}</span></td>
                        <td><span>{{ $user->class }}</span></td>
                        <td><a href="{{url('admin/delete/'.$user->account)}}" class="icon-remove"></a>&nbsp
                            <a href="{{url('admin/update/'.$user->account)}}" class="icon-pencil"></a>&nbsp
                            <a href="javascript:ajax('{{$user->account}}');" class=" icon-refresh"></a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </form>
        <div id="page">
            {!! $users->render() !!}
        </div>
    </div>





@endsection

