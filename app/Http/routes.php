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

Route::get('/lip', 'LipController@getLip');

Route::post('/lip', 'LipController@postLip');

Route::get('/user', 'UserController@getUser');

Route::post('/user', 'UserController@postUser');

Route::get('/colors', 'ColorController@index');

Route::post('/colors', 'ColorController@uploadFile');

Route::get('/colorsU', 'ColorController@upload');

Route::get('/pwdgen', 'PwdController@getPwd');

Route::post('/pwdgen', 'PwdController@postPwd');

if (App::environment('local')) {
    Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');
};
