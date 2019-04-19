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
Route::get('/', function(){
	return view('welcome');
});
//后台登录
Route::get('admin/login', 'Admin\LoginController@index');
//后台验证
Route::post('admin/login', 'Admin\LoginController@login');
//退出登录
Route::get('admin/logout','Admin\LoginController@logout');
//后台首页
Route::get('admin/index','Admin\IndexController@index')->middleware('login');

//网站设置
Route::get('admin/system','Admin\SystemController@index');
Route::get('admin/system/edit','Admin\SystemController@edit');
Route::post('admin/system/update','Admin\SystemController@update');

//banner
Route::resource('admin/image','Admin\ImageController');

//留言管理
Route::get('admin/comment','Admin\CommentController@index');

//文章管理
Route::resource('admin/article','Admin\AriticeController');

//分类管理
Route::resource('admin/cat','Admin\CatController');

//管理员密码修改
Route::match(['get','post'],'admin/pass','Admin\UserController@pass');

//用户列表
Route::get('admin/user','Admin\UserController@index');

//通过ajax匹配原密码
Route::post('admin/charkpass','Admin\LoginController@charkpass');
