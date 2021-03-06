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
// 学生
Route::prefix('student')->group(function(){
    // 添加
    Route::get('create','Admin\StudentController@create');
    // 执行添加
    Route::post('save','Admin\StudentController@save');
    // 列表
    Route::get('login','Admin\StudentController@login');
    // 删除
    Route::get('delete/{id}','Admin\StudentController@delete');
    // 修改
    Route::get('edit/{id}','Admin\StudentController@edit');
    // 执行修改
    Route::post('update','Admin\StudentController@update');
});
// 登录
Route::prefix('admin/login')->group(function(){
    // 登录
    Route::get('/','Admin\LoginController@login');
    // 执行登录
    Route::post('loginDo','Admin\LoginController@loginDo');
    // 注册
    Route::get('register','Admin\LoginController@register');
    // 执行注册
    Route::post('registerdo','Admin\LoginController@registerdo');
    // 首页
    Route::get('index','Admin\LoginController@index');
    // 删除
    Route::get('delete/{id}','Admin\LoginController@delete');
    // 修改
    Route::get('edit/{id}','Admin\LoginController@edit');
    // 执行修改
    Route::post('update/{id}','Admin\LoginController@update');
});
// 商品
Route::prefix('admin/goods')->group(function(){
    // 列表
    Route::get('/','Admin\GoodsController@index');
    // 详情页
    Route::get('detail/{id}','Admin\GoodsController@detail');
});
// 后台首页
Route::prefix('admin/index')->group(function(){
    // 后台首页
    Route::get('/','Admin\IndexController@index');
});

//  练习
Route::get('/test','Admin\UserController@test');
// info
 Route::get('/info', function () {
    phpinfo();
});


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
