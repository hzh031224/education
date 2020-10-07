<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <table border="1">
        <form action="{{url('student/save')}}" method="post">
        @csrf
            <tr>
                <td>姓名</td>
                <td><input type="text" name="stu_name" id=""></td>
            </tr>
            <tr>
                <td>年龄</td>
                <td><input type="text" name="stu_age" id=""></td>
            </tr>
            <tr>
                <td><input type="submit" value="提交"></td>
                <td></td>
            </tr>
        </form>
    </table>
</body>
</html>