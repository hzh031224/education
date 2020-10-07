<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <table border="1">
        <form action="{{url('student/update')}}" method="post">
        @csrf
        <input type="hidden" name="stu_id" id="" value="{{$StudentInfo->stu_id}}">
            <tr>
                <td>姓名</td>
                <td><input type="text" name="stu_name" id="" value="{{$StudentInfo->stu_name}}"></td>
            </tr>
            <tr>
                <td>年龄</td>
                <td><input type="text" name="stu_age" id="" value="{{$StudentInfo->stu_age}}"></td>
            </tr>
            <tr>
                <td><input type="submit" value="修改"></td>
                <td></td>
            </tr>
        </form>
    </table>
</body>
</html>