@extends('admin.master')

@section('title')
    信息修改
@endsection

@section('head')
    <link rel="stylesheet" href="{{ asset('admin/css/updateUsers.css') }}">
    <script type="text/javascript" src="{{URL::asset('admin/js/updateUsers.js')}}"></script>
@endsection

@section('content')

    <div id="updateUser">
        <br>
        <h1 id="title">Update User WebPage</h1>
        <br>
        <hr>
        <div id="info-wrap">
            <form action='{{ url('admin/xiugai') }}' method="post">
                <table id="info-table">
                    <tbody>
                    <tr>
                        <td><label for="account">用户名：</label></td>
                        <td><input type="text" name="account" id="account" placeholder="名字的拼音" value="{{$user->account}}"></td>
                    </tr>
                    <tr>
                        <td><label for="userName">姓名：</label></td>
                        <td><input type="text" name="userName" id="userName" placeholder="名字" value="{{$user->name}}"></td>
                    </tr>
                    <tr>
                        <td>组别：</td>
                        <td>
                            <select name="group" id="group">
                                @foreach($groups as $group)
                                    @if($group->name==$group_name->name)
                                        <option selected="true">
                                            {{$group->name}}
                                        </option>
                                    @else
                                        <option>
                                            {{$group->name}}
                                        </option>
                                    @endif
                                @endforeach
                            </select>
                        </td>
                    </tr>

                    <tr>
                        <td>权限：</td>
                        <td>
                            <select name="rank" id="rank">
                                @if($user->rank==0)
                                    <option selected="true">平民</option>
                                    <option>县官</option>
                                @else
                                    <option>平民</option>
                                    <option selected="true">县官</option>
                                @endif
                            </select>
                        </td>
                    </tr>

                    <tr>
                        <td colspan="2"><span id="prompt-info" style="color: orangered"></span></td>
                    </tr>
                    </tbody>
                </table>

                <div id="btn-wrap">
                    <input id="submit" type="button" value="保存">
                </div>
                <span hidden="true" id="tmp">{{$user->id}}</span>
            </form>
        </div>
    </div>


{{--    <h4>{{$user->account}}</h4>
    <h4>{{$user->name}}</h4>
    <h4>{{$group_name->name}}</h4>
@if($user->rank==1)
    <h4>县官</h4>
@else
    <h4>平民</h4>
@endif--}}

@endsection