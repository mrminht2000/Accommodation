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
    return view('welcome');
});

Route::get('dang-ki', [
    'as'=>'signup',
    'uses'=>'PageController@getsignup'
]);

Route::get('dang-nhap', [
    'as'=>'signin',
    'uses'=>'PageController@getsignin'
]);  

Route::post('dang-ki', [
    'as'=>'signup',
    'uses'=>'PageController@postsignup'
]); 

Route::post('dang-nhap', [
    'as'=>'signin',
    'uses'=>'PageController@postsignin'
]); 
