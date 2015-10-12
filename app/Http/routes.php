<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('splash');
});
Route::get('/lip', function () {
    return view('devbf/lip');
});
Route::get('/user', function () {
    return view('devbf/user');
});
Route::get('/colors', function () {
    return view('devbf/colors');
});
Route::get('/pwdgen', function () {
    return view('devbf/pwdgen');
});
//Route::get('test', 'MainController@getIndex');

Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');
