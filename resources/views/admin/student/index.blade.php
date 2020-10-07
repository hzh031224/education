<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <table border="1">
        <tr>
            <td>编号</td>
            <td>姓名</td>
            <td>年龄</td>
            <td>操作</td>
        </tr>
        @foreach($StudentInfo as $v)
        <tr>
            <td>{{$v->stu_id}}</td>
            <td>{{$v->stu_name}}</td>
            <td>{{$v->stu_age}}</td>
            <td>
                <a href="{{url('student/delete/'.$v->stu_id)}}">删除</a>
                <a href="{{url('student/edit/'.$v->stu_id)}}">修改</a>
            </td>
        </tr>
        @endforeach
    </table>
</body>
</html>