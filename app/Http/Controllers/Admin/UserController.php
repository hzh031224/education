<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;

class UserController extends Controller
{
    public function test(){
        /*
        insert
        delete
        update
        select
        自增 自减  increment  decrement
        聚合函数    sum  avg  min max count
        limit
        order by
        */
        // 添加
        // $insert = Db::table('student')->insert(['stu_name'=>'张三','stu_age'=>13]);
        // 删除
        // $delete = Db::table('student')->where('stu_id',3)->delete();
        // 修改
        // $update = Db::table('student')->where('stu_name','张三')->update(['stu_name'=>'李四']);
        // 查
        // $select = Db::table('student')->select();
        // 自增
        // $increment = Db::table('student')->increment('stu_id');
        // 自减
        // $decrement = Db::table('student')->decrement('stu_id');
        // sum
        // $sum = Db::table('student')->sum('stu_age');
        // avg
        // $avg = Db::table('student')->avg('stu_age');
        // min
        // $min = Db::table('student')->min('stu_age');
        // max
        // $max = Db::table('student')->max('stu_age');
        // count
        // $count = Db::table('student')->count();
        // limit
        // $limit = Db::table('student')->limit(3)->get();
        // order
        // $order = Db::table('student')->orderBy('stu_id','desc')->get();
        // dd($order);

        /**
         * 使用Redis
         * 来设置 获取值
         */
        // 设置Redis 值
        Redis::set('name', 'leesin');
        // 获取Redis 值
        echo Redis::get('name');
    }
}
