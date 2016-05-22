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
    <div class="widget">
        <div class="widget-header bordered-bottom bordered-yellow">
            <span class="widget-caption">
                Show User WebPage
            </span>
        </div>
        <div class="widget-body">
            <div class="toolbar clearfix">
                <div class="float-left text-left">
                    <a href="{{URL::to('admin/create')}}" class="btn widget-buttons">新增</a>
                    <a href="#" id="delect" class="btn widget-buttons">删除</a>
                </div>
                <div class="float-right text-right">
                    <input type="text" class="find" placeholder="使用用户名或姓名检索" value="{{ isset($now) ? $now : '' }}">
                    <a href="#" id="find-btn">查看</a>
                </div>
            </div>
            <form action='{{ url('admin/resetpasd') }}'>
                <table class="table table-bordered text-center" border="1">
                    <thead class="bordered-darkorange">
                        <tr>
                            <th><input type="checkbox" id="all-select" name='chk_list'></th>
                            <th><span>用户名</span></th>
                            <th><span>姓名</span></th>
                            <th><span>组别</span></th>
                            <th><span>手机号</span></th>
                            <th><span>班级</span></th>
                            <th><span>操作</span></th>
                        </tr>
                    </thead>
                    <tbody>
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
    </div>





@endsection

