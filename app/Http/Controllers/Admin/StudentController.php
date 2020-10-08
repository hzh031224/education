<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller ;
use Illuminate\Http\Request;
// 引入学习模型
use App\Models\Student as StudentModel;

class StudentController extends Controller
{
    // 添加
    public function create(){
        return view('admin.student.create');
    }

    // 执行添加
    public function save(Request $request){
        // 绕过laravel框架 CSRF 的保护
        $data=$request->except("_token");
        $StudentModel = new StudentModel();
        // dump($data);die;
        $res = $StudentModel->insert($data);
        // $res = $StudentModel->all();
        // dump($res);
        if($res){
            return redirect('student/login');
        }else{
            return redirect('student/create');
        }
    }

    // 列表页
    public function index(){
        $StudentModel = new StudentModel();
        $StudentInfo = $StudentModel->all();
        return view('admin.student.login',['StudentInfo'=>$StudentInfo]);
    }

    // 删除
    public function delete(Request $request,$id){
        $StudentModel = new StudentModel();
        $res = $StudentModel->where('stu_id',$id)->delete();
        if($res > 0){
            return redirect('student/login');
        }else{
            return redirect('student/create');
        }
    }

    // 修改
    public function edit(Request $request,$id){
        $StudentModel = new StudentModel();
        // 根据id查询出一条数据
        $StudentInfo = $StudentModel->find($id);
        // dd($StudentInfo);
        return view('admin.student.edit',['StudentInfo'=>$StudentInfo]);
    }

    // 执行修改
    public function update(Request $request){
        // 绕过laravel框架 CSRF 的保护
        $data=$request->except("_token");
        $stu_id = $request->stu_id;
        $StudentModel = new StudentModel();
        // dump($StudentModel);die;
        $res = $StudentModel->where('stu_id',$stu_id)->update($data);
        // $res = $StudentModel->all();
        // dump($res);
        if($res){
            return redirect('student/login');
        }else{
            return redirect('student/create');
        }
    }
}
