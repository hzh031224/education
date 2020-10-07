<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User as UserModel;

class LoginController extends Controller
{
    // 登录视图
    public function login(){
        return view('admin.login.login');
    }

    // 执行登录
    public function logindo(Request $request){
        // 得到当前用户的真实ip
        $ip = $request->getClientIp();
        $data = $request->except('_token');
        $UserModel = new UserModel();
        // 根据用户输入的账号和密码在库中查询
        $res = $UserModel->where($data)->first();
        if(!empty($res)){
            $logininfo = ['last_login'=>time(),'last_ip'=>$ip,'login_count'=>$res['login_count']+1];
            $UserModel->where('uid',$res['uid'])->update($logininfo);
            return redirect('/login/index');
        }else{
            return redirect('/login')->with(['msg'=>'您输入的账号或密码有误']);
        }
    }

    // 注册
    public function register(){
        return view('admin.login.register');
    }

    // 执行注册
    public function registerdo(request $request){
        $data = $request->except('_token');
        if(empty($data['user_name'])){
            return redirect('/login/register')->with('msg','用户名不可为空');
        }
        if(empty($data['email'])){
            return redirect('/login/register')->with('msg','邮箱不可为空');
        }
        if(empty($data['password'])){
            return redirect('/login/register')->with('msg','密码不可为空');
        }
        if($data['password'] != $data['rep_password']){
            return redirect('/login/register')->with('msg','两次输入的密码不一致');
        }else{
            unset($data['rep_password']);
        }
        $data['reg_time'] = time();
        $UserModel = new UserModel();
        $res = $UserModel->insert($data);
        if($res){
            return redirect('/login');
        }else{
            return redirect('/login/register')->with('msg','注册失败');
        }
    }

    // 首页
    public function index(){
        $UserModel = new UserModel();
        $UserInfo = $UserModel->get();
        return view('admin.login.index',['UserInfo'=>$UserInfo]);
    }

    // 删除
    public function delete($id){
        $UserModel = new UserModel();
        $res = $UserModel->where('uid',$id)->delete();
        if($res > 0){
            return redirect('/login/index');
        }else{
            return redirect('/login/index');
        }
    }

    // 修改视图
    public function edit($id){
        $UserModel = new UserModel();
        $UserInfo = $UserModel->where('uid',$id)->first();
        return view('admin.login.edit',['UserInfo'=>$UserInfo]);
    }

    // 执行修改
    public function update(request $request,$id){
        $UserModel = new UserModel();
        $data = $request->except('_token');
        $res = $UserModel->where('uid',$id)->update($data);
        if($res > 0){
            return redirect('/login/index')->with('msg','修改成功');
        }else{
            return redirect('/login/index')->with('msg','修改失败');
        }
    }
}
