<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

/**
 *  闭包路由
 *  第一个参数为用户请求的url第二个匿名函数
 *  调用模板文件welcome , 第二个参数可以给模板文件传参
 */

/* Route::get('/test', function () {
    return view('welcome');
}); */

// student



// 路由分组

Route::prefix('student')->group(function(){
    // 添加
    Route::get('create','Admin\StudentController@create');
    // 执行添加
    Route::post('save','Admin\StudentController@save');
    // 列表
    Route::get('index','Admin\StudentController@index');
    // 删除
    Route::get('delete/{id}','Admin\StudentController@delete');
    // 修改
    Route::get('edit/{id}','Admin\StudentController@edit');
    // 执行修改
    Route::post('update','Admin\StudentController@update');
});

Route::get('/test','Admin\UserController@test');



/**
 *  一个路由支持多种请求方式
 *  第一个参数为请求的方式
 *  第二个是用户请求url的地址(admin\create)
 *  第三个是调用Admin模块中的Student控制器create方法
 */

// 方法1
// Route::match(['get','post'],'create','Admin\StudentController@create');
// 方法2
// Route::any('create','Admin\StudentController@create');

/**
 *  路由视图
 *  第一个是用户请求url的地址(admin\create)
 *  第二个是调用create模板文件
 *  第三个参数可以给模板文件传参(可空)
 */

// Route::get('create','create',['name'=>'张三']);

/**
 *  路由重定向
 *  定义一个重定向到其他 URI 的路由
 *  第三个参数跟状态码(可空)
 *  302临时重定向(对搜索引擎不好)
 *  301永久重定向(对seo优化比较友好)
 */

// Route::redirect('/aaa','/bbb');