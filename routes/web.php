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

/* 用户模块 使用php artisan make:controller RegisterController 生成控制器 */
// 注册页面
Route::get('/register', '\App\Http\Controllers\RegisterController@index');
// 注册行为
Route::post('/register', '\App\Http\Controllers\RegisterController@register');

// 登录页面
Route::get('/login', '\App\Http\Controllers\LoginController@index');
// 登录行为
Route::post('/login', '\App\Http\Controllers\LoginController@login');
Route::get('/logout', '\App\Http\Controllers\LoginController@logout');
// 个人设置页面
Route::get('/user/me/setting', '\App\Http\Controllers\UserController@setting');
// 个人设置操作
Route::post('/user/me/setting', '\App\Http\Controllers\UserController@settingStore');

/* 文章模块相关路由 */
// 文章列表页
Route::get('/articles', '\App\Http\Controllers\ArticleController@index');
// 创建文章
Route::get('/article/create', '\App\Http\Controllers\ArticleController@create');
// 文章搜索页
Route::get('/articles/search', '\App\Http\Controllers\ArticleController@search');
// 文章详情页
Route::get('/articles/{article}', '\App\Http\Controllers\ArticleController@detail');

Route::post('/articles', '\App\Http\Controllers\ArticleController@store');
// 编辑文章
Route::get('/articles/{article}/edit', '\App\Http\Controllers\ArticleController@edit');
Route::put('/articles/{article}', '\App\Http\Controllers\ArticleController@update');
// 删除文章
Route::get('/articles/{article}/delete', '\App\Http\Controllers\ArticleController@delete');

// 提交评论
Route::post('/articles/{article}/comment', '\App\Http\Controllers\ArticleController@comment');

// 赞
Route::get('/articles/{article}/zan', '\App\Http\Controllers\ArticleController@zan');
Route::get('/articles/{article}/unzan', '\App\Http\Controllers\ArticleController@unzan');

// 个人中心
Route::get('/user/{user}', '\App\Http\Controllers\UserController@show');
Route::post('/user/{user}/fan', '\App\Http\Controllers\UserController@fan');