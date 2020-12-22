<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Input;
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
    return redirect('index');
});

Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});

//Trang chủ
Route::get('index',[
    'as'=>'trang-chu',
    'uses'=>'PageController@getIndex'
]);


//Đăng ký thành viên
Route::get('dang-ki', [
    'as'=>'signup',
    'uses'=>'UserController@getsignup'
]);

Route::post('dang-ki', [
    'as'=>'signup',
    'uses'=>'UserController@postsignup'
]); 


//Đăng nhập và xử lý đăng nhập
Route::get('dang-nhap', [
    'as'=>'signin',
    'uses'=>'UserController@getsignin'
]);  


Route::post('dang-nhap', [
    'as'=>'signin',
    'uses'=>'UserController@postsignin'
]); 

//Đăng xuất
Route::get('dang-xuat',[
    'as'=>'signout',
    'uses'=>'UserController@getsignout'
]);

//Đăng tin
Route::get('dang-tin', [
    'as'=>'post',
    'uses'=>'PageController@get_dangtin'
]); 


Route::get('dang-tin/{id}', [
    'as'=>'location',
    'uses'=>'PageController@getlocation'
]);
Route::post('dang-tin', [
    'as'=>'post',
    'uses'=>'PageController@post_dangtin'
]); 

//Lấy danh mục loại phòng
Route::get('danh-muc/{type}', [
    'as'=>'danhmuc',
    'uses'=>'PageController@gethousetype'
]);

//Danh sách nhà trọ theo dõi
Route::get('follow/{id}', [
    'as'=>'follow',
    'uses'=>'PageController@getFollow'
]);

Route::get('cart', [
    'as'=>'cart',
    'uses'=>'PageController@getCart'
]);

// chi tiết phòng trọ
Route::get('chi-tiet-phong-tro/{id}', [
    'as'=>'chitietphong',
    'uses'=>'PageController@getchitietPhongtro'
]);

// danh mục
Route::get('danh-muc-phong-tro/{type}', [
    'as'=>'danhmucphongtro',
    'uses'=>'PageController@getloaiphong'
]);

//search
Route::get('search', [
    'as'=>'search',
    'uses'=>'PageController@getsearchhouse'
]);

Route::post('search', [
    'as'=>'search',
    'uses'=>'PageController@searchhouse'
]);

Route::get('districts', [
    'as'=>'districts',
    'uses'=>'PageController@getdistricts'
]);

Route::get('profile/{id}', [
    'as'=> 'profile',
    'uses'=> 'UserController@getprofile'
]);



Route::get('edit-profile/{id}', [
    'as'=> 'edituser',
    'uses'=> 'UserController@getEditprofile'
]);


Route::post('edit-profile/{id}', [
    'as'=> 'edituser',
    'uses'=> 'UserController@postEditprofile'
]);


/* admin  */

Route::get('login', [
    'as'=> 'login',
    'uses'=> 'AdminController@getadminlogin'
]);


Route::post('login', [
    'as'=> 'login',
    'uses'=> 'AdminController@postadminlogin'
]);

Route::get('admin',[
    'as'=>'admin',
    'uses'=>'AdminController@getIndex'
]);

Route::group(['prefix'=>'house'],function(){
    Route::get('list','AdminController@getListHouse');
    Route::get('approve/{id}','AdminController@ApproveHouse');
    Route::get('unapprove/{id}','AdminController@UnApproveHouse');
    Route::get('delete/{id}','AdminController@DelHouse');
    
});

Route::group(['prefix'=>'account'],function(){
    Route::get('listAccount','AdminController@getListAccount');
    // Route::get('edit/{id}','AdminController@getUpdateAccount');
    // Route::post('edit/{id}','AdminController@postUpdateAccount');
    Route::get('listaccountwaiting', 'AdminController@getListAccountWaiting');
    Route::get('approve/{id}','AdminController@ApproveAccount');
    
    Route::get('del/{id}','AdminController@DeleteUser');
});


Route::get('edit/{id}', [
    'as'=> 'editadmin',
    'uses'=> 'AdminController@getUpdateAccount'
]);

Route::post('edit/{id}',[
    'as'=>'editadmin',
    'uses'=>'AdminController@postUpdateAccount'
]);
// Message
Route::get('messages',[
    'as'=>'messages',
    'uses'=>'PageController@getMessage'
]);
