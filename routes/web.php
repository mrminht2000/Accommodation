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


Route::post('dang-tin', [
    'as'=>'post',
    'uses'=>'PageController@post_dangtin'
]); 

// chỉnh sửa phòng trọ
Route::post('chinh-sua/{id}', [
    'as'=>'edithouse',
    'uses'=>'UserController@post_chinhsua'
]); 

Route::get('chinh-sua/{id}', [
    'as'=>'edithouse',
    'uses'=>'UserController@get_chinhsua'
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

Route::get('deletefollow/{id}', [
    'as'=>'deletefollow',
    'uses'=>'PageController@deleteFollow'
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

Route::get('reportuser/{id}', [
    'as'=> 'reportuser',
    'uses'=> 'UserController@getreportuser'
]);

Route::get('thongbao/{id}', [
    'as'=>'thongbao',
    'uses'=>'PageController@getthongbao'
]);

Route::get('xoathongbaonha/{id}', [
    'as'=>'xoathongbaonha',
    'uses'=>'PageController@getxoathongbaonha'
]);

Route::get('xoathongbaoreview/{id}', [
    'as'=>'xoathongbaoreview',
    'uses'=>'PageController@getxoathongbaoreview'
]);

Route::get('huong-dan', [
    'as'=>'huongdan',
    'uses'=>'PageController@gethuongdan'
]);

Route::get('rented/{id}', [
    'as'=>'rented',
    'uses'=>'PageController@getRented'
]);


/* admin  */


Route::get('logout',[
    'as'=>'logout',
    'uses'=>'AdminController@getlogout'
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

Route::get('thong-ke', [
    'as'=>'thongke',
    'uses'=>'AdminController@getthongske'
]);

Route::get('reportadmin', [
    'as'=>'reportadmin',
    'uses'=>'AdminController@getreportadmin'
]);

//Review
Route::post('review',[
    'as'=>'review',
    'uses'=>'PageController@postReview'
]);

/* review admin */

Route::get('reviewadmin', [
    'as'=>'reviewadmin',
    'uses'=>'AdminController@getreviewadmin'
]);

Route::get('approvereview/{id}', [
    'as'=>'approvereview',
    'uses'=>'AdminController@getapprovereview'
]);

Route::get('unapprovereview/{id}', [
    'as'=>'unapprovereview',
    'uses'=>'AdminController@getunapprovereview'
]);

Route::get('deletereview/{id}', [
    'as'=>'deletereview',
    'uses'=>'AdminController@getdeletereview'
]);


    