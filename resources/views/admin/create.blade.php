@extends('admin.master')

@section('title')
    添加用户
@endsection

@section('head')
    <link rel="stylesheet" href="../admin/css/addUsers.css">
    <script type="text/javascript" src="../admin/js/addUsers.js"></script>
@endsection

@section('content')
    <div id="addUser">
        <br>
        <h1 id="title">Add User Web Page</h1>
        <br>
        <hr>
        <div id="info-wrap">
            <form action='{{ url('admin/addUser') }}' method="post">
                <table id="info-table">
                    <tbody>
                    <tr>
                        <td><label for="account">用户名：</label></td>
                        <td><input type="text" name="account" id="account" placeholder="名字的拼音"></td>
                    </tr>
                    <tr>
                        <td><label for="userName">姓名：</label></td>
                        <td><input type="text" name="userName" id="userName" placeholder="名字"></td>
                    </tr>
                    <tr>
                        <td>组别：</td>
                        <td>
                            <select name="group" id="group">
                                @foreach($groups as $group)
                                    <option>
                                        {{$group->name}}
                                    </option>
                                @endforeach
                            </select>
                        </td>
                    </tr>

                    <tr>
                        <td>权限：</td>
                        <td>
                            <select name="rank" id="rank">
                                <option>平民</option>
                                <option>县官</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2"><span id="prompt-info" style="color: orangered"></span></td>
                    </tr>

                    {{--<tr>--}}
                        {{--<td><label for="stuid">学号：</label></td>--}}
                        {{--<td><input name="stuid" id="stuid"></td>--}}
                    {{--</tr>--}}
                    {{--<tr>--}}
                        {{--<td><label for="class">班级：</label></td>--}}
                        {{--<td><input name="class" id="class"></td>--}}
                    {{--</tr>--}}
                    {{--<tr>--}}
                        {{--<td><label for="phone">手机号：</label></td>--}}
                        {{--<td><input name="phone" id="phone"></td>--}}
                    {{--</tr>--}}
                    {{--<tr>--}}
                        {{--<td><label for="email">电子邮箱：</label></td>--}}
                        {{--<td><input name="email" id="email"></td>--}}
                    {{--</tr>--}}
                    {{--<tr>--}}
                        {{--<td><label for="qq">QQ：</label></td>--}}
                        {{--<td><input name="qq" id="qq"></td>--}}
                    {{--</tr>--}}
                    {{--<tr>--}}
                        {{--<td><label for="address">家庭地址：</label></td>--}}
                        {{--<td><input name="address" id="address"></td>--}}
                    {{--</tr>--}}
                    </tbody>
                </table>

                <div id="btn-wrap">
                    <input id="submit" type="button" value="添加">
                    <input id="reset" type="reset" value="重置">
                </div>
            </form>
        </div>
    </div>
@stop
