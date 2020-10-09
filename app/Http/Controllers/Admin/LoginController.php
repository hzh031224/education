<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User as UserModel;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redis;


class LoginController extends Controller
{
    // 登录视图
    public function login(){
        return view('admin.login.login');
    }

    // 执行登录
    public function logindo(Request $request){
        /** @var
         * $validatedData
         * required 不可为空
         * unique   数据库的表
         * min      最小值
         * max      最大值
         */
        // 第一个表单验证
        $validatedData = $request->validate([
            'user_account' => 'required',
            'password' => 'required',
        ],[
            'user_account.required'=>'账号必填',
            'password.required'=>'密码必填',
        ]);
        // 得到当前用户的真实ip
        $ip = $request->getClientIp();
        $data = $request->except('_token');
        /*if(substr_count($data['user_account'],'@') > 0){
            $where = ['email'=>$data['user_account']];
        }else if(strlen($data['user_account']) == 11){
            $where = ['user_tel'=>$data['user_account']];
        }else{
            $where = ['user_name'=>$data['user_account']];
        }*/
        // 使用hash加密密码
        $UserModel = new UserModel();
        // 根据用户输入的账号和密码在库中查询
        $res = $UserModel
            ->where(['email'=>$data['user_account']])
            ->orwhere(['user_tel'=>$data['user_account']])
            ->orwhere(['user_name'=>$data['user_account']])
            ->first();
        if(empty($res)){
            return redirect('admin/login')->with(['msg'=>'您输入的账号或密码有误']);
        }
        if(is_object($res)){
            $res = $res->toArray();
        }

//        $data['password'] = bcrypt($data['password']);
        /**
         * password_verify
         * 函数用于验证密码是否和散列值匹配
         * return bool
         */
        if(password_verify($data['password'],$res['password'])){
            $logininfo = ['last_login'=>time(),'last_ip'=>$ip,'login_count'=>$res['login_count']+1];
            $UserModel->where('uid',$res['uid'])->update($logininfo);
            return redirect('admin/login/index');
        }else{
            /*10分钟内，用户连续输入密码错误超过5次，锁定用户 60分钟（禁止登录）。
            提示：
            使用Redis实现计数（incr）
            使用expire实现时间控制
            先得到最后一次错误的时间
            判断当前时间戳
            */
            // 十分钟前
            /*Redis::set('error_login'.$res['uid'],null);
            Redis::set('right_login'.$res['uid'],null);
            Redis::set('error_time'.$res['uid'],null);
            dump(Redis::get('error_time'.$res['uid']));
            dump(Redis::get('error_login'.$res['uid']));
            dump(Redis::get('right_login'.$res['uid']));
            die;*/
            $ten_minute = 10 * 60;
            if(time() > Redis::get('right_login'  .$res['uid'])){
                /**
                 * 如果他的错误时间大于当前时间 - 10 min
                 */
                if(Redis::get('error_time'.$res['uid']) > time() - $ten_minute){
                    if(Redis::get('error_login'.$res['uid']) >= 10){
                        $right_time = time() + 3600;
                        Redis::set('right_login'.$res['uid'],$right_time);
                        return redirect('admin/login')->with(['msg'=>'您输入的账号或密码有误，错误次数,已达到10次，锁定一小时']);
                    }else{
                        $ago_time = time() - 600;
                        // 错误次数
                        if(empty(Redis::get('error_login'.$res['uid']))){//如果它没有错误过那么错误次数从0开始
                            $error_count = 1;
                            Redis::set('error_login'.$res['uid'],$error_count);
                            Redis::set('error_time'.$res['uid'],time());
                        }else{//如果它错误过，那么从错误的基础上来+1
                            $error_count = Redis::get('error_login'.$res['uid']);
                            Redis::set('error_login'.$res['uid'],$error_count + 1);
                        }
                    }
                }else{
                    Redis::set('error_time'.$res['uid'],time());
                }
            }else{
                return redirect('admin/login')->with(['msg'=>'您的密码已经输错10次，锁定一小时']);
            }
            return redirect('admin/login')->with(['msg'=>'您输入的账号或密码有误，错误次数'.Redis::get('error_login'.$res['uid']).'最近错误的时间'.Redis::get('error_time'.$res['uid'])]);
        }
    }

    // 注册
    public function register(){
        return view('admin.login.register');
    }

    // 执行注册
    public function registerdo(request $request){
        $data = $request->except('_token');
        /** @var
         * $validatedData
         * required 不可为空
         * unique   数据库的表
         * min      最小值
         * max      最大值
         */
        // 第一个表单验证
        $validatedData = $request->validate([
            'user_name' => 'required|unique:user|regex:/^[A-Za-z0-9_\x{4e00}-\x{9fa5}]+$/u',
            'email' => 'required|regex:/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,})$/i',
            'password' => 'required|confirmed',
        ],[
            'user_name.required'=>'用户名必填',
            'user_name.unique'=>'用户名已存在',
            'user_name.regex'=>'用户名不能是纯数字',
            'email.required'=>'邮箱必填',
            'email.regex'=>'请输入正确的邮箱',
            'password.required'=>'密码必填',
            'password.confirmed'=>'密码和第二次输入的密码不一致',
        ]);
        unset($data['password_confirmation']);
        /*if(empty($data['user_name'])){
            return redirect('admin/login/register')->with('msg','用户名不可为空');
        }
        if(empty($data['email'])){
            return redirect('admin/login/register')->with('msg','邮箱不可为空');
        }
        if(empty($data['password'])){
            return redirect('admin/login/register')->with('msg','密码不可为空');
        }
        if($data['password'] != $data['rep_password']){
            return redirect('admin/login/register')->with('msg','两次输入的密码不一致');
        }else{
            unset($data['password_confirmation']);
        }*/
        $data['reg_time'] = time();
        $UserModel = new UserModel();
        $data['password'] = password_hash($data['password'], PASSWORD_BCRYPT);
        $res = $UserModel->insert($data);
        if($res){
            return redirect('admin/login');
        }else{
            return redirect('admin/login/register')->with('msg','注册失败');
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
            return redirect('admin/login/index');
        }else{
            return redirect('admin/login/index');
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
            return redirect('admin/login/index')->with('msg','修改成功');
        }else{
            return redirect('admin/login/index')->with('msg','修改失败');
        }
    }
}
