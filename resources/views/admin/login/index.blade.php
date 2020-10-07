<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <table border="1">
        <tr>
            <td>编号</td>
            <td>用户名</td>
            <td>用户邮箱</td>
            <td>注册时间</td>
            <td>操作</td>
        </tr>
        @foreach($UserInfo as $v)
        <tr>
            <td>{{$v->uid}}</td>
            <td>{{$v->user_name}}</td>
            <td>{{$v->email}}</td>
            <td>{{$v->reg_time}}</td>
            <td>
                <a href="{{url('/login/delete/'.$v->uid)}}">删除</a>
                <a href="{{url('/login/edit/'.$v->uid)}}">修改</a>
            </td>
        </tr>
        @endforeach
    </table>
</body>
</html>
