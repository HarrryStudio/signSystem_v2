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
 {{--       <th>邮箱</th>
        <th>qq</th>
        <th>家庭地址</th>
        <th>创建时间</th>
        <th>更新时间</th>--}}
    </tr>
        @foreach($users as $user)
            <tr>
                <td><span>{{ $user->account }}</span></td>
                <td><span>{{ $user->name }}</span></td>
                <td><span>开发{{ $user->group_id }}组</span></td>
                <td><span>{{ $user->phone }}</span></td>
                <td><span>{{ $user->class }}</span></td>
{{--                <td><span>{{ $user->stu_id }}</span></td>
                <td><span>{{ $user->email }}</span></td>
                <td><span>{{ $user->qq }}</span></td>
                <td><span>{{ $user->address }}</span></td>
                <td><span>{{ date('Y/m/d h:i',$user->created_at) }}</span></td>
                @if($user->updated_at!=0)
                    <td><span>{{ date('Y/m/d h:i',$user->updated_at) }}</span></td>
                @else
                    <td><span>--</span></td>
                @endif--}}
            </tr>
        @endforeach
    </tbody>
</table>
</body>
</html>