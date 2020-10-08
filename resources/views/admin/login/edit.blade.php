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
    @if(!empty(session('msg')))
        <div class="alert alert-msg" role="alert">
            {{session('msg')}}
        </div>
    @endif
    <table border="1">
        <form action="{{url('admin/login/update/'.$UserInfo->uid)}}" method="post">
            @csrf
            <tr>
                <td>用户名</td>
                <td><input type="text" name="user_name" value="{{$UserInfo->user_name}}" id=""></td>
            </tr>
            <tr>
                <td>邮箱</td>
                <td><input type="email" name="email" value="{{$UserInfo->email}}" id=""></td>
            </tr>
            <tr>
                <td><input type="submit" value="修改"></td>
                <td></td>
            </tr>
        </form>
    </table>
</body>
</html>
