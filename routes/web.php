<?php

use Illuminate\Support\Facades\Route;

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
    return view('home.index');
});

Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});

Route::get('index',[
    'as'=>'trang-chu',
    'uses'=>'PageController@getIndex'
]);


//Đăng ký thành viên
Route::get('dang-ki', [
    'as'=>'signup',
    'uses'=>'PageController@getsignup'
]);

Route::post('dang-ki', [
    'as'=>'signup',
    'uses'=>'PageController@postsignup'
]); 


//Đăng nhập và xử lý đăng nhập
Route::get('dang-nhap', [
    'as'=>'signin',
    'uses'=>'PageController@getsignin'
]);  


Route::post('dang-nhap', [
    'as'=>'signin',
    'uses'=>'PageController@postsignin'
]); 

Route::get('dang-tin', [
    'as'=>'post',
    'uses'=>'PageController@get_dangtin'
]); 

Route::post('dang-tin', [
    'as'=>'post',
    'uses'=>'PageController@post_dangtin'
]); 



Route::get('danh-muc/{type}', [
    'as'=>'danhmuc',
    'uses'=>'PageController@gethousetype'
]);

Route::get('danh-muc/{id}','PageController@getMotelByCategoryId');