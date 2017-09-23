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

/* 文章模块相关路由 */
// 文章列表页
Route::get('/articles', '\App\Http\Controllers\ArticleController@index');
// 文章详情页
Route::get('/articles/{article}', '\App\Http\Controllers\ArticleController@detail');
// 创建文章
Route::get('/article/create', '\App\Http\Controllers\ArticleController@create');
Route::post('/articles', '\App\Http\Controllers\ArticleController@store');
// 编辑文章
Route::get('/articles/{article}/edit', '\App\Http\Controllers\ArticleController@edit');
Route::put('/articles/{article}', '\App\Http\Controllers\ArticleController@update');
// 删除文章
Route::get('/articles/{article}/delete', '\App\Http\Controllers\ArticleController@delete');

