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
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <table border="1">
        <form action="{{url('admin/login/registerdo')}}" method="post">
            @csrf
            <tr>
                <td>用户名</td>
                <td><input type="text" name="user_name" id=""></td>
            </tr>
            <tr>
                <td>邮箱</td>
                <td><input type="email" name="email" id=""></td>
            </tr>
            <tr>
                <td>手机号</td>
                <td><input type="tel" name="user_tel" id=""></td>
            </tr>
            <tr>
                <td>密码</td>
                <td><input type="password" name="password" id=""></td>
            </tr>
            <tr>
                <td>重复密码</td>
                <td><input type="password" name="password_confirmation" id=""></td>
            </tr>
            <tr>
                <td><input type="submit" value="注册"></td>
                <td></td>
            </tr>
        </form>
    </table>
</body>
</html>
